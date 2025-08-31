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
    public function createAccount(array $data): ?string
    {
        $token = $this->getAdminToken();

        $url = "{$this->baseUrl}/admin/realms/{$this->realm}/users";

        $payload = [
            "username" => $data['username'] ?? $data['email'],
            "enabled"  => true,
            "email"    => $data['email'],
            "firstName" => $data['name'],
            "lastName" => $data['last_name'],
            "credentials" => [
                [
                    "type"      => "password",
                    "value"     => $data['password'],
                    "temporary" => false
                ]
            ],
            "requiredActions" => ["VERIFY_EMAIL"]
        ];

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_RETURNTRANSFER => true,
            // NOVO: Habilita a inclusão dos cabeçalhos na string de resposta
            CURLOPT_HEADER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ]
        ]);

        $response = curl_exec($ch);

        if ($response === false) {
            throw new \Exception("Erro no cURL: " . curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // NOVO: Pega o tamanho do cabeçalho para poder separar do corpo
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        curl_close($ch);

        // NOVO: Separa a string de cabeçalho da string do corpo
        $headerStr = substr($response, 0, $headerSize);
        $bodyStr = substr($response, $headerSize);

        if ($httpCode !== 201) { // Sucesso na criação é SEMPRE 201 quando retorna 'Location'
            throw new \Exception("Erro ao criar usuário no Keycloak: " . $bodyStr, $httpCode);
        }

        // NOVO: Processa os cabeçalhos para encontrar o 'Location'
        $headers = explode("\r\n", $headerStr);
        $locationUrl = null;
        foreach ($headers as $header) {
            if (stripos($header, 'Location:') !== false) {
                $locationUrl = trim(substr($header, strlen('Location:')));
                break;
            }
        }

        if ($locationUrl) {
            // NOVO: Extrai a última parte da URL, que é o ID do usuário
            $userId = basename($locationUrl);
            $this->sendVerificationEmail($userId);
            return $userId;
        }

        // Se chegou aqui, algo deu errado e o header Location não foi encontrado
        throw new \Exception("Usuário criado, mas não foi possível extrair o ID do cabeçalho de resposta.");
    }


    private function sendVerificationEmail(string $userId): void
    {
        $token = $this->getAdminToken();

        // 🔗 monta a URL com client_id + redirect_uri
        $url = "{$this->baseUrl}/admin/realms/{$this->realm}/users/{$userId}/execute-actions-email"
            . '?client_id=animio'
            . '&redirect_uri=' . urlencode("http://localhost:8080/login-success?uid={$userId}");

        $payload = ["VERIFY_EMAIL"];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ]
        ]);

        $response = curl_exec($ch);
        if ($response === false) {
            throw new \Exception("Erro ao enviar e-mail de verificação: " . curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 204) {
            throw new \Exception("Erro ao enviar e-mail de verificação: " . $response, $httpCode);
        }
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
