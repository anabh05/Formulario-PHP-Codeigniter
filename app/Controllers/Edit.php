<?php

namespace App\Controllers;

class Edit extends BaseController
{
    public function index()
    {
        // Verificar si el usuario está logueado
        if (!$this->session->has('user_id')) {
            return redirect()->to('/login');
        }

        // Obtener datos del usuario desde la sesión o la base de datos
        $user = session()->get('user_data');

        // Verificar si user_data está definido
        if ($user === null) {
            return redirect()->to('/landing')->with('error', 'No se pudieron obtener los datos del usuario.');
        }

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
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                // Agrega más campos según sea necesario
            ];

            // Actualizar datos del usuario en la base de datos
            $userModel = new \App\Models\UserModel();
            $userModel->update(session()->get('user_id'), $userData);

            // Actualizar datos en la sesión
            session()->set('user_data', $userData);

            return redirect()->to('/edit')->with('success', 'Perfil actualizado con éxito');
        }

        return redirect()->to('/edit');
    }
}
