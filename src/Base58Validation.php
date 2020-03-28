<?php


namespace Merkeleon\PhpCryptocurrencyAddressValidation;


class Base58Validation extends Validation
{
    protected static $base58Dictionary = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
    protected static function decodeHex($hex)
    {
        $hex    = strtoupper($hex);
        $chars  = "0123456789ABCDEF";
        $return = "0";
        for ($i = 0; $i < strlen($hex); $i++)
        {
            $current = (string)strpos($chars, $hex[$i]);
            $return  = (string)bcmul($return, "16", 0);
            $return  = (string)bcadd($return, $current, 0);
        }

        return $return;
    }

    protected static function encodeHex($dec)
    {
        $chars  = "0123456789ABCDEF";
        $return = "";
        while (bccomp($dec, 0) == 1)
        {
            $dv     = (string)bcdiv($dec, "16", 0);
            $rem    = (integer)bcmod($dec, "16");
            $dec    = $dv;
            $return = $return . $chars[$rem];
        }

        return strrev($return);
    }

    protected static function base58ToHex($base58)
    {
        $origbase58 = $base58;

        $return = "0";
        for ($i = 0; $i < strlen($base58); $i++)
        {
            $current = (string)strpos(static::$base58Dictionary, $base58[$i]);
            $return  = (string)bcmul($return, "58", 0);
            $return  = (string)bcadd($return, $current, 0);
        }

        $return = self::encodeHex($return);

        //leading zeros
        for ($i = 0; $i < strlen($origbase58) && $origbase58[$i] == static::$base58Dictionary[0]; $i++)
        {
            $return = "00" . $return;
        }

        if (strlen($return) % 2 != 0)
        {
            $return = "0" . $return;
        }

        return $return;
    }

    protected static function encodeBase58($hex)
    {
        $orighex = $hex;

        $hex    = self::decodeHex($hex);
        $return = "";
        while (bccomp($hex, 0) == 1)
        {
            $dv     = (string)bcdiv($hex, "58", 0);
            $rem    = (integer)bcmod($hex, "58");
            $hex    = $dv;
            $return = $return . static::$base58Dictionary[$rem];
        }
        $return = strrev($return);

        //leading zeros
        for ($i = 0; $i < strlen($orighex) && substr($orighex, $i, 2) == "00"; $i += 2)
        {
            $return = "1" . $return;
        }

        return $return;
    }

    protected function hash160ToAddress($hash160)
    {
        $hash160 = $this->addressVersion . $hash160;
        $check   = pack("H*", $hash160);
        $check   = hash("sha256", hash("sha256", $check, true));
        $check   = substr($check, 0, 8);
        $hash160 = strtoupper($hash160 . $check);

        if (strlen($hash160) % 2 != 0)
        {
            $this->addressVersion = null;
        }

        return self::encodeBase58($hash160);
    }

    protected static function addressToHash160($addr)
    {
        $addr = self::base58ToHex($addr);
        $addr = substr($addr, 2, strlen($addr) - 10);

        return $addr;
    }

    protected static function hash160($data)
    {
        $data = pack("H*", $data);

        return strtoupper(hash("ripemd160", hash("sha256", $data, true)));
    }

    protected function pubKeyToAddress($pubkey)
    {
        return $this->hash160ToAddress(self::hash160($pubkey));
    }

    protected function validateVersion($version)
    {
        return hexdec($version) == hexdec($this->addressVersion);
    }

    protected function determineVersion()
    {
        if (isset($this->base58PrefixToHexVersion[$this->address[0]]))
        {
            $this->addressVersion = $this->base58PrefixToHexVersion[$this->address[0]];
        }
    }

    public function validate($address)
    {
        $address = (string)$address;
        $this->address = $address;
        $this->determineVersion();

        if (is_null($this->addressVersion))
        {
            return false;
        }

        $hexAddress = self::base58ToHex($this->address);
        $length     = $this->length;
        if (!empty($this->lengths[$this->address[0]]))
        {
            $length = $this->lengths[$this->address[0]];
        }

        if (strlen($hexAddress) != $length)
        {
            return false;
        }
        $version = substr($hexAddress, 0, 2);

        if (!$this->validateVersion($version))
        {
            return false;
        }

        $check = substr($hexAddress, 0, strlen($hexAddress) - 8);
        $check = pack("H*", $check);
        $check = strtoupper(hash("sha256", hash("sha256", $check, true)));
        $check = substr($check, 0, 8);

        return $check == substr($hexAddress, strlen($hexAddress) - 8);
    }
}