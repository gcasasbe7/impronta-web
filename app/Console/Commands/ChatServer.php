<?php

namespace App\Console\Commands;

use App\Classes\Socket\ChatSocket;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;


class ChatServer extends Command {

    protected $signature = 'ws_server:serve';

    protected $description = 'Open Ratchet';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle() {

        $this->info("Web Socket service started!");

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new ChatSocket()
                )
            ),
            8080
        );

        $server->run();
    }
}