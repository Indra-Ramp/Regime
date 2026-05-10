<?php

    namespace App\Controllers;
    use App\Models\UserModel;
    use App\Models\ActiviteModel;
    use App\Models\CodeModel;
    use App\Models\MonnaieModel;
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

        public function getInvalidCodes() {
            $codeModel = new CodeModel();
            $codes = $codeModel->getLoadingCodes();
            return view('backoffice/codes', ['codes' => $codes]);
        }

        public function ValidCode($id = null) {
            $codeModel = new CodeModel();
            $monnaie = new MonnaieModel();

            // $id = $this->request->getGet('id');
            $code = $codeModel->find($id);

            if(!$code){
                return redirect()->back()->with('error', 'Code non trouvé');
            }

            $monnaieData = $monnaie->where('id_user', $code['id_user'])->first();
            
            if(!$monnaieData){
                return redirect()->back()->with('error', 'Porte-monnaie de l\'utilisateur non trouvé');
            } 
            $newCode = $codeModel->getCode($code['code']);
            if(!$newCode){
                return redirect()->back()->with('error', 'Code non trouvé');
            }
            $monnaieData['montant'] += $newCode['montant'];
            $monnaie->update($monnaieData['id'], ['montant' => $monnaieData['montant']]);
            $codeModel->update($code['id'], ['statut' => 'valide']);
            
            return redirect()->to('/admin/codes')->with('success', 'Code validé et montant ajouté au porte-monnaie');
        }

        public function RefusedCode($id = null) {
            $codeModel = new CodeModel();
            $code = $codeModel->find($id);

            if(!$code){
                return redirect()->back()->with('error', 'Code non trouvé');
            }
            $codeModel->update($code['id'], ['statut' => 'refuse']);

            return redirect()->to('/admin/codes')->with('success', 'Code refusé');
        }

    }

?>