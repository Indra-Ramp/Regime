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

        public function ValidationCode(){
            $code = $this->request->getPost('code');
        }

    }

?>