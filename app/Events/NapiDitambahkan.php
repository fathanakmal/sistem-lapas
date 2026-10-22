<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NapiDitambahkan implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $totalNapiAktif;

    // Menerima data total napi saat event dipanggil
    public function __construct($totalNapiAktif)
    {
        $this->totalNapiAktif = $totalNapiAktif;
    }

    // Menentukan "saluran radio" (channel) tempat event ini disiarkan
    public function broadcastOn(): array
    {
        return [
            new Channel('lapas-channel'),
        ];
    }
}