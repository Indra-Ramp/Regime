<?php
namespace App\Controllers;

use App\Models\TypeAbonnementModel;
use App\Models\TypeAbonnementUser;

class AbonnementController extends BaseController
{
    // Afficher le formulaire de choix
    public function index()
    {
        $user   = session()->get('user');
        $userId = (int)($user['id'] ?? 0);

        $abonnementModel     = new TypeAbonnementModel();
        $abonnementUserModel = new TypeAbonnementUser();

        $data = [
            'abonnements' => $abonnementModel->findAll(),
            'actuel'      => $abonnementUserModel->where('id_user', $userId)->orderBy('id', 'DESC')->first(),
        ];

        return view('abonnement/index', $this->data + $data);
    }

    // Changer l'abonnement
    public function store()
    {
        $user   = session()->get('user');
        $userId = (int)($user['id'] ?? 0);

        if (!$userId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Utilisateur non connecté'
            ]);
        }

        $abonnementUserModel = new TypeAbonnementUser();

        $data = [
            'id_user'          => $userId,
            'id_abonnement'    => $this->request->getPost('id_abonnement'),
            'date_abonnement'  => date('Y-m-d H:i:s'),
        ];

        if (!$abonnementUserModel->insert($data)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $abonnementUserModel->errors()
            ]);
        }

        return $this->response->setJSON(['success' => true]);
    }
}