<?php

    namespace App\Models;
    use CodeIgniter\Model;

    class CodeModel extends Model {
        protected $table = 'code_user';
        protected $primaryKey = "id";
        protected $allowedFields = ['code', 'id_user', 'statut', 'date_track'];
        protected $validationRules = [
            'code' => [
                'label' => 'code',
                'rules' => 'required|alpha_numeric|min_length[6]|max_length[12]|is_unique[code.code]'
            ],
            'id_user' => [
                'label' => 'utilisateur',
                'rules' => 'required'
            ],
            'statut' => [
                'label' => 'statut',
                'rules' => 'required|in_list[en attente,valide,refuse]'
            ],
            'date_track' => [
                'label' => 'date de suivi',
                'rules' => 'required|valid_date'
            ]
        ];

        public function getLoadingCodes(){
            return $this->where('statut', 'en attente')->findAll();
        }

        public function getCode($code){
            return $this->select("c.code as cody, montant")
                        ->join('code as c', 'code_user.code = c.code')
                        ->where('c.code', $code) 
                        ->first();              
        }

        public function ValidationRules(){
            return $this->validationRules;
        }

    }

?>