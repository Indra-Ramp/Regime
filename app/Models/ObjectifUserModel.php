<?php

namespace App\Models;

use CodeIgniter\Model;

class ObjectifUserModel extends Model
{
    protected $table = 'objectif_user';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_user',
        'id_objectif',
        'date_objectif',
        'valeur'
    ];

    protected $validationRules = [
        'id_user' => [
            'rules' => 'required|integer|greater_than[0]',
            'errors' => [
                'required' => "L'ID utilisateur est requis.",
                'integer' => "L'ID utilisateur doit être un entier.",
                'greater_than' => "L'ID utilisateur doit être positif."
            ]
        ],
        'id_objectif' => [
            'rules' => 'required|integer|greater_than[0]',
            'errors' => [
                'required' => 'Veuillez sélectionner un objectif.',
                'integer' => 'ID objectif invalide.',
                'greater_than' => 'ID objectif invalide.'
            ]
        ],
        'date_objectif' => [
            'rules' => 'required|valid_date',
            'errors' => [
                'required' => 'La date cible est requise.',
                'valid_date' => 'Date invalide.'
            ]
        ],
        'valeur' => [
            'rules' => 'required|integer|greater_than_equal_to[0]',
            'errors' => [
                'required' => 'La valeur est requise.',
            
            ]
        ]
    ];

    public function getObjectifs($user_id)
{
    return $this->db->table('objectif_user ou')
        ->select('ou.*, o.label')
        ->join('objectif o', 'o.id = ou.id_objectif')
        ->where('ou.id_user', $user_id)
        ->get()
        ->getResultArray();
}
}
