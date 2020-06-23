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
                    return $this->save();
                case "file":
                   return $this->saveToFile();
                case "email":
                    return $this->sendToEmail();



            }
        }
        public function saveToFile(){
            $text='Name: '.$this->name."\n".'Phone: '.$this->phone."\n".'Mess: '.$this->mess;
            Storage::put('file.txt', $text);
            return true;

        }
        public function sendToEmail(){
            $jobSend = (new SendMessage($this->mess,$this->name,'amitx@mail.ru'));

            dispatch($jobSend);

            return true;
        }
}
