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
        
        public function userCountEvolution(){
            return $this->select('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(id) as count')
                    ->groupBy('month')
                    ->orderBy('month', 'ASC')
                    ->get()
                    ->getResultArray();
        }
    
        public function connectAsAdmin($email){
            $emailMatch = $this->where('email', $email)->first();
            if($emailMatch != NULL && $emailMatch['id_role'] == 1){
                return true;
            }
            return false;
        }
    }
?>