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
public function getSuggestions($objectifLabel, $imc)
    {
        $objectifLabel = strtolower($objectifLabel);

        if (str_contains($objectifLabel, 'perdre')) {
            return $this->where('variation_poids <', 0)->findAll();
        }

        if (str_contains($objectifLabel, 'prendre')) {
            return $this->where('variation_poids >', 0)->findAll();
        }

        if (str_contains($objectifLabel, 'imc') || str_contains($objectifLabel, 'idéal')) {
            if ($imc > 25) {
                return $this->where('variation_poids <', 0)->findAll();
            } elseif ($imc < 18.5) {
                return $this->where('variation_poids >', 0)->findAll();
            } else {
                return $this->where('variation_poids >=', -0.5)
                            ->where('variation_poids <=', 0.5)
                            ->findAll();
            }
        }

        return $this->findAll();
    }
    }

?>