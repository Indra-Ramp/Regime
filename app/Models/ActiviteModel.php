<?php

    namespace App\Models;
    use CodeIgniter\Model;

    class ActiviteModel extends Model {
        protected $table = 'activite_sportive';
        protected $primaryKey = "id";
        protected $allowedFields = ['label', 'variation_poids', 'frequence'];
        protected $validationRules = [
            'label' => [
                'label' => 'label',
                'rules' => 'required|min_length[3]'
            ],
            'variation_poids' => [
                'label' => 'variation de poids',
                'rules' => 'required|numeric'
            ],
            'frequence' => [
                'label' => 'fréquence',
                'rules' => 'required|numeric'
            ]
        ];

    }

?>