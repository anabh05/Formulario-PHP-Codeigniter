<?php

namespace App\Controllers;

use App\Models\UserModel;

class Edit extends BaseController
{
    public function index()
    {
        // Verificar si el usuario está logueado
        if (!$this->session->has('user_id')) {
            return redirect()->to('/login');
        }

        // Obtener el ID del usuario desde la sesión
        $userId = $this->session->get('user_id');

        // Obtener datos del usuario desde la base de datos
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        // Verificar si se obtuvieron los datos del usuario
        if ($user === null) {
            return redirect()->to('/edit')->with('error', 'No se pudieron obtener los datos del usuario.');
        }

        // Establecer los datos del usuario en la sesión
        $this->session->set('user_data', $user);

        return view('edit', ['user' => $user]);
    }

    public function save()
    {
        // Verificar si el usuario está logueado
        if (!$this->session->has('user_id')) {
            return redirect()->to('/login');
        }

        // Verificar si el método de solicitud es POST
        if ($this->request->getMethod() == 'post') {
            // Obtener datos desde el formulario
            $userData = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                // Agrega más campos según sea necesario
            ];

            // Obtener el ID del usuario desde la sesión
            $userId = $this->session->get('user_id');

            // Actualizar datos del usuario en la base de datos
            $userModel = new UserModel();
            $userModel->update($userId, $userData);

            // Actualizar datos en la sesión
            $this->session->set('user_data', $userModel->find($userId));

            return redirect()->to('/edit')->with('success', 'Perfil actualizado con éxito');
        }

        return redirect()->to('/edit');
    }
}
