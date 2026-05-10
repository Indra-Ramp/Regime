<?php

    namespace App\Models;
    use CodeIgniter\Model;

    class SuiviSanteModel extends Model {
        protected $table = "suivi_sante";
        protected $primaryKey = "id";
        protected $allowedFields = ['id_user', 'poids', 'taille'];

        protected $validationRules = [
            'id_user' => 'required',
            'poids' => 'required|decimal',
            'taille' => 'required|decimal'
        ];
    }

?>