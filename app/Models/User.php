<?php

namespace App\Models;

use PDO;
use PDOException;

class User
{
    /** @var PDO */
    private $db;

    public function __construct()
    {
        $this->db = require __DIR__ . '/../../config/database.php';
    }

    /**
     * Autentica um usuário pelo e-mail e senha.
     *
     * @param string $email
     * @param string $password
     * @return array|false Retorna os dados do usuário autenticado ou false em caso de falha.
     */
    public function authenticate(string $email, string $password)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                unset($user['password']); // Remove a senha dos dados retornados
                return $user;
            }
        } catch (PDOException $e) {
            // Log de erro pode ser adicionado aqui
        }

        return false;
    }
}
