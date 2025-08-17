<?php

namespace App\Libraries;

class KeycloakService
{
    private string $baseUrl;
    private string $realm;
    private string $username;
    private string $password;
    private string $clientId;
    private string $clientSecret;

    public function __construct()
    {
        $this->baseUrl      = env('keycloak.baseUrl');
        $this->realm        = env('keycloak.realm');
        $this->username     = env('keycloak.username');
        $this->password     = env('keycloak.password');
        $this->clientId     = env('keycloak.clientId');
        $this->clientSecret = env('keycloak.secret');
    }

    private function getAdminToken(): string
    {
        $url = "{$this->baseUrl}/realms/{$this->realm}/protocol/openid-connect/token";

        $data = [
            'grant_type'    => 'password',
            'client_id'     => $this->clientId,
            'username'      => $this->username,
            'password'      => $this->password,
            'client_secret' => $this->clientSecret,
        ];

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded'
            ]
        ]);

        $response = curl_exec($ch);

        if ($response === false) {
            throw new \Exception("Erro no cURL: " . curl_error($ch));
        }

        curl_close($ch);

        $json = json_decode($response, true);

        if (isset($json['access_token'])) {
            return $json['access_token'];
        }

        throw new \Exception("Erro ao obter token: " . $response);
    }


    public function login($email, $password): array
    {
        $url = "{$this->baseUrl}/realms/{$this->realm}/protocol/openid-connect/token";

        $data = [
            'grant_type'    => 'password',
            'client_id'     => $this->clientId,
            'username'      => $email,
            'password'      => $password,
            'client_secret' => $this->clientSecret,
        ];

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded'
            ]
        ]);

        $response = curl_exec($ch);

        if ($response === false) {
            return [
                'success' => false,
                'message' => "Erro no cURL: " . curl_error($ch)
            ];
        }

        curl_close($ch);

        $json = json_decode($response, true);

        if (isset($json['access_token'])) {
            return [
                'success' => true,
                'token' => $json['access_token']
            ];
        }

        // Captura erro do Keycloak
        if (isset($json['error'])) {
            return [
                'success' => false,
                'error' => $json['error'],
                'message' => $json['error_description'] ?? 'Erro desconhecido'
            ];
        }

        // Caso não tenha nem token nem erro (resposta inesperada)
        return [
            'success' => false,
            'message' => 'Resposta inesperada do Keycloak: ' . $response
        ];
    }
}
