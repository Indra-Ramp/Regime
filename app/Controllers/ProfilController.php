<?php
namespace App\Controllers;
use App\Models\ProfilModel;

class ProfilController extends BaseController{
        
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
}

}