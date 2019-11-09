<?php

namespace Cipher;

use Exception;
use GuzzleHttp\Client;

class ReverseCipher implements CipherStrategy
{
    /**
     * The base uri of the backend.
     *
     * @var string
     */
    private $baseUri;

    /**
     * @var mixed
     */
    private $httpClient;

    /**
     * ReverseCipher constructor.
     *
     * @param  array  $options
     * @throws Exception
     */
    public function __construct($options = [])
    {
        if (! isset($options['base_uri']) || ! $options['base_uri']) {
            throw new Exception('The base_uri option must be specified.');
        }

        $this->baseUri = $options['base_uri'];
    }

    /**
     * Encrypt a given string.
     *
     * @param  string  $string
     * @return string
     */
    public function encrypt(string $string): string
    {
        return $this->requestFor('encode', $string);
    }

    /**
     * Decrypt a given string.
     *
     * @param  string  $string
     * @return string
     */
    public function decrypt(string $string): string
    {
        return $this->requestFor('decode', $string);
    }

    /**
     * @param  string  $string
     * @return mixed
     */
    public function requestFor(string $method, string $string)
    {
        $this->initHttpClient();

        $response = $this->httpClient->post($method, [
            'json' => ['string' => $string],
        ]);

        return json_decode($response->getBody())->string;
    }

    /**
     * Initialize the http client if not initialized.
     */
    public function initHttpClient(): void
    {
        if ($this->httpClient) {
            return;
        }

        $this->httpClient = new Client(['base_uri' => $this->baseUri]);
    }
}
