<?php
namespace App\Models;
use CodeIgniter\Model;

class TypeAbonnementModel extends Model
{
    protected $table         = 'type_abonnement';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['label', 'montant', 'perc_reduction'];
}