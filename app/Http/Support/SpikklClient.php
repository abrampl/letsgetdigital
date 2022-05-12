<?php

namespace App\Http\Support;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class SpikklClient
{
    const URL = 'https://api.spikkl.nl';

    /** @var array */
    protected $config;

    /** @var PendingRequest */
    protected $client;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->client = Http::baseUrl(self::URL);
    }

    public function lookup(string $zipcode, string $house_number): object
    {
        return $this->client->get('/geo/nld/lookup.json', [
            'postal_code' => $zipcode,
            'street_number' => $house_number,
            'key' => $this->config['api_key'],
        ])->object();
    }
}
