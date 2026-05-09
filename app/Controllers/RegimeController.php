<?php
    namespace App\Controllers;
    use App\Models\RegimeModel;

    class RegimeController extends BaseController {
        public function index(){
            return view('admin/regimeForm');
        }
        public function insertRegime(){
        $regimeModel = new RegimeModel();
  

    $data = [
        'perc_viande' => $this->request->getPost('perc_viande'),
        'perc_poisson' => $this->request->getPost('perc_poisson'),
        'perc_volaille' => $this->request->getPost('perc_volaille'),
        'variation_poids' => $this->request->getPost('variation_poids'),
        'duree' => $this->request->getPost('duree'),
        'price' => $this->request->getPost('price')

    ]; 

     $regimeModel->insert($data);

    return redirect()->to('/regime');
    

    }

    public function getAll(){
              $regimeModel = new RegimeModel();

        $data['regime'] = $regimeModel->findAll();

        return redirect()->to('admin/list');
        }

        public function findByid($id){
            $regimeModel = new RegimeModel();
            $data['id'] = $regimeModel->find($id);
             return view('regime/detail', $data);
        }

        public function updateRegime($id)
{
    $regimeModel = new RegimeModel();

    $data = [
        'perc_viande' => $this->request->getPost('perc_viande'),
        'perc_poisson' => $this->request->getPost('perc_poisson'),
        'perc_volaille' => $this->request->getPost('perc_volaille'),
        'variation_poids' => $this->request->getPost('variation_poids'),
        'duree' => $this->request->getPost('duree'),
        'price' => $this->request->getPost('price')
    ];

    $regimeModel->update($id, $data);

    return redirect()->to('/regime');
}

public function deleteRegime($id)
{
    $regimeModel = new RegimeModel();

    $regimeModel->delete($id);

    return redirect()->to('/regime');
}
    }