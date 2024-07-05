<?php

namespace App\Controllers;

class Landing extends BaseController
{
    public function index(): string
    {
        // Verificar si el usuario está autenticado
        if (!session()->has('logged_in') || !session('logged_in')) {
            return redirect()->to('/login'); // Redirigir a la página de inicio de sesión si no está autenticado
        }

        // Obtener el ID del video de la sesión o establecer uno predeterminado
        $video_id = session()->get('video_id', 'UJ0Z8JBFIYw');

        // Cargar la vista de la página de aterrizaje con el ID del video
        return view('landing', ['video_id' => $video_id]);
    }

    // Función para limpiar y validar el URL del video de YouTube
    private function validateYouTubeURL($url)
    {
        if (empty($url)) {
            return "";
        }

        // Expresión regular para validar un enlace de YouTube
        $pattern = '/^(https:\/\/www\.youtube\.com\/embed\/)([\w-]{11})(.*)$/';
        preg_match($pattern, $url, $matches);

        // Si el enlace es válido, devolver el ID del video; de lo contrario, devolver una cadena vacía
        return isset($matches[2]) ? $matches[2] : "";
    }

    // Procesamiento del formulario de actualización del video
    public function updateVideo()
    {
        if ($this->request->getMethod() == "post" && $this->request->getPost('update_video')) {
            // Obtener el nuevo enlace del video desde el formulario
            $new_video_url = $this->request->getPost('video_url');

            // Validar y limpiar el nuevo enlace del video
            $video_id = $this->validateYouTubeURL($new_video_url);

            // Actualizar el enlace del video en la sesión para mostrarlo dinámicamente
            session()->set('video_id', $video_id);
        }

        // Redirigir de vuelta a la página principal
        return redirect()->to('/landing');
    }

    // Procesamiento del formulario de cerrar sesión
    public function logout()
    {
        if ($this->request->getMethod() == "post" && $this->request->getPost('logout')) {
            // Destruir todas las variables de sesión
            session()->destroy();

            // Redirigir a la página de inicio de sesión
            return redirect()->to('/login');
        }

        // Redirigir de vuelta a la página principal
        return redirect()->to('/register');
    }
}
