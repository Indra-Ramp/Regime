<?php

    namespace App\Controllers;
    use App\Models\UserModel;
    use App\Models\ProfilModel;
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

       
    }

?>