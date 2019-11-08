<?php

namespace Cipher;

interface CipherStrategy
{
    /**
     * CipherStrategy constructor.
     *
     * @param  array  $options
     */
    public function __construct($options = []);

    /**
     * Encrypt a given string.
     *
     * @param  string  $string
     * @return string
     */
    public function encrypt(string $string): string;

    /**
     * Decrypt a given string.
     *
     * @param  string  $string
     * @return string
     */
    public function decrypt(string $string): string;
}
