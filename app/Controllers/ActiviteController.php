<?php

    namespace App\Controllers;
    use App\Models\ActiviteModel;
    use App\Models\ActiviteUserModel;

    use CodeIgniter\Model;

use App\Models\SuiviSanteModel;
use App\Models\ObjectifUserModel;
use App\Models\ObjectifModel;
    class ActiviteController extends BaseController{

        public function index(){
            $activite = new ActiviteModel();
            $activities = $activite->findAll();
            return view('backoffice/activities', ['activities' => $activities]);
        }

        public function createActivity(){
            $data = $this->request->getPost();
            $activite = new ActiviteModel();
            $rules = $activite->getValidationRules();
            if(!$this->validate($rules)) {
                echo json_encode(['errors' => $this->validator->getErrors()]);
                return;
            }
            $activite->save([
                'label' =>$this->request->getPost('label'),
                'variation_poids' => $this->request->getPost('variation_poids'),
                'frequence' => $this->request->getPost('frequence')
            ]);
            return redirect()->to('/admin/activities')->with('success', 'Activité créée avec succès');
        }

        public function deleteActivity($id = null){
            $activite = new ActiviteModel();
            $activite->delete($id);
            return redirect()->back()->with('success', 'Activité supprimée avec succès');
        }

        public function updateActivity(){
            $activite = new ActiviteModel();
            $activity = $activite->find($this->request->getPost('id'));
            $rules = $activite->getValidationRules();
            if(!$this->validate($rules)) {
                echo json_encode(['errors' => $this->validator->getErrors()]);
            }
            $activite->update($activity['id'], [
                'label' =>$this->request->getPost('label'),
                'variation_poids' => $this->request->getPost('variation_poids'),
                'frequence' => $this->request->getPost('frequence')
            ]);
            session()->remove('activity');
            return redirect()->to('/admin/activities')->with('success', 'Activité mise à jour avec succès');
        }

        public function UpdateForm($id = null){
            $activite = new ActiviteModel();
            $data['activity'] = $activite->find($id);
            session()->set('activity', $data['activity']);
            return view('backoffice/update-activity', $data);
        }

        public function CreationForm(){
            return view('backoffice/create-activity');
        }
         public function suggestions()
    {
        $user   = session()->get('user');
        $userId = (int)($user['id'] ?? 0);

        $suiviModel = new SuiviSanteModel();
        $suivi      = $suiviModel->where('id_user', $userId)
                                 ->orderBy('id', 'DESC')
                                 ->first();

        $poids  = $suivi['poids']  ?? null;
        $taille = $suivi['taille'] ?? null;

        $imc = null;
        if ($poids && $taille) {
            $tailleM = $taille / 100;
            $imc     = round($poids / ($tailleM * $tailleM), 1);
        }

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

        $activiteModel = new ActiviteModel();
        $activites     = $activiteModel->getSuggestions($objectifLabel, $imc);

        $data = [
            'activites'     => $activites,
            'imc'           => $imc,
            'objectifLabel' => $objectifLabel,
            'poids'         => $poids,
            'taille'        => $taille,
        ];

        return view('activite/suggestions', $this->data + $data);
    }

    public function choisir($id)
    {
        $user   = session()->get('user');
        $userId = (int)($user['id'] ?? 0);

        $activiteUserModel = new ActiviteUserModel();

        $data = [
            'id_user'       => $userId,
            'id_activite'   => $id,
            'date_activite' => date('Y-m-d H:i:s'),
        ];

        if (!$activiteUserModel->insert($data)) {
            return $this->response->setJSON(['success' => false]);
        }

        return $this->response->setJSON(['success' => true]);
    }
    }
?>