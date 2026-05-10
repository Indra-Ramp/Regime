<?php

    namespace App\Controllers;
    use App\Models\UserModel;
    use App\Models\ActiviteModel;
    use App\Models\TypeAbonnementUser;
    use CodeIgniter\Model;

    class AdminController extends BaseController{

        public function index(){
            $user = new UserModel();
            $typeAbonnementUser = new TypeAbonnementUser();
            $data = $user->userCountEvolution();
            $dataTypeAbonnement = $typeAbonnementUser->typeAbonnementChart();
            
            $labels = [];
            $count = [];
            $labelsTypeAbonnement = [];
            $countTypeAbonnement = [];  

            foreach($data as $item) {
                $labels[] = $item['month'];
                $count[] = $item['count'];
            }

            foreach($dataTypeAbonnement as $item) {
                $labelsTypeAbonnement[] = $item['type'];
                $countTypeAbonnement[] = $item['total'];
            }

            $data['chartLabels'] = json_encode($labels);
            $data['chartData'] = json_encode($count);   
            $data['chartTypeLabels'] = json_encode($labelsTypeAbonnement);
            $data['chartTypeData'] = json_encode($countTypeAbonnement);

            return view('backoffice/dashboard', $data);
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

            return redirect()->back()->with('success', 'Activité mise à jour avec succès');
        }

        public function ValidationCode(){
            $code = $this->request->getPost('code');
        }

    }

?>