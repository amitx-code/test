<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PHPMailer\PHPMailer\PHPMailer;


class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mess;
    protected $name;
    protected $phone;
    protected $mail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mess,$name,$mail)
    {
        $this->mess=$mess;
        $this->name=$name;
        $this->mail=$mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail = new PHPMailer();
        $mail->IsSendmail();
      //  $mail->Sendmail = 'C:\sendmail\sendmail.exe -t';
        $mail->Subject = 'Новое обращение';
        $mail->setFrom('support@support.ru', 'support@support.ru');
        $mail->CharSet = "utf-8";
        $mail->addAddress( $this->mail, $this->name);
        $mail->Body = $this->mess;

        $t=$mail->send();

        if (!$t) {
            info($mail->ErrorInfo);

        } else {
            info('Message sent!');
            //echo ;
        }


    }
}
