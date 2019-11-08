<?php

namespace Cipher;

use Exception;

class CaesarCipher implements CipherStrategy
{
    /**
     * The shift which indicates the number of position each letter of the text needs to move.
     *
     * @var int
     */
    private $shift;

    /**
     * CipherStrategy constructor.
     *
     * @param  array  $options
     */
    public function __construct($options = [])
    {
        if (! isset($options['shift']) || $options['shift'] < 1) {
            throw new Exception('The shift option must be specified and greater than 0.');
        }

        $this->shift = $options['shift'];
    }

    /**
     * Encrypt a given string.
     *
     * @param  string  $string
     * @return string
     */
    public function encrypt(string $string): string
    {
        // We will iterate over each character of the given string.
        for ($i = 0; $i < strlen($string); $i++) {
            $char = $string[$i];

            if (ctype_upper($char)) {
                // if it is an upper case character we will start at code 65
                $startFrom = 65;
            } elseif (ctype_lower($char)) {
                // if it is an lower case character we will start at code 97
                $startFrom = 97;
            } else {
                // otherwise we will skip shifting the character
                continue;
            }

            // shift the character
            $string[$i] = chr((ord($char) - $startFrom + $this->shift) % 26 + $startFrom);
        }

        return $string;
    }

    /**
     * Decrypt a given string.
     *
     * @param  string  $string
     * @return string
     */
    public function decrypt(string $string): string
    {
        throw new Exception('Not implemented.');
    }
}
