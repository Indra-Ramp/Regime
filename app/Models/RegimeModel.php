<?php

namespace App\Models;
use CodeIgniter\Model;

class RegimeModel extends Model {
        protected $table = 'regime';
        protected $primarykey = "id";
        protected $allowedFields = [
            'perc_viande',
            'perc_poisson',
            'perc_volaille',
            'variation_poids',
            'duree',
            'price'
        ];
       

}



