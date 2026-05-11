<?php

    namespace App\Models;
    use CodeIgniter\Model;

    class TypeAbonnementUser extends Model {
        protected $table = 'type_abonnement_user';
        // Corrige dans TypeAbonnementUser
protected $allowedFields = ['id_user', 'id_abonnement', 'date_abonnement']; 

        public function typeAbonnementChart(){
            return $this->db->table('type_abonnement_user as tau')
                ->select('a.label as type, COUNT(tau.id) as total')
                ->join('type_abonnement as a', 'a.id = tau.id_abonnement')
                ->groupBy('a.label')
                ->get()
                ->getResultArray();
        }
    }

?>