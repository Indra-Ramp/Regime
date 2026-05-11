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
     public function getSuggestions($objectifLabel, $imc)
    {
        $objectifLabel = strtolower($objectifLabel);

        // Déterminer le filtre selon l'objectif
        if (str_contains($objectifLabel, 'perdre')) {
            return $this->where('variation_poids <', 0)->findAll();
        }

        if (str_contains($objectifLabel, 'prendre')) {
            return $this->where('variation_poids >', 0)->findAll();
        }

        // IMC idéal — dépend de l'IMC actuel
        if (str_contains($objectifLabel, 'imc') || str_contains($objectifLabel, 'idéal')) {
            if ($imc > 25) {
                return $this->where('variation_poids <', 0)->findAll();
            } elseif ($imc < 18.5) {
                return $this->where('variation_poids >', 0)->findAll();
            } else {
                // IMC déjà idéal → régimes d'entretien
                return $this->where('variation_poids >=', -0.5)
                            ->where('variation_poids <=', 0.5)
                            ->findAll();
            }
        }

        // Par défaut retourner tous les régimes
        return $this->findAll();
    }

    public function ValidationRules($perc_viande, $perc_poisson, $perc_volaille){
        $regime['perc'] = $perc_viande + $perc_poisson + $perc_volaille;
        var_dump($regime);
        if(($regime['perc']) != 100){
            return false;
        }
        return true;
    }

}



