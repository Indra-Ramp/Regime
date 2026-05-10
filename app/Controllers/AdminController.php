<?php

    namespace App\Controllers;
    use App\Models\UserModel;
    use App\Models\ActiviteModel;
    use App\Models\TypeAbonnementUser;
    use CodeIgniter\Model;

    class AdminController extends BaseController{

        public function loginForm() {
            return view('backoffice/login');
        }

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

        public function login() {
            $input = $this->request->getPost();
            $user = new UserModel();
            $errors = [];
            if(!$this->validate($user->getValidationRules()['login'])) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            $emailMatch = $user->where('email', $input['email'])->first();
            if($user->connectAsAdmin($input['email'])){
                if($input['password_hash'] != $emailMatch['password_hash']) {
                    $errors['password_hash'] = 'Mot de passe incorrect';
                    return redirect()->back()->withInput()->with('errors', $errors);
                } 
                session()->set('user', $emailMatch);
                return redirect()->to('/admin/dashboard');
            } else if($emailMatch == NULL){
                $errors['email'] = 'Aucun email correspondant';
                return redirect()->back()->withInput()->with('errors', $errors);
            } else{
                $errors['email'] = 'Vous n\'avez pas les droits pour accéder à cet espace';
                return redirect()->back()->withInput()->with('errors', $errors);
            }
            return redirect()->to('/');
        }

        public function logout() {
            session()->remove('user');
            return redirect()->to('/');
        }

        public function ValidationCode(){
            $code = $this->request->getPost('code');
        }

    }

?>