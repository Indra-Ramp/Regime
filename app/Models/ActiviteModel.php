<?php

    namespace App\Models;
    use CodeIgniter\Model;

    class ActiviteModel extends Model {
        protected $table = 'activite';
        protected $allowedFields = ['id', 'nom'];

        
    }

?>