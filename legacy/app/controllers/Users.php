<?php
class Users extends Controller {
    public function __construct(){
        $this->userModel = $this->model('User');
    }

    public function register(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
  
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            // Init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate Email
            if(empty($data['email'])){
                $data['email_err'] = 'Veuillez entrer un email';
            } else {
                // Check email
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'Cet email est déjà pris';
                }
            }

            // Validate Name
            if(empty($data['name'])){
                $data['name_err'] = 'Veuillez entrer un nom';
            }

            // Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Veuillez entrer un mot de passe';
            } elseif(strlen($data['password']) < 6){
                $data['password_err'] = 'Le mot de passe doit avoir au moins 6 caractères';
            }

            // Validate Confirm Password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Veuillez confirmer le mot de passe';
            } else {
                if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Les mots de passe ne correspondent pas';
                }
            }

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                // Validated
                
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if($this->userModel->register($data)){
                    // Flash message needs helper, doing simple redirect for now
                    header('location: ' . URLROOT . '/users/login');
                } else {
                    die('Une erreur est survenue');
                }

            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }

        } else {
            // Init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }

    public function login(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
  
            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',      
            ];

            // Validate Email
            if(empty($data['email'])){
                $data['email_err'] = 'Veuillez entrer un email';
            }

            // Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Veuillez entrer un mot de passe';
            }

            // Check for user/email
            if($this->userModel->findUserByEmail($data['email'])){
                // User found
            } else {
                // User not found
                $data['email_err'] = 'Aucun utilisateur trouvé avec cet email';
            }

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['password_err'])){
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if($loggedInUser){
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Mot de passe incorrect';
                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }


        } else {
            // Init data
            $data = [    
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',        
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user){
        // Secure way to start session already handled in config? Need to add session_start in init
        // We will add session helper later, using raw $_SESSION for now
        if(session_status() === PHP_SESSION_NONE) session_start();

        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_role'] = $user->role;

        header('location: ' . URLROOT . '/pages/index');
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        session_destroy();
        header('location: ' . URLROOT . '/users/login');
    }
}
