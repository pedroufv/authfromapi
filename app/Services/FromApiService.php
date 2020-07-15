<?php

namespace App\Services;

use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Config;
use Psr\Http\Message\ResponseInterface;
use stdClass;

class FromApiService
{
    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => Config::get('auth_from_api.base_url'),
            'headers' => ['Accept' => 'application/json'],
        ]);
    }

    /**
     * @param string $url
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function get(string $url): ResponseInterface
    {
        return $this->client->get($url);
    }

    /**
     * @param string $url
     * @param array $data
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function post(string $url, array $data): ResponseInterface
    {
        return $this->client->post($url, $data);
    }

    /**
     * @param string $url
     * @param array $data
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function put(string $url, array $data): ResponseInterface
    {
        return $this->client->put($url, $data);
    }

    /**
     * @param int $id
     *
     * @return User
     * @throws GuzzleException
     */
    public function getUser(int $id): object
    {
        $response = $this->client->get('users/'.$id);

        $content = json_decode($response->getBody()->getContents());

        return User::updateOrCreate(['email' => $content->email], [
            'name' => $content->name,
            'email' => $content->email,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
    }
}
