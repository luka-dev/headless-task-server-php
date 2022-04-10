<?php

namespace LuKa\HeadlessTaskServerPhp;

class Server
{
    /** @var string HTTP/S link to the executive server */
    private $address;

    /** @var string|null Secret AUTH_KEY if exist*/
    private $authKey;

    public function __construct(string $address, ?string $authKey = null)
    {
        $this->address = rtrim($address, '/');
        $this->authKey = $authKey;
    }

    /** @return bool */
    public function isAlive(): bool
    {
        $curl = curl_init($this->address);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        if (curl_error($curl)) {
            curl_close($curl);
            return false;
        }
        curl_close($curl);

        return $response === '{"health":"ok"}';
    }

    /**
     * @param Task $task
     * @param Options|null $options
     * @return Response
     * @throws \Exception
     */
    public function runTask(Task $task, ?Options $options = null): Response
    {
        $headers = [
            'Content-Type:application/json'
        ];

        if ($this->authKey !== null) {
            $headers[] = 'Authorization:'.$this->authKey;
        }

        $curl = curl_init($this->address . '/task');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $curl, CURLOPT_POSTFIELDS, json_encode([
            'options' => $options,
            'script' => $task
        ]));

        $response = curl_exec($curl);
        if (curl_error($curl)) {
            curl_close($curl);
            throw new \Exception('No response from the task-server');
        }
        curl_close($curl);

        return new Response($response);
    }
}