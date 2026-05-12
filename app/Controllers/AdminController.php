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
            $codes = $codeModel->findAll();
            $userModel = new UserModel();
            $users = $userModel->findAll(); // Changed to findAll to show all codes
            return view('backoffice/codes', ['codes' => $codes, 'users' => $users]);
        }

        public function ValidCode($id = null) {
            $codeModel = new CodeModel();
            $monnaie = new MonnaieModel();

            // $id = $this->request->getGet('id');
            $code = $codeModel->find($id);

            $monnaieData = $monnaie->where('id_user', $code['id_user'])->first();
            
            if(!$monnaieData){
                echo json_encode(['error' => 'Porte-monnaie de l\'utilisateur non trouvé']);
                return;
            } 
            $newCode = $codeModel->getCode($code['code']);
            if(!$newCode){
                echo json_encode(['error' => 'Code non trouvé']);
                return;
            }
            $monnaieData['montant'] += $newCode['montant'];
            $m = $monnaie->update($monnaieData['id'], ['montant' => $monnaieData['montant']]);
            $c = $codeModel->update($code['id'], ['statut' => 'valide']);
            
            echo json_encode(['success'=> 'Code validé et montant ajouté au porte-monnaie']);
        }

        public function RefusedCode($id = null) {
            $codeModel = new CodeModel();
            $code = $codeModel->find($id);

            if(!$code){
                echo json_encode(['error' => 'Code non trouvé']);
            }
            $codeModel->update($code['id'], ['statut' => 'refuse']);

            echo json_encode(['success' => 'Code refusé']);
        }

        public function createCodeForm() {
            $userModel = new UserModel();
            $data['users'] = $userModel->findAll();
            return view('backoffice/create-code', $data);
        }

        public function createCode() {
            $codeModel = new CodeModel();
            $rules = $codeModel->ValidationRules();
            if(!$this->validate($rules)) {
                echo json_encode(['errors' => $this->validator->getErrors()]);
                return;
            }
            $codeModel->save([
                'code' => $this->request->getPost('code'),
                'id_user' => $this->request->getPost('id_user'),
                'statut' => $this->request->getPost('statut'),
                'date_track' => $this->request->getPost('date_track')
            ]);
            $newCode = $codeModel->orderBy('id', 'DESC')->first();
            echo json_encode(['success' => 'Code créé avec succès', 'code' => $newCode]);
        }

        public function updateCodeForm($id = null) {
            $codeModel = new CodeModel();
            $userModel = new UserModel();
            $data['code'] = $codeModel->find($id);
            $data['users'] = $userModel->findAll();
            session()->set('code', $data['code']);
            return view('backoffice/update-code', $data);
        }

        public function updateCode() {
            $codeModel = new CodeModel();
            $codeData = $codeModel->find($this->request->getPost('code_id'));
            $rules = $codeModel->ValidationRules();
            if(!$this->validate($rules)) {
                echo json_encode(['errors' => $this->validator->getErrors()]);
                return;
            }
            $codeModel->update($codeData['id'], [
                'code' => $this->request->getPost('code'),
                'id_user' => $this->request->getPost('id_user'),
                'statut' => $this->request->getPost('statut'),
                'date_track' => $this->request->getPost('date_track')
            ]);
            session()->remove('code');
            $updatedCode = $codeModel->find($codeData['id']);
            echo json_encode(['success' => 'Code mis à jour avec succès', 'code' => $updatedCode]);
        }

        public function deleteCode($id = null) {
            $codeModel = new CodeModel();
            $codeModel->delete($id);
            echo json_encode(['success' => 'Code supprimé avec succès']);
        }

    }

?>