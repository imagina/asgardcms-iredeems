<?php

namespace Modules\Iredeems\Events\Handlers;

use Illuminate\Contracts\Mail\Mailer;

use Modules\Iredeems\Emails\Redeem;

class SendRedeem
{

    /**
     * @var Mailer
     */
    private $mail;
    private $setting;

    public function __construct(Mailer $mail)
    {
        $this->mail = $mail;
        $this->setting = app('Modules\Setting\Contracts\Setting');
    }

    public function handle($event)
    {
        $redeem = $event->entity;

        $subject = "Canjeo #".$redeem->id."-".time();
        $view = "iredeems::emails.Redeem";
        $viewUser = "iredeems::emails.RedeemUser";

        $email_to = explode(',', $this->setting->get('icommerce::form-emails'));
        //
        $this->mail->to($email_to[0])->send(new Redeem($redeem,$subject,$view));
        $this->mail->to($redeem->user->email)->send(new Redeem($redeem,$subject,$viewUser));
        // $this->mail->to(["sabascarloseduardo@gmail.com",$email_to[0]])->send(new Redeem($redeem,$subject,$view));

    }



}
