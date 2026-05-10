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

// ObjectifUserModel
// protected $validationRules = [
//     'id_user'       => 'required|integer',  // ← supprime le | final
//     'id_objectif'   => 'required|integer',
//     'date_objectif' => 'required',
//     'valeur'        => 'required|decimal',
// ];
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
