<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Edit extends BaseController
{
    public function index()
    {
        if (!$this->session->has('user_id')) {
            return redirect()->to('/login');
        }

        $user = session()->get('user_data');

        if ($user === null) {
            return redirect()->to('/landing')->with('error', 'No se pudieron obtener los datos del usuario.');
        }

        return view('edit', ['user' => $user]);
    }

    public function save()
    {
        if (!$this->session->has('user_id')) {
            return redirect()->to('/login');
        }

        if ($this->request->getMethod() === 'post') {
            $userData = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                // Puedes agregar el campo password si es necesario, pero ten en cuenta que no es seguro almacenar contraseñas en texto plano.
                // 'password' => $this->request->getPost('password'),
            ];

            if (empty($userData['name']) || empty($userData['email'])) {
                return redirect()->to('/edit')->with('error', 'Por favor, complete todos los campos.');
            }

            $userModel = new UserModel();
            $updateStatus = $userModel->update(session()->get('user_id'), $userData);

            if ($updateStatus) {
                session()->set('user_data', $userData);
                return redirect()->to('/edit')->with('success', 'Perfil actualizado con éxito');
            } else {
                return redirect()->to('/home')->with('error', 'No se pudo actualizar el perfil.');
            }
        }

        return redirect()->to('/edit')->with('error', 'Método de solicitud no permitido.');
    }
}
