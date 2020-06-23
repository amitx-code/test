<?php

namespace App\Factory;
use App\Mess;
use App\User;

class Factory
{
    public function make($name)
    {
        switch ($name) {
            case "mess":
                return new Mess();
            case "user":
                return new User();

        }
    }
}