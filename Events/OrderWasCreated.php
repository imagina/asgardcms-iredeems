<?php

namespace Modules\Iredeems\Events;

use Illuminate\Queue\SerializesModels;

class OrderWasCreated
{
    use SerializesModels;

    public  $data;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
      $this->data=$data;
    }

    /**
     * Return the ALL data sent
     * @return array
     */

    public function getSubmissionData()
    {
        return $this->data;
    }
    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
