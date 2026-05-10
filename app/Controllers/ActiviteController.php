<?php

    namespace App\Controllers;
    use App\Models\ActiviteModel;
    use CodeIgniter\Model;

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
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            $activite->save([
                'label' =>$this->request->getPost('label'),
                'variation_poids' => $this->request->getPost('variation_poids'),
                'frequence' => $this->request->getPost('frequence')
            ]);
            return redirect()->to('/admin/activities')->with('success', 'Activité créée avec succès');
        }

        public function deleteActivity(){
            $activite = new ActiviteModel();
            $activity = $activite->find($this->request->getPost('id'));
            $activite->deleteById($activity['id']);
            return redirect()->back()->with('success', 'Activité supprimée avec succès');
        }

        public function updateActivity(){
            $activite = new ActiviteModel();
            $activity = $activite->find($this->request->getPost('id'));
            $activite->update($activity, [
                'label' =>$this->request->getPost('label'),
                'variation_poids' => $this->request->getPost('variation_poids'),
                'frequence' => $this->request->getPost('frequence')
            ]);
            session()->remove('activity');
            return redirect()->to('/admin/activities')->with('success', 'Activité mise à jour avec succès');
        }

        public function UpdateForm(){
            $activite = new ActiviteModel();
            $data['activity'] = $activite->find($this->request->getPost('id'));
            session()->set('activity', $data['activity']);
            return view('backoffice/update-activity', $data);
        }

        public function CreationForm(){
            return view('backoffice/create-activity');
        }
    }
?>