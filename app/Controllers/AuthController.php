<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function loginForm()
    {
        require_once __DIR__ . '/../Views/login.php';
    }

    public function login()
    {
        session_start();

        // Validação básica dos dados recebidos
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';

        if (!$email || empty($password)) {
            $_SESSION['flash'] = 'Preencha todos os campos corretamente.';
            header('Location: /');
            exit;
        }

        $user = new User();
        $auth = $user->authenticate($email, $password);

        if ($auth) {
            $_SESSION['user'] = $auth;
            header('Location: /dashboard');
            exit;
        } else {
            $_SESSION['flash'] = 'Usuário ou senha inválidos.';
            header('Location: /');
            exit;
        }
    }

    public function dashboard()
    {
        session_start();

        if (empty($_SESSION['user'])) {
            header('Location: /');
            exit;
        }

        require_once __DIR__ . '/../Views/dashboard.php';
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }
}