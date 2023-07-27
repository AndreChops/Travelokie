<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'email';

    // User login data verification
    public function login($email, $password)
    {
        $this->db->transBegin();
        $query = $this->db->query("SELECT * FROM user");
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return FALSE;
        }

        $this->db->transCommit();
        $result = $query->getResultArray();

        foreach ($result as $row) {
            if ($email == $row['email']) {
                if (md5($password) == $row['password']) {
                    return $row;
                }
            }
        }

        return NULL;
    }

    // Get all user
    public function getUsers()
    {
        $this->db->transBegin();
        $query = $this->db->query("SELECT * FROM user");
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return FALSE;
        }

        $this->db->transCommit();
        $row = $query->getResultArray();

        return $row;
    }

    // Get user data with email as parameter
    public function getUserWhereEmail($email)
    {
        $this->db->transBegin();
        $query = $this->db->query("SELECT * FROM user WHERE email = :email:", ['email' => $email]);
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return FALSE;
        }

        $this->db->transCommit();
        $row = $query->getRowArray();

        return $row;
    }

    // Register a new user
    public function register($role, $firstName, $lastName, $email, $password, $tanggalLahir, $nomorTelepon, $pathFoto)
    {
        $this->db->transBegin();

        $sql = "INSERT INTO user (role, firstName, lastName, email, password, tanggalLahir, nomorTelepon, pathFoto) VALUES (:role:, :firstName:, :lastName:, :email:, :password:, :tanggalLahir:, :nomorTelepon:, :pathFoto:)";
        $data = [
            'role' => $role,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => $password,
            'tanggalLahir' => $tanggalLahir,
            'nomorTelepon' => $nomorTelepon,
            'pathFoto' => $pathFoto
        ];

        $this->db->query($sql, $data);
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return FALSE;
        }

        $this->db->transCommit();
        return TRUE;
    }

    // Edit a user's profile with email parameter and other data
    public function editUser($firstName, $lastName, $email, $password, $tanggalLahir, $nomorTelepon, $pathFoto)
    {
        $this->db->transBegin();

        $sql = "UPDATE user SET firstName = :firstName:, lastName = :lastName:, password = :password:, tanggalLahir = :tanggalLahir:, nomorTelepon = :nomorTelepon:";
        $sql .= ($pathFoto !== NULL) ? ", pathFoto = :pathFoto:" : "";
        $sql .= " WHERE email = :email:";
        $data = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => $password,
            'tanggalLahir' => $tanggalLahir,
            'nomorTelepon' => $nomorTelepon,
            'pathFoto' => $pathFoto
        ];

        $this->db->query($sql, $data);
        $this->db->query("SELECT * FROM user WHERE email = :email:", ['email' => $email]);
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return FALSE;
        }

        $this->db->transCommit();
        return $this->getUserWhereEmail($email);
    }

    // Delete a user with email parameter
    public function deleteUser($email)
    {
        $this->db->transBegin();
        $this->db->query("DELETE FROM User WHERE email = :email:", ['email' => $email]);
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return FALSE;
        }

        $this->db->transCommit();
        return TRUE;
    }
}
