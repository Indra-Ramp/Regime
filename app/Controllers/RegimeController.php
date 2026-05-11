<?php

namespace App\Controllers;
use App\Models\RegimeModel;
use App\Models\RegimeUserModel;

use App\Models\SuiviSanteModel;
use App\Models\ObjectifUserModel;
use App\Models\ObjectifModel;




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
        $perc_viande = $this->request->getPost('perc_viande');
        $perc_poisson =  $this->request->getPost('perc_poisson');
        $perc_volaille = $this->request->getPost('perc_volaille');
        if($regime->ValidationRules($perc_viande, $perc_poisson, $perc_volaille)){
            $regime->save([
                'perc_viande' => $perc_viande,
                'perc_poisson' => $perc_poisson,
                'perc_volaille' => $perc_volaille,
                'variation_poids' => $this->request->getPost('variation_poids'),
                'duree' => $this->request->getPost('duree'),
                'price' => $this->request->getPost('price')
            ]);
            return redirect()->to('/admin/regimes')->with('success', 'Régime créé avec succès');
        } else{
            return redirect()->to('/admin/regimes')->with('error', 'Disproportion du regime');
        }
        
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
        $perc_viande = $this->request->getPost('perc_viande');
        $perc_poisson =  $this->request->getPost('perc_poisson');
        $perc_volaille = $this->request->getPost('perc_volaille');
        if($regime->ValidationRules($perc_viande, $perc_poisson, $perc_volaille)){
            $regime->update($regimeData['id'], [
                'perc_viande' => $perc_viande,
                'perc_poisson' => $perc_poisson,
                'perc_volaille' => $perc_volaille,
                'variation_poids' => $this->request->getPost('variation_poids'),
                'duree' => $this->request->getPost('duree'),
                'price' => $this->request->getPost('price')
            ]);
            session()->remove('regime');
            return redirect()->to('/admin/regimes')->with('success', 'Régime mis à jour avec succès');
        } else {
            return redirect()->back()->with('error', 'Disproportion du regime');
        }
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
   public function suggestions()
    {
        $user   = session()->get('user');
        $userId = (int)($user['id'] ?? 0);

        // Dernier suivi santé
        $suiviModel = new SuiviSanteModel();
        $suivi      = $suiviModel->where('id_user', $userId)
                                 ->orderBy('id', 'DESC')
                                 ->first();

        $poids  = $suivi['poids']  ?? null;
        $taille = $suivi['taille'] ?? null;

        // Calcul IMC
        $imc = null;
        if ($poids && $taille) {
            $tailleM = $taille / 100;
            $imc     = round($poids / ($tailleM * $tailleM), 1);
        }

        // Objectif actuel de l'user
        $objectifUserModel = new ObjectifUserModel();
        $objectifModel     = new ObjectifModel();

        $objectifUser = $objectifUserModel->where('id_user', $userId)
                                          ->orderBy('id', 'DESC')
                                          ->first();

        $objectifLabel = '';
        if ($objectifUser) {
            $objectif      = $objectifModel->find($objectifUser['id_objectif']);
            $objectifLabel = $objectif['label'] ?? '';
        }

        // Suggestions de régimes
        $regimeModel = new RegimeModel();
        $regimes     = $regimeModel->getSuggestions($objectifLabel, $imc);

        $data = [
            'regimes'       => $regimes,
            'imc'           => $imc,
            'objectifLabel' => $objectifLabel,
            'poids'         => $poids,
            'taille'        => $taille,
        ];

        return view('regime/suggestions', $this->data + $data);
    }

public function choisir($id)
{
    $user   = session()->get('user');
    $userId = (int)($user['id'] ?? 0);

    $regimeUserModel = new RegimeUserModel();

    $data = [
        'id_user'     => $userId,
        'id_regime'   => $id,
        'date_regime' => date('Y-m-d H:i:s'),
    ];

    if (!$regimeUserModel->insert($data)) {
        return $this->response->setJSON(['success' => false]);
    }

    return $this->response->setJSON(['success' => true]);
}


// public function deleteRegime($id)
// {
//     $regimeModel = new RegimeModel();

//     $regimeModel->delete($id);

//     return redirect()->to('/regime');
// }
    }