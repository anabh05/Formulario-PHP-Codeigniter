<?php

namespace App\Controllers;

use App\Models\UserModel;

class Edit extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index(): string
    {
        if (!session()->has('logged_in') || !session('logged_in')) {
            return redirect()->to('/login');
        }

        // Obtener el ID de usuario desde la sesión
        $userId = session()->get('user_id');

        // Obtener los datos del usuario desde el modelo
        $userModel = new UserModel();
        $userData = $userModel->find($userId);

        // Verificar si se encontraron los datos del usuario
        if (!$userData) {
            return redirect()->to('/login')->with('error', 'Usuario no encontrado');
        }

        // Pasar los datos del usuario a la vista de edición
        return view('edit', ['userData' => $userData]);
    }

    public function save(): string
    {
        $userModel = new UserModel();

        // Obtener el ID de usuario desde la sesión
        $userId = session()->get('user_id');

        // FORMULARIO DATOS
        $data = [
            'id' => $userId, // Asegurarse de incluir el ID del usuario
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];

        // GUARDAR
        if ($userModel->updateUser($userId, $data)) {
            $message = "Usuario editado con éxito " . esc($data['name']);
        } else {
            $db = \Config\Database::connect();
            $error = $db->error();
            $message = "Error al actualizar el usuario: " . $error['message'];
        }

        return view('edit-users', ['message' => $message]);
    }
}
