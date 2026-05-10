<?php
namespace App\Controllers;
use App\Models\ProfilModel;
use App\Models\ObjectifUserModel;
use App\Models\ObjectifModel;
class ProfilController extends BaseController{
      public function index()
{
    $objectifModel = new ObjectifModel();

    $data = [
        'objectifs' => $objectifModel->findAll()
    ];

    return view('profil/form', $data);
}     
public function insertProfil()
{
    $user   = session()->get('user');
    $userId = $user['id'] ?? null;

    if (!$userId) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Utilisateur non connecté'
        ]);
    }

    $profilModel = new ProfilModel();

    $data = [
        'id_user'        => $userId,
        'telephone'      => $this->request->getPost('telephone'),
        'date_naissance' => $this->request->getPost('date_naissance')
    ];

    // ← Affiche la requête SQL générée AVANT l'insert
    $builder = $profilModel->builder();
    $builder->set($data);
    log_message('debug', 'SQL INSERT: ' . $builder->getCompiledInsert(false));

    if (!$profilModel->insert($data)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => $profilModel->errors()
        ]);
    }

    return $this->response->setJSON(['success' => true]);
}

public function profile()
{
    $userId = session()->get('user_id');

    $profilModel = new ProfilModel();
    $objectifUserModel= new ObjectifUserModel();


    $data = [
        'profil' => $profilModel->getProfil($userId),
        'objectifs' => $objectifUserModel->getObjectifs($userId)
    ];

    return view('profil/profil', $data);
}
}