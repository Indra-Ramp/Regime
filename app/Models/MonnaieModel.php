<?php

    namespace App\Models;
    use CodeIgniter\Model;

    class MonnaieModel extends Model {
        protected $table = 'porte_monnaie';
        protected $primaryKey = 'id';
        protected $allowedFields = ['id_user', 'montant'];
    }

?>