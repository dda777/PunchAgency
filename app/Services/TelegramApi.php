<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class TelegramApi
{
    private string $apiUrl;
    private Client $client;

    public function __construct(string $token)
    {
        $this->apiUrl = 'https://api.telegram.org/bot' . $token . '/';
        $this->client = new Client();
    }

    /**
     * @throws GuzzleException
     */
    public function sendMessage(int $chatId, string $message): array
    {
        $url = $this->apiUrl . 'sendMessage';
        $data = [
            'chat_id' => $chatId,
            'text' => $message,
        ];

        return $this->makeRequest($url, $data);
    }

    /**
     * @throws GuzzleException
     */
    private function makeRequest(string $url, array $data): array
    {
        $response = $this->client->post($url, [
            'form_params' => $data
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
