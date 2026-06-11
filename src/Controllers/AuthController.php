<?php

namespace App\Controllers;
use App\Controllers\DashboardController;
use App\Core\View;

class AuthController 
{
    public function login()
    {
        View::render('auth/login');
    }
    public function autenticar()
    {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        session_start();
        if (isset($_SESSION['usuario'])) {
            header('Location: /prosaude/dashboard');
            exit;
        }
        // Validar entrada
        if (empty($email) || empty($senha)) {
            View::render('auth/login', ['title' => 'ProSaúde'], 'public');
        }
        
        // TODO: Implementar validação no banco de dados
        // $usuario = Usuario::where('email', $email)->first();
        // if ($usuario && password_verify($senha, $usuario->senha)) {
        
        // Aqui você deve implementar a lógica de autenticação
        if ($this->validarCredenciais($email, $senha)) {
            session_start();
            
            // Regenerar ID de sessão para evitar session fixation
            session_regenerate_id(true);
            
            // Armazenar dados do usuário com chave padronizada
            $_SESSION['usuario'] = $email;
            $_SESSION['LAST_ACTIVITY'] = time();
            header('Location: /prosaude/dashboard');
            exit;
        }
    }
    
    private function validarCredenciais($email, $senha): bool
    {
        // TODO: Implementar validação real no banco de dados
        // Por enquanto, validação básica
        return !empty($email) && !empty($senha);
    }
    public function logout()
    {
        session_start();
        session_destroy();
        View::render('home/index', ['title' => 'ProSaúde'], 'public');
    }
}