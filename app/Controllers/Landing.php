<?php

namespace App\Controllers;

class Landing extends BaseController
{

    public function index()
    {

        // if (!session()->has('logged_in') || !session('logged_in')) {
        //     return redirect()->to('/login');
        // }

        if (!session()->has('user_id') || !session('user_id')) {
            return redirect()->to('/landing');
        }

        //$username = session()->get('username');
        $user = session()->get('user_data');


        // ID DEL VIDEO
        $video_id = session()->get('video_id', 'UJ0Z8JBFIYw');

        return view('landing', ['video_id' => $video_id]);
    }

    // VALIDAR URL VIDEO
    public function validateYouTubeURL($url)
    {
        if (empty($url)) {
            return "";
        }

        // VALIDAR ENLACE
        $pattern = '/^(https:\/\/www\.youtube\.com\/embed\/)([\w-]{11})(.*)$/';
        preg_match($pattern, $url, $matches);


        return isset($matches[2]) ? $matches[2] : "";
    }

    // VIDEO
    public function updateVideo()
    {
        if ($this->request->getMethod() == "post" && $this->request->getPost('update_video')) {

            $new_video_url = $this->request->getPost('video_url');

            $video_id = $this->validateYouTubeURL($new_video_url);

            session()->set('video_id', $video_id);
        }

        // Redirigir de vuelta a la página principal
        return redirect()->to('/landing');
    }

    // CERRAR SESION
    public function logout()
    {
        if ($this->request->getMethod() == "post" && $this->request->getPost('logout')) {

            session()->destroy();

            return redirect()->to('/login');
        }


        return redirect()->to('/');
    }
}
