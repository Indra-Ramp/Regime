<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    protected $data = []; // ← ajoute ça

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Vérification profil
        $user   = session()->get('user');
        $userId = (int)($user['id'] ?? 0);

        if ($userId) {
            $profilModel = new \App\Models\ProfilModel();
            $this->data['hasProfil'] = $profilModel->where('id_user', $userId)->first() !== null;
        } else {
            $this->data['hasProfil'] = false;
        }
    }
}