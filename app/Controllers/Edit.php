<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

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
        if (!$this->session->has('user_id')) {
            return redirect()->to('/login');
        }

        if ($this->request->getMethod() === 'post') {
            // Log request method and CSRF token
            error_log("Request Method: " . $this->request->getMethod());
            error_log("CSRF Token from POST: " . $this->request->getPost('csrf_test_name'));
            error_log("CSRF Token from Cookie: " . $this->request->getCookie('csrf_cookie_name'));

            $userData = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),

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
                return redirect()->to('/edit')->with('error', 'No se pudo actualizar el perfil.');
            }
        }

        return redirect()->to('/edit')->with('error', 'Método de solicitud no permitido.');
    }

    public function delete()
    {
        if ($this->request->getMethod() === 'post') {
            $userId = $this->session->get('user_id');
            $userModel = new UserModel();

            if ($userModel->delete($userId)) {
                session()->destroy();
                return redirect()->to('/login')->with('success', 'Usuario borrado con éxito.');
            } else {
                return redirect()->to('/edit')->with('error', 'No se pudo borrar el usuario.');
            }
        }

        return redirect()->to('/edit')->with('error', 'Método de solicitud no permitido.');
    }
}
