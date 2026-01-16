<?php
class Pages extends Controller {
    public function __construct(){
        
    }

    public function index(){
        $data = [
            'title' => 'Gestion Club Sportif',
            'description' => 'Bienvenue sur l\'application de gestion de votre club sportif.'
        ];

        $this->view('pages/index', $data);
    }

    public function about(){
        $data = [
            'title' => 'A propos',
            'description' => 'Application pour gérer les membres, entrainements et événements.'
        ];

        $this->view('pages/about', $data);
    }
}
