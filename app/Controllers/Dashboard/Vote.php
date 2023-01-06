<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\VoteModel;
use App\Models\CalonModel;

class Vote extends BaseController
{
    protected $VoteModel;
    protected $CalonModel;
    public function __construct()
    {
        $this->VoteModel = new VoteModel();
        $this->CalonModel = new CalonModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Vote Suara',
            'page' => 'vote',
            'pilihan' => $this->checkPilihan(),
            'calon' => $this->CalonModel->findAll()
        ];
        // dd($data);
        $this->data_view = array_merge($this->data_view, $data);
        return view('dashboard/vote/index', $this->data_view);
    }

    public function submitVote()
    {
        if ($this->checkPilihan()) {
            $vote = $this->request->getPost('vote');
            $data = [];
            foreach ($vote as $vt) {
                $data[] = [
                    'id_pemilih' => auth()->user()->id,
                    'id_calon' => $vt
                ];
            }

            $query = $this->VoteModel->insertBatch($data);
            if ($query) {
                session()->setFlashdata('message_success', 'Data Pilihan Berhasil Disimpan');
                echo json_encode(array('status' => 200, 'pesan' => 'Data Pilihan Berhasil Disimpan!'));
            } else {
                echo json_encode(array('status' => 0, 'pesan' => 'Data Pilihan Gagal Disimpan!'));
            }
        } else {
            echo json_encode(array('status' => 0, 'pesan' => 'Anda Sudah Memilih!'));
        }
    }

    private function checkPilihan()
    {
        $pilih = $this->VoteModel->getVotebyPemilih(auth()->user()->id);
        if ($pilih['total'] > 0) {
            return false;
        } else {
            return true;
        }
    }
}
