<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CalonModel;
use App\Models\VoteModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
    }

    public function index()
    {
        if (auth()->user()->inGroup('user')) {
            return redirect()->to('dashboard/vote');
        }
        $data = [
            'title' => 'Dashboard',
            'page' => 'dashboard',
        ];
        // dd($data);
        $this->data_view = array_merge($this->data_view, $data);
        return view('dashboard/index', $this->data_view);
    }

    public function setSess()
    {
        if ($this->request->getPost('sessName') != null && $this->request->getPost('sessValue') != null) {
            if ($this->request->getPost('sessValue') == '') {
                session()->remove($this->request->getPost('sessName'));
            } else {
                session()->remove($this->request->getPost('sessName'));
                session()->set($this->request->getPost('sessName'), $this->request->getPost('sessValue'));
            }
        } else {
            session()->remove($this->request->getPost('sessName'));
        }
        echo json_encode(session()->get($this->request->getPost('sessName')));
    }

    public function hasil()
    {
        $CalonModel = new CalonModel();
        $VoteModel = new VoteModel();
        $total = $VoteModel->selectCount('*', 'total')->first();
        $hasil = $CalonModel->getHasilVote();
        foreach ($hasil as $key => $value) {
            $hasil[$key]['persen'] = round((intval($value['jumlah_hasil']) / intval($total['total'])) * 100);
        }
        $data = [
            'title' => 'Hasil Vote',
            'page' => 'hasil',
            'hasil_vote' => $hasil
        ];
        // dd($data);
        $this->data_view = array_merge($this->data_view, $data);
        return view('dashboard/hasil', $this->data_view);
    }
}
