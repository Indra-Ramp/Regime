<?php
    namespace App\Models;

    use CodeIgniter\Model;

    class ProfilModel extends Model{
        protected $table = 'profil';
        protected $primaryKey = 'id';
        protected $allowedFields = [
            'id_user',
            'telephone',
            'date_naissance'
        ];

        protected $validationRules=[
            'telephone' => 'required',
            'date_naissance' => 'required|valid_date[Y-m-d]',
        ];

        
    }
