<?php

namespace Modules\Iredeems\Events;

use Illuminate\Queue\SerializesModels;

class RedeemWasCreated
{
    use SerializesModels;

    public $data;
    public $entity;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($entity,array $data)
    {
      $this->data=$data;
      $this->entity=$entity;
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
