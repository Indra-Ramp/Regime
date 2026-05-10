<?php

namespace App\Models;
use CodeIgniter\Model;

class RegimeModel extends Model {
    protected $table = 'regime';
    protected $primaryKey = "id";
    protected $allowedFields = [
        'perc_viande',
        'perc_poisson',
        'perc_volaille',
        'variation_poids',
        'duree',
        'price'
    ];
    protected $validationRules = [
        'perc_viande' => [
            'label' => 'pourcentage viande',
            'rules' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]'
        ],
        'perc_poisson' => [
            'label' => 'pourcentage poisson',
            'rules' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]'
        ],
        'perc_volaille' => [
            'label' => 'pourcentage volaille',
            'rules' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]'
        ],
        'variation_poids' => [
            'label' => 'variation de poids',
            'rules' => 'required|numeric'
        ],
        'duree' => [
            'label' => 'durée',
            'rules' => 'required|numeric|greater_than[0]'
        ],
        'price' => [
            'label' => 'prix',
            'rules' => 'required|numeric|greater_than_equal_to[0]'
        ]
    ];

}



