<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;

class RajaOngkirService
{
    protected $client;
    protected $apiKey;
    protected $baseUrl;
    public $available = true;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.rajaongkir.key');
        $this->baseUrl = 'https://api.rajaongkir.com/starter';
    }

    private function handleRequest($method, $endpoint, $params = [])
    {
        try {
            $response = $this->client->request($method, $this->baseUrl . $endpoint, [
                'headers' => ['key' => $this->apiKey],
                'connect_timeout' => 5,
                'timeout' => 10,
            ] + $params);

            return json_decode($response->getBody(), true)['rajaongkir']['results'];
        } catch (ConnectException $e) {
            $this->available = false;
            throw new Exception('Koneksi ke server gagal. Silakan isi alamat manual.');
        } catch (Exception $e) {
            $this->available = false;
            throw new Exception('Terjadi kesalahan. Silakan gunakan input manual.');
        }
    }

    public function getProvinces()
    {
        try {
            return $this->handleRequest('GET', '/province');
        } catch (Exception $e) {
            return [];
        }
    }

    public function getCities($provinceId)
    {
        try {
            return $this->handleRequest('GET', '/city?province=' . $provinceId);
        } catch (Exception $e) {
            return [];
        }
    }

    public function getCost($origin, $destination, $weight, $courier)
    {
        $response = $this->client->post("$this->baseUrl/cost", [
            'headers' => [
                'key' => $this->apiKey
            ],
            'form_params' => [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier
            ]
        ]);

        return json_decode($response->getBody(), true)['rajaongkir']['results'];
    }
}
