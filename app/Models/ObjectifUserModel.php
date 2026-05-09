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
}