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

        public function deleteActivity($id){
            $activite = new ActiviteModel();
            $activity = $activite->find($id);
            var_dump($activity);
            $activite->delete($activity['id']);
            return redirect()->to('/admin/activities')->with('success', 'Activité supprimée avec succès');
        }

        public function updateActivity(){
            $activite = new ActiviteModel();
            $activity = session()->get('activity');
            $activite->where('id', session()->get('activity')['id'])->update($activity, [
                'label' =>$this->request->getPost('label'),
                'variation_poids' => $this->request->getPost('variation_poids'),
                'frequence' => $this->request->getPost('frequence')
            ]);
            session()->remove('activity');
            return redirect()->to('/admin/activities')->with('success', 'Activité mise à jour avec succès');
        }

        public function UpdateForm($id){
            $activite = new ActiviteModel();
            $data['activity'] = $activite->find($id);
            session()->set('activity', $data['activity']);
            return view('backoffice/update-activity', $data);
        }

        public function CreationForm(){
            return view('backoffice/create-activity');
        }
    }
?>