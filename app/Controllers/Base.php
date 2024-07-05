<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Base extends Controller
{
    public function __construct()
    {
        // Cargar el helper de base de datos si es necesario
        helper('database');
    }

    public function index(): string
    {
        return view('base');
    }
}
