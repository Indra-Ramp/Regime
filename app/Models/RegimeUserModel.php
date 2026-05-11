<?php
namespace App\Models;
use CodeIgniter\Model;

class RegimeUserModel extends Model
{
    protected $table         = 'regime_user';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id_user', 'id_regime', 'date_regime'];
}