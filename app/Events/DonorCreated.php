<?php

namespace App\Events;

use App\Models\Donor;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class DonorCreated implements ShouldBroadcast
{
    use SerializesModels;

    public $donor;

    public function __construct(Donor $donor)
    {
        $this->donor = $donor;
    }

    public function broadcastOn()
    {
        return new Channel('donor-channel');
    }

    public function broadcastAs()
    {
        return 'donor.created';
    }
}
