<?php

namespace Cipher;

use Exception;
use Cipher\Math\Matrix;

class HillCipher implements CipherStrategy
{
    /**
     * The key which will be used for encryption.
     *
     * @var Matrix
     */
    private $keyMatrix;

    /**
     * The key which will be used for decryption.
     *
     * @var Matrix
     */
    private $keyInverseMatrix;

    /**
     * The default bit separator used to separate multiplied bits from each other.
     *
     * @var string
     */
    private $bitSeparator;

    /**
     * HillCipher constructor.
     *
     * @param  array  $options
     * @throws Exception
     */
    public function __construct($options = [])
    {
        if (! isset($options['key']) || ! isset($options['key_inverse'])) {
            throw new Exception('The key and key_inverse options must be specified.');
        }

        $this->bitSeparator = $options['bit_separator'] ?? ';';

        $this->keyMatrix = new Matrix($options['key']);

        // It is redundant for having the inverse of the array here,
        // but finding the inverse of an array is out of task scope.
        $this->keyInverseMatrix = new Matrix($options['key_inverse']);
    }

    /**
     * Encrypt a given string.
     *
     * @param  string  $string
     * @return string
     */
    public function encrypt(string $string): string
    {
        $encrypted = '';

        for ($i = 0; $i < strlen($string); $i ++) {
            $char = $string[$i];
            $binaryRepresentation = str_pad(decbin(ord($char)), 16, 0, STR_PAD_LEFT);
            $vector = Matrix::fromFlatArray(str_split($binaryRepresentation, 1));
            $encipheredVector = $this->keyMatrix->multiply($vector)->getColumnValues(0);

            if ($i > 0) {
                // append a bit separator if there are characters encrypted previously.
                $encrypted .= $this->bitSeparator;
            }

            $encrypted .= implode($this->bitSeparator, $encipheredVector);
        }

        return $encrypted;
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
