<?php
namespace App\Controllers;
use App\Models\ProfilModel;

class ProfilController extends BaseController{
    public function index(){
        return view('profil/form');
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
        'status' => 'ok'
    ]);
    return redirect()->to('profil/profil');
}

public function profile()
{
    $userId = session()->get('user_id');

    $model = new ProfilModel();
    $omodel = new ObjectifUserModel();

    $data = [
        'profil' => $model->getProfil($userId),
        'objectifs' => $model->getObjectifs($userId)
    ];

    return view('profile', $data);
}
}