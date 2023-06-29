<?php

declare(strict_types=1);

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Drivers;

use CBOR\ByteStringObject;
use CBOR\Decoder;
use CBOR\TAg;
use CBOR\StringStream;
use CBOR\OtherObject;
use Illuminate\Support\Str;
use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\Base58Decoder;
use Throwable;
use function array_keys;
use function array_values;

class CborDriver extends AbstractDriver
{
    protected static string $base58Alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
    private readonly Decoder $decoder;

    public function __construct(array $options)
    {
        parent::__construct($options);

        $otherObjectManager = new OtherObject\OtherObjectManager();
        $tagManager = new Tag\TagObjectManager();

        $otherObjectManager->add(OtherObject\SimpleObject::class);
        $tagManager->add(Tag\PositiveBigIntegerTag::class);

        $this->decoder = new Decoder($tagManager, $otherObjectManager);
    }

    public function match(string $address): bool
    {
        return Str::startsWith($address, array_keys($this->options));
    }

    public function check(string $address): bool
    {
        try {
            $addressHex = Base58Decoder::decode($address, self::$base58Alphabet);

            $data = hex2bin($addressHex);

            $stream = new StringStream($data);


            /** @var OtherObject\SimpleObject $object */
            $object = $this->decoder->decode($stream);
            if ($object->getMajorType() !== 4) {
                return false;
            }

            $normalizedData = $object->getNormalizedData();

            if (count($normalizedData) !== 2) {
                return false;
            }
            if (!is_numeric($normalizedData[1])) {
                return false;
            }
            if (!$normalizedData[0] instanceof ByteStringObject) {
                return false;
            }

            $bs = $normalizedData[0];
            if (!in_array($bs->getLength(), array_values($this->options), true)) {
                return false;
            }

            $crcCalculated = crc32($normalizedData[0]->getValue());
            $validCrc = $normalizedData[1];

            return $crcCalculated === (int)$validCrc;
        } catch (Throwable) {
            return false;
        }
    }
}