<?php

namespace App\Controllers;
use App\Models\RegimeModel;

class RegimeController extends BaseController {

    public function index(){
        $regime = new RegimeModel();
        $regimes = $regime->findAll();
        return view('backoffice/regimes', ['regimes' => $regimes]);
    }

    public function createRegime(){
        $regime = new RegimeModel();
        $rules = $regime->getValidationRules();
        if(!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $regime->save([
            'perc_viande' => $this->request->getPost('perc_viande'),
            'perc_poisson' => $this->request->getPost('perc_poisson'),
            'perc_volaille' => $this->request->getPost('perc_volaille'),
            'variation_poids' => $this->request->getPost('variation_poids'),
            'duree' => $this->request->getPost('duree'),
            'price' => $this->request->getPost('price')
        ]);
        return redirect()->to('/admin/regimes')->with('success', 'Régime créé avec succès');
    }

    public function deleteRegime($id = null){
        $regime = new RegimeModel();
        $regime->delete($id);
        return redirect()->to('/admin/regimes')->with('success', 'Régime supprimé avec succès');
    }

    public function updateRegime(){
        $regime = new RegimeModel();
        $regimeData = $regime->find($this->request->getPost('id'));
        $rules = $regime->getValidationRules();
        if(!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $regime->update($regimeData['id'], [
            'perc_viande' => $this->request->getPost('perc_viande'),
            'perc_poisson' => $this->request->getPost('perc_poisson'),
            'perc_volaille' => $this->request->getPost('perc_volaille'),
            'variation_poids' => $this->request->getPost('variation_poids'),
            'duree' => $this->request->getPost('duree'),
            'price' => $this->request->getPost('price')
        ]);
        session()->remove('regime');
        return redirect()->to('/admin/regimes')->with('success', 'Régime mis à jour avec succès');
    }

    public function UpdateForm($id = null){
        $regime = new RegimeModel();
        $data['regime'] = $regime->find($id);
        session()->set('regime', $data['regime']);
        return view('backoffice/update-regime', $data);
    }

    public function CreationForm(){
        return view('backoffice/create-regime');
    }

// }
//         'perc_volaille' => $this->request->getPost('perc_volaille'),
//         'variation_poids' => $this->request->getPost('variation_poids'),
//         'duree' => $this->request->getPost('duree'),
//         'price' => $this->request->getPost('price')
//     ];

//     $regimeModel->update($id, $data);

//     return redirect()->to('/regime');
// }

// public function deleteRegime($id)
// {
//     $regimeModel = new RegimeModel();

//     $regimeModel->delete($id);

//     return redirect()->to('/regime');
// }
    }