<?php

    namespace App\Models;
    use CodeIgniter\Model;

    class ActiviteModel extends Model {
        protected $table = 'activite_sportive';
        protected $primaryKey = "id";
        protected $allowedFields = ['label', 'variation_poids', 'frequence'];

    }

?>