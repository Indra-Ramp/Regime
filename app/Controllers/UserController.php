<?php

    namespace App\Controllers;

    class UserController extends BaseController {
        public function loginForm() {
            return view('frontoffice/login');
        }

        public function registerForm($step) {
            return view("frontoffice/register-step$step");
            // test
        }
    }

?>