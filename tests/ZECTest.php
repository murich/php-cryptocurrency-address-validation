<?php

use Murich\PhpCryptocurrencyAddressValidation\Validation\ZEC;

class ZECTest extends PHPUnit_Framework_TestCase
{
    public function testValidator()
    {
        $testData = [
            ['1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', false],
            ['3CDJNfdWX8m2NwuGUV3nhXHXEeLygMXoAj', false],
            ['LbTjMGN7gELw4KbeyQf6cTCq859hD18guE', false],
            ['t1fcVsDx5GoEadjP3bx8KvRvLZJtmK9eBLv', true],
            ['t1Um9WmwefHgGhbnYKZ48n3JKWKwRH2X7q2', true],
            ['zcR1QJ2xsLHDQtecmHJwGGLKR9z6c1U3U3gcDzLHLTs4MrRww5XNXsprV8JN5aGd7DWtDjqniupX5ud38Mph9a4iyEf6FtT', true],
            ['zcBhZyyjBxXLSPEBQrcUn4QiUeSiBhKKwgC9ky4hfhLENxd9CxW3PHL4x6vBsxa1Rvsd4vYis8THSYzDbSFRP8ypz8EEreC', true],
            ['zcJGf2jpJkfmmH1EQCS85BnHCvwn945gxD8Nh9w7kpkUcmdB6vCHRDPjtVWyb9gbHhQAepavncbtERRZvMuNwZDugWkz2Dz', true],
        ];

        foreach ($testData as $row) {
            $validator = new ZEC($row[0]);
            $this->assertEquals($row[1], $validator->validate());
        }
    }
}