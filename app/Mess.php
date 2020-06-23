<?php

namespace App;

use App\Jobs\SendMessage;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Mess extends Model
{
        public function saveTo($name){
            switch ($name) {
                case "db":
                    $this->save();
                case "file":
                    $this->saveToFile();
                case "email":
                    $this->sendToEmail();



            }
        }
        public function saveToFile(){
            $text='Name: '.$this->name."\n".'Phone: '.$this->phone."\n".'Mess: '.$this->mess;
            Storage::put('file.txt', $text);
            return;

        }
        public function sendToEmail(){
            $jobSend = (new SendMessage($this->mess,$this->name,'amitx@mail.ru'));

            dispatch($jobSend);


        }
}
