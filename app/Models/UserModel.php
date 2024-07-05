<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Clave primaria de la tabla
    protected $allowedFields = ['name', 'email', 'password']; // Campos que se pueden insertar/actualizar

    // Callbacks
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];


    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    /**
     * Método para obtener un usuario por su correo electrónico.
     *
     * @param string $email
     * @return array|null
     */


    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Método para guardar un nuevo usuario en la base de datos.
     *
     * @param array $data
     * @return int|false ID del usuario insertado o false si falla
     */



    public function saveUser($data)
    {
        try {
            return $this->insert($data);
        } catch (\Exception $e) {
            // Manejar el error de duplicación
            if ($this->db->error()['code'] == 1062) {
                return false;
            } else {
                throw $e;
            }
        }
    }
}
