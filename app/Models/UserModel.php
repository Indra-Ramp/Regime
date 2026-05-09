<?php

    namespace App\Models;
    use CodeIgniter\Model;

    class UserModel extends Model {
        protected $table = 'user';
        protected $primaryKey = 'id';
        protected $allowedFields = ['nom', 'prenom', 'email', 'genre', 'password_hash', 'id_role'];
        protected $validationRules = [
            'register' => [
                'nom' => [
                    'label' => 'nom',
                    'rules' => 'required|min_length[3]'
                ],
                'prenom' => [
                    'label' => 'prenom',
                    'rules' => 'required|min_length[3]'
                ],
                'email' => [
                    'label' => 'email',
                    'rules' => 'required|valid_email'
                ],
                'genre' => [
                    'label' => 'genre',
                    'rules' => 'required'
                ],
                'password_hash' => [
                    'label' => 'mot de passe',
                    'rules' => 'required|min_length[4]'
                ]
            ],
            'login' => [
                'email' => [
                    'label' => 'email',
                    'rules' => 'required|valid_email'
                ],
                'password_hash' => [
                    'label' => 'mot de passe',
                    'rules' => 'required|min_length[4]'
                ]
            ]
        ];
    }

?>