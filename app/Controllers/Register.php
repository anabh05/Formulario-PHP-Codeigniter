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

        // Obtener datos del formulario
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];


        // Guardar los datos en la base de datos
        if ($userModel->saveUser($data)) {
            // Preparar el mensaje de éxito
            $message = "Registro exitoso para " . esc($data['name']);
        } else {
            // Preparar el mensaje de error con detalles específicos
            $db = \Config\Database::connect();
            $error = $db->error();
            $message = "Error al registrar el usuario: " . $error['message'];
        }

        // Mostrar el mensaje en la vista 'register'
        return view('register', ['message' => $message]);
    }
}
