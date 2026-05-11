<?php

    namespace App\Controllers;
    use App\Models\UserModel;
    use App\Models\SuiviSanteModel;
    use App\Models\ProfilModel;
    use App\Models\MonnaieModel;

    class UserController extends BaseController {
        public function loginForm() {
            return view('frontoffice/login');
        }

        public function registerForm($step) {
            return view("frontoffice/register-step$step");
            // test
        }

        public function registerStep1() {
            $data = $this->request->getPost();
            $user = new UserModel();
            if(!$this->validate($user->getValidationRules()['register'])) {
                session()->remove('temp_data');
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
                // var_dump($this->validator->getErrors());
            }
            session()->set('temp_data', $data);
            return redirect()->to('/register/2');
        }

        public function registerStep2() {
            $dataUser = session()->get('temp_data');
            $dataUser['id_role'] = 1;
            $dataPost = $this->request->getPost();
            $user = new UserModel();
            $monnaie = new MonnaieModel();
            $profil = new ProfilModel();
            $suivi = new SuiviSanteModel();
            $user->db->transBegin();
            try {
                $user->setValidationRules($user->getValidationRules()['register'])->save($dataUser);
                $id = $user->getInsertID();
                $saved = $user->find($id);
                $dataPost['id_user'] = $id;
                if(!$suivi->save($dataPost)) {
                    $user->db->transRollback();
                    return redirect()->to('/register/2')->withInput()->with('errors', $suivi->errors());
                }
                $dataMonnaie = [
                    'id_user' => $id,
                    'montant' => 0,
                ];
                $dataProfil = [
                    'id_user' => $id,
                    'date_naissance' => NULL
                ];
                $monnaie->save($dataMonnaie);
                $profil->save($dataProfil);
                if($user->db->transStatus() === false) {
                    $user->db->transRollback();
                    return redirect()->to('/register/2')->withInput()->with('server_error', 'Erreur lors de la creation de votre compte');
                }
                session()->remove('temp_data');
                session()->set('user', $saved);
                $user->db->transCommit();
                return redirect()->to('/');
            } catch (\Throwable $th) {
                $user->db->transRollback();
                echo $th->getMessage();
                return redirect()->to('/register/2')->withInput()->with('server_error', 'Erreur lors de la creation de votre compte');
            }
        }

        public function login() {
            $input = $this->request->getPost();
            $user = new UserModel();
            $errors = [];
            if(!$this->validate($user->getValidationRules()['login'])) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            $emailMatch = $user->where('email', $input['email'])->first();
            if($emailMatch === NULL) {
                $errors['email'] = 'Aucun email correspondant';
                return redirect()->back()->withInput()->with('errors', $errors);
            }
            if($input['password_hash'] !== $emailMatch['password_hash']) {
                $errors['password_hash'] = 'Mot de passe incorrect';
                return redirect()->back()->withInput()->with('errors', $errors);
            }
            session()->set('user', $emailMatch);
            return redirect()->to('/');
        }

        public function logout() {
            session()->remove('user');
            return redirect()->to('/');
        }
       
    }

?>