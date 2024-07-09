<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['url', 'form']);
    }


    public function index()
    {
        return view('login');
    }
    public function process()
    {

        $email = $this->request->getPost('email');
        $password = strval($this->request->getPost('password'));


        $user = $this->userModel->getUserByEmail($email);

        $isPasswordCorrect = $user && is_string($password) && password_verify($password, $user['password']);

        if ($isPasswordCorrect) {

            session()->set('user_id', $user['id']);
            $message = "Logeo exitoso";
            return view('landing', ['message' => $message]);
        } else {

            $data['message'] = 'Email o contraseña incorrectos';
            return view('login', $data);
        }
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('home');
    }
}
