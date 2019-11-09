<?php

namespace Cipher;

class CipherFactory
{
    /**
     * The available ciphers.
     *
     * @var array
     */
    protected $ciphers = [
        'caesar' => CaesarCipher::class,
        'hill' => HillCipher::class,
        'reverse' => ReverseCipher::class,
    ];

    /**
     * Create a caesar cipher.
     *
     * @return CaesarCipher
     * @throws \Exception
     */
    public function makeCipher($cipher): CipherStrategy
    {
        $supportedCiphers = $this->getCiphers();

        if (! array_key_exists($cipher, $supportedCiphers)) {
            throw new \Exception('There is no supported chipper called '.$cipher);
        }

        $cipherAlgorithm = $supportedCiphers[$cipher];

        return new $cipherAlgorithm($this->loadConfiguration()[$cipher]);
    }

    /**
     * Get the available ciphers.
     *
     * @return array
     */
    public function getCiphers(): array
    {
        return $this->ciphers;
    }

    /**
     * @return array
     */
    private function loadConfiguration(): array
    {
        return require __DIR__.'/../config/cipher.php';
    }
}
