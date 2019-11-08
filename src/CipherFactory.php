<?php

namespace Cipher;

class CipherFactory
{
    /**
     * Create a caesar cipher.
     *
     * @return CaesarCipher
     * @throws \Exception
     */
    public function makeCaesarCipher(): CipherStrategy
    {
        return new CaesarCipher($this->loadConfiguration()['caesar']);
    }

    /**
     * Create a hill cipher.
     *
     * @return HillCipher
     * @throws \Exception
     */
    public function makeHillCipher(): CipherStrategy
    {
        return new HillCipher($this->loadConfiguration()['hill']);
    }

    /**
     * @return array
     */
    private function loadConfiguration(): array
    {
        return require __DIR__.'/../config/cipher.php';
    }
}
