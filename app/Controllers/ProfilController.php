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
   
    $profilModel = new ProfilModel();

    $data = [
        'id_user' => session()->get('user_id'),
        'telephone' => $this->request->getPost('telephone'),
        'date_naissance' => $this->request->getPost('date_naissance')
    ];

    $profilModel->insert($data);

      return $this->response->setJSON([
        'success' => true
    ]);
   
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