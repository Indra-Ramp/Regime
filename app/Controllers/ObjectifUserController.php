<?php

namespace App\Controllers;

use App\Models\ObjectifUserModel;
use App\Models\ObjectifModel;

class ObjectifUserController extends BaseController
{
    public function index()
    {
        $model = new ObjectifUserModel();

        return view('objectif_user/index', [
            'data' => $model->findAll()
        ]);
    }

    public function create()
    {
        $objectifModel = new ObjectifModel();

        return view('objectif_user/create', [
            'objectifs' => $objectifModel->findAll()
        ]);
    }

    public function store()
    {
        $model = new ObjectifUserModel();

        $model->insert([
            'id_user' => session()->get('user_id'),
            'id_objectif' => $this->request->getPost('id_objectif'),
            'date_objectif' => date('Y-m-d H:i:s'),
            'valeur' => $this->request->getPost('valeur')
        ]);

        return redirect()->to('/objectif-user');
    }

    // public function edit($id)
    // {
    //     $model = new ObjectifUserModel();
    //     $objectifModel = new ObjectifModel();

    //     return view('objectif_user/edit', [
    //         'data' => $model->find($id),
    //         'objectifs' => $objectifModel->findAll()
    //     ]);
    // }

    public function update($id)
    {
        $model = new ObjectifUserModel();

        $model->update($id, [
            'id_objectif' => $this->request->getPost('id_objectif'),
            'valeur' => $this->request->getPost('valeur')
        ]);

        return redirect()->to('/objectif-user');
    }

    public function delete($id)
    {
        $model = new ObjectifUserModel();

        $model->delete($id);

        return redirect()->to('/objectif-user');
    }
}