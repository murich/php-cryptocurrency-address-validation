<?php

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

use Merkeleon\PhpCryptocurrencyAddressValidation\Base58Validation;
use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\Bech32Decoder;
use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\Bech32Exception;
use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;
use CBOR\Decoder;
use CBOR\OtherObject;
use CBOR\Tag;
use CBOR\StringStream;

class ADA extends Base58Validation
{
    public function isValidV1($address) {
        try {
            $addressHex = self::base58ToHex($address);

            $otherObjectManager = new OtherObject\OtherObjectManager();
            $otherObjectManager->add(OtherObject\SimpleObject::class);

            $tagManager = new Tag\TagObjectManager();
            $tagManager->add(Tag\PositiveBigIntegerTag::class);

            $decoder = new Decoder($tagManager, $otherObjectManager);
            $data = hex2bin($addressHex);
            $stream = new StringStream($data);
            $object = $decoder->decode($stream);

            $normalizedData = $object->getNormalizedData();
            if ($object->getMajorType() != 4) {
                return false;
            }
            if (count($normalizedData) != 2) {
                return false;
            }
            if (!is_numeric($normalizedData[1])) {
                return false;
            }
            $crcCalculated = crc32($normalizedData[0]->getValue());
            $validCrc = $normalizedData[1];

            return $crcCalculated == (int)$validCrc;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function validate($address) {
        $valid = $this->isValidV1($address);
        if (!$valid) {
            // maybe it's a bech32 address
            try {
                $valid = is_array($decoded = Bech32Decoder::decodeRaw($address)) && 'addr' === $decoded[0];
            } catch (Bech32Exception $exception) {}
        }

        return $valid;
    }
}
