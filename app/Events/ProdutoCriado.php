<?php

namespace App\Events;

use App\Models\Produtos;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProdutoCriado implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $produto;

    public function __construct(Produtos $produto)
    {
        $this->produto = $produto;
    }

    public function broadcastOn()
    {
        return new Channel('produtos');
    }

    public function broadcastAs()
    {
        return 'produto.criado';
    }
}