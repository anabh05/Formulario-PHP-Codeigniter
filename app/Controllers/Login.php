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
        // Mostrar el formulario de login
        return view('login');
    }
    public function process()
    {

        // Procesar el formulario de login
        $email = $this->request->getPost('email');
        $password = strval($this->request->getPost('password')); // Convertir a cadena explícitamente

        // Obtener el usuario por email
        $user = $this->userModel->getUserByEmail($email);

        // Verificar si la contraseña es correcta utilizando operador ternario
        $isPasswordCorrect = $user && is_string($password) && password_verify($password, $user['password']);

        if ($isPasswordCorrect) {
            // Iniciar sesión y redirigir a la página de inicio
            session()->set('user_id', $user['id']);
            $message = "Logeo exitoso";
            return view('landing', ['message' => $message]);
        } else {
            // Mostrar error de login
            $data['message'] = 'Email o contraseña incorrectos';
            return view('login', $data);
        }
    }


    public function logout()
    {
        // Cerrar sesión y redirigir al login
        session()->destroy();
        return redirect()->to('login');
    }
}
