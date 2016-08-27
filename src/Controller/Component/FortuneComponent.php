<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Mailer\Email;

class FortuneComponent extends Component
{
    public function getUserAuthor()
    {
          return "Checjk";
    }

    public function FortuneCheckIsTime($id = null, $day = null, $time = null)
    {
    	dump('ok');die;
    }
}