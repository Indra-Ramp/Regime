<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\SuiviSanteModel;
use App\Models\ProfilModel;
use App\Models\MonnaieModel;

class Home extends BaseController
{
    public function index(): string {
        $user = session()->get('user') ?? NULL;
        $monnaie = new MonnaieModel();
        $userMonnaie = 0;
        if(isset($user)) {
            $userMonnaie = $monnaie->where('id_user', $user['id'])->first()['montant'];
        }
        return view('frontoffice/layout', ['wallet' => $userMonnaie]);
    }
}
