<?php

namespace App\Repositories\Register;


use App\Models\User;

class RegisterRepository implements RegisterInterface
{
    public function store($data = [])
    {
       $user = new User();
       $user->name = $data['name'];
       $user->email = $data['email'];
       $user->password = $data['password'];
       $user->save();
    }
}
