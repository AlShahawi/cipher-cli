<?php

use Cipher\CaesarCipher;
use PHPUnit\Framework\TestCase;

final class CaesarCipherTest extends TestCase
{
    public function testItEncryptAGivenCharacter(): void
    {
        $caesarCipher = new CaesarCipher([
            'shift' => 3,
        ]);

        $this->assertEquals('D', $caesarCipher->encrypt('A'));
    }

    public function testItEncryptAGivenString(): void
    {
        $caesarCipher = new CaesarCipher([
            'shift' => 3,
        ]);

        $this->assertEquals('Khoor Zruog', $caesarCipher->encrypt('Hello World'));
    }
}
