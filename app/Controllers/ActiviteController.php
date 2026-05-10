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
            $activite = new ActiviteModel();
            $activite->save([
                'label' =>$this->request->getPost('label'),
                'variation_poids' => $this->request->getPost('variation_poids'),
                'frequence' => $this->request->getPost('frequence')
            ]);

            return redirect()->back()->with('success', 'Activité créée avec succès');
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
            $activite->update($activity['id'], [
                'label' =>$this->request->getPost('label'),
                'variation_poids' => $this->request->getPost('variation_poids'),
                'frequence' => $this->request->getPost('frequence')
            ]);
        }

        public function CreationPage(){
            return view('backoffice/create_activity');
        }
    }
?>