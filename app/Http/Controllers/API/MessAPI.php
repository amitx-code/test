<?php

namespace App\Http\Controllers\API;

use App\Factory\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class MessAPI extends Controller
{
    public function index()
    {

    }

    public function show($id)
    {

    }

    public function store(Request $request)
    {
        $dat=$request->all();
        $messages = [
            'name.required' => 'Не заполнено поле имя',
            'name.max' => 'Поле имя не должно быть больше 20 символов',
            'phone.required' => 'Не заполнено поле телефон',
            'name.phone' => 'Поле телефон не должно быть больше 20 символов',
            'mess.required' => 'Не заполнено поле сообщение',
        ];
        $validator = Validator::make($dat, [
            'name' => 'required|max:20',
            'phone' => 'required|max:20',
            'mess' => 'required',





        ],$messages);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'result' => false,
                'errors' => $errors,

            ]);
        }
        $messFactory = new Factory();
        $mess=$messFactory->make('mess');
        $mess->name=$dat['name'];
        $mess->phone=$dat['phone'];
        $mess->mess=$dat['mess'];
        $result=$mess->saveTo('db');
        $result=$mess->saveTo('file');
        $result=$mess->saveTo('email');


        return response()->json([
            'result' => $result,


        ]);
    }

    public function update(Request $request, $id)
    {
     //   dd($request);
    }

    public function delete(Request $request, $id)
    {

    }
}
