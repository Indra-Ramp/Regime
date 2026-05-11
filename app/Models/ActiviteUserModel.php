<?php
namespace App\Models;
use CodeIgniter\Model;

class ActiviteUserModel extends Model
{
    protected $table         = 'activite_user';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id_user', 'id_activite', 'date_activite'];
}