<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Mailer\Email;

class MailComponent extends Component
{
    /**
     * [sendUserEmail description]
     * @param $to
     * @param $subject
     * @param $msg
     */
    public function sendUserEmail($to,$subject,$msg)
    {
       $email = new Email('default');
       $email->template('welcome')
            ->emailFormat('both')
            ->transport('gmail')
            ->from('admin@buramo.com')
            ->to($to)
            ->subject($subject)
            ->emailFormat('html')
            ->viewVars(['value' => $msg])
            ->send();
    }

    /**
     * [sendFortuneEmail description]
     * @param $to
     * @param $subject
     * @param $msg
     */
    public function sendFortuneEmail($to,$subject,$msg)
    {
       $email = new Email('default');
       $email->template('welcome')
            ->emailFormat('both')
            ->transport('gmail')
            ->from('admin@buramo.com')
            ->to($to)
            ->subject($subject)
            ->emailFormat('html')
            ->viewVars(['value' => $msg])
            ->send();
    }


}
