<?php

namespace App\Controllers;

use App\Models\UserModel;

class Register extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index(): string
    {
        return view('register');
    }

    public function save(): string
    {
        $userModel = new UserModel();

        // FORMILARIO DATOS
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];


        // GUARDADO
        if ($userModel->saveUser($data)) {

            $message = "Registro exitoso para " . esc($data['name']);
        } else {

            $db = \Config\Database::connect();
            $error = $db->error();
            $message = "Error al registrar el usuario: " . $error['message'];
        }


        return view('register', ['message' => $message]);
    }
}
