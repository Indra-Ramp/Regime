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
    $profil = $this->db->table('user u')
        ->select('
            u.*,
            p.telephone,
            p.date_naissance,
            pm.montant,
            ta.label AS abonnement_label,
            ta.montant AS abonnement_montant,
            ta.perc_reduction,
            tau.date_abonnement
        ')
        ->join('profil p', 'p.id_user = u.id', 'left')
        ->join('porte_monnaie pm', 'pm.id_user = u.id', 'left')
        ->join('type_abonnement_user tau', 'tau.id_user = u.id', 'left')
        ->join('type_abonnement ta', 'ta.id = tau.id_abonnement', 'left')
        ->where('u.id', $user_id)
        ->get()
        ->getRowArray();

    $suivi = $this->db->table('suivi_sante')
        ->where('id_user', $user_id)
        ->orderBy('id', 'DESC')
        ->limit(1)
        ->get()
        ->getRowArray();


    if ($suivi) {
        $profil['poids']      = $suivi['poids'];
        $profil['taille']     = $suivi['taille'];
        $profil['date_suivi'] = $suivi['date_suivi'];
    }

    return $profil;
}
      }
    
