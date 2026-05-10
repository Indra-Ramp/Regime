<?php
    namespace App\Models;

    use CodeIgniter\Model;

    class ProfilModel extends Model{
        protected $table = 'profil';
        protected $primaryKey = 'id';
        protected $allowedFields = [
            'id_user',
            'telephone',
            'date_naissance'
        ];

        protected $validationRules=[
            'telephone' => 'required',
            'date_naissance' => 'required|valid_date[Y-m-d]',
        ];
public function getProfil($user_id)
{
    return $this->db->table('user u')
        ->select('
            u.*,
            p.telephone,
            p.date_naissance,
            pm.montant
        ')
        ->join('profil p', 'p.id_user = u.id', 'left')
        ->join('porte_monnaie pm', 'pm.id_user = u.id', 'left')
        ->where('u.id', $user_id)
        ->get()
        ->getRowArray();
}
      }
    
