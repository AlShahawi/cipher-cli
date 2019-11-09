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

        $this->assertEquals('Crr', $caesarCipher->encrypt('Zoo'));
        $this->assertEquals('Khoor Zruog', $caesarCipher->encrypt('Hello World'));
    }

    public function testItDecryptAGivenString(): void
    {
        $caesarCipher = new CaesarCipher([
            'shift' => 3,
        ]);

        $this->assertEquals('Hello World', $caesarCipher->decrypt('Khoor Zruog'));
        $this->assertEquals('Zoo', $caesarCipher->decrypt('Crr'));

        $caesarCipher = new CaesarCipher([
            'shift' => 5,
        ]);

        $this->assertEquals(
            'Always-Look-on-the-Bright-Side-of-Life',
            $caesarCipher->decrypt('Fqbfdx-Qttp-ts-ymj-Gwnlmy-Xnij-tk-Qnkj')
        );
    }
}
