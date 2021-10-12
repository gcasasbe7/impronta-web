<?php

namespace App\Classes\Socket;

use App\Classes\Socket\Base\BaseSocket;
use Ratchet\ConnectionInterface;

class ChatSocket extends BaseSocket
{
//    protected $clients;
//    private $connectedUsers = [];
    private $userSocket = [];

    public function __construct()
    {
//        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn){
//        $this->clients->attach($conn);
//        $this->connectedUsers[$conn->resourceId] = $conn;

        echo "\nNew connection! ({$conn->resourceId}) \n";
    }

    public function onMessage(ConnectionInterface $conn, $msg){
        $data = json_decode($msg);
        switch ($data->type) {
            case "hello":
                $this->userSocket[$data->user_id] = $conn;
                echo "===================================\n";
                echo "SE HA REGISTRADO UN NUEVO USUARIO:\n";
                echo "ID DE WEBSOCKET: " . $conn->resourceId . "\n";
                echo "ID DE SERVIDOR: " . $data->user_id . "\n";
                echo "===================================\n";
                break;

            case "order":
                $adminSocket = $this->userSocket[1];
                $adminSocket->send("Nuevo pedido del usuario con ID: " . $data->user_id);
                break;

            case "book":
                $adminSocket = $this->userSocket[1];
//                $adminConn = $this->connectedUsers[$adminSocket];
                $adminSocket->send("Nueva reserva del usuario con ID: " . $data->user_id);
                break;

            case "bookResponse":
                $userSocket = $this->userSocket[$data->user_id];
                $userSocket->send("Tu reserva para el dia " . $data->book_date . " ha sido " . $data->response);
                break;

            case "orderResponse":
                $userSocket = $this->userSocket[$data->user_id];
                $userSocket->send("Tu pedido con el número " . $data->order_id . " está " . $data->response);
                break;

        }
    }

    public function onClose(ConnectionInterface $conn)
    {
//        $this->clients->detach($conn);
//        unset($this->connectedUsers[$conn->resourceId]);

        echo "Connection {$conn->resourceId} has disconnected from the server\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has ocurred!: {$e->getMessage()}\n";
    }


}