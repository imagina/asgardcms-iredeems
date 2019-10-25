<?php

namespace Modules\Iredeems\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Modules\Iredeems\Repositories\RedeemRepository;

class Redeem extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $redeem;
    public $subject;
    public $view;

    public function __construct($redeem,$subject,$view)
    {
        $this->redeem = $redeem;
        $this->subject = $subject;
        $this->view = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view($this->view)
            ->subject($this->subject);
    }
}
