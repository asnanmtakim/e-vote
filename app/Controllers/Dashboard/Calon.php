<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CalonModel;
use \Hermawan\DataTables\DataTable;

class Calon extends BaseController
{
    protected $CalonModel;
    public function __construct()
    {
        $this->CalonModel = new CalonModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Calon Formatur',
            'page' => 'calon',
            'groups' => ['superadmin', 'admin'],
        ];
        // dd($data);
        $this->data_view = array_merge($this->data_view, $data);
        return view('dashboard/calon/index', $this->data_view);
    }

    public function getAllCalon()
    {
        $db = db_connect();
        $builder = $db->table('calon')
            ->select('id_calon, nama_calon, gender_calon, foto_calon')
            ->where('calon.deleted_at', null);

        return DataTable::of($builder)
            ->filter(function ($builder, $request) {
                if ($request->gender)
                    $builder->where('gender_calon', $request->gender);
            })
            ->postQuery(function ($builder) {
                $builder->orderBy('calon.created_at', 'DESC');
            })
            ->addNumbering('no')
            ->edit('gender_calon', function ($row) {
                if ($row->gender_calon == 'L') {
                    return 'Laki-laki';
                } else {
                    return 'Perempuan';
                }
            })
            ->edit('foto_calon', function ($row) {
                $out = '<a href="' . checkImageCalon($row->foto_calon, $row->gender_calon) . '" class="image-link">
                <img src="' . checkImageCalon($row->foto_calon, $row->gender_calon) . '" class="rounded" width="30px;" alt="Foto Calon">
                </a>';
                return $out;
            })
            ->add('action', function ($row) {
                $out = '<div class="btn-group btn-group-sm" role="group">
                            <a href="' . base_url() . '/dashboard/calon/edit/' . $row->id_calon . '" class="btn btn-warning"><i class="ri-file-edit-line fs-14 align-middle"></i></a>
                            <button class="btn btn-danger delete-calon" data-id="' . $row->id_calon . '" data-name="' . $row->nama_calon . '"><i class="ri-delete-bin-5-line fs-14 align-middle"></i></button>
                        </div>';
                return $out;
            })
            ->setSearchableColumns(['nama_calon'])
            ->toJson(true);
    }

    public function addCalon()
    {
        $data = [
            'title' => 'Tambah Data Calon Formatur',
            'page' => 'calon',
        ];
        $this->data_view = array_merge($this->data_view, $data);
        return view('dashboard/calon/add', $this->data_view);
    }

    public function insertCalon()
    {
        $validation = \Config\Services::validation();
        $pesan = [];
        $rules = [
            'nama_calon' => [
                'label' => 'nama calon',
                'rules' => 'required|min_length[3]|max_length[250]',
            ],
            'gender_calon' => [
                'label' => 'gender',
                'rules' => 'required',
            ],
        ];
        if (!$this->validate($rules)) {
            foreach ($this->request->getPost() as $key => $value) {
                $pesan[$key] = $validation->getError($key);
            }
            if (!($this->request->getPost('gender_calon'))) {
                $pesan['gender_calon'] = $validation->getError('gender_calon');
            }
            echo json_encode(array('status' => 400, 'pesan' => $pesan));
        } else {
            $nama_calon = $this->request->getPost('nama_calon');
            // dd($this->request->getPost('foto_calon'));
            if ($this->request->getPost('foto_calon') != "undefined") {
                $imageApps = $this->request->getPost('foto_calon');
                $imageApps = str_replace('data:image/png;base64,', '', $imageApps);
                $imageApps = str_replace(' ', '+', $imageApps);
                $dataImage = base64_decode($imageApps);
                $namaFoto = url_title($nama_calon, '_', true) . '_foto_calon' . '.png';
                $pathName = 'uploads/foto_calon/' . $namaFoto;
                file_put_contents($pathName, $dataImage);
            } else {
                $namaFoto = 'DEFAULT-' . $this->request->getPost('gender_calon') . '.png';
            }
            $calon = [
                'nama_calon' => $nama_calon,
                'gender_calon' => $this->request->getPost('gender_calon'),
                'foto_calon' => $namaFoto
            ];
            $query = $this->CalonModel->save($calon);

            if ($query) {
                session()->setFlashdata('message_success', 'Data Calon Formatur Berhasil Ditambahkan');
                echo json_encode(array('status' => 200, 'pesan' => 'Berhasil menambahkan calon formatur!'));
            } else {
                echo json_encode(array('status' => 0, 'pesan' => 'Gagal menambahkan calon formatur!'));
            }
        }
    }

    public function deleteCalon()
    {
        $id = $this->request->getPost('id');
        $calon = $this->CalonModel->find($id);
        if (empty($calon)) {
            echo json_encode(array('status' => 0, 'pesan' => 'Calon Formatur tidak ditemukan!'));
            return;
        }
        $query = $this->CalonModel->delete($id);
        if ($query) {
            session()->setFlashdata('message_success', 'Data Calon Formatur Berhasil Dihapus');
            echo json_encode(array('status' => 200, 'pesan' => 'Berhasil menghapus calon formatur!'));
        } else {
            echo json_encode(array('status' => 0, 'pesan' => 'Gagal menghapus calon formatur!'));
        }
    }

    public function editCalon($id_calon)
    {
        $calon = $this->CalonModel->find($id_calon);
        if (empty($calon)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Calon Formatur tidak ditemukan.');
        }
        $data = [
            'title' => 'Edit Data Calon Formatur',
            'page' => 'calon',
            'calon' => $calon,
        ];
        $this->data_view = array_merge($this->data_view, $data);
        // dd($this->data_view);
        return view('dashboard/calon/edit', $this->data_view);
    }

    public function updateCalon()
    {
        $id_calon = $this->request->getPost('id_calon');
        $calon = $this->CalonModel->find($id_calon);
        if (empty($calon)) {
            echo json_encode(array('status' => 0, 'pesan' => 'Calon Formatur tidak ditemukan!'));
            return;
        }
        $validation = \Config\Services::validation();
        $pesan = [];
        $rules = [
            'nama_calon' => [
                'label' => 'nama calon',
                'rules' => 'required|min_length[3]|max_length[250]',
            ],
            'gender_calon' => [
                'label' => 'gender',
                'rules' => 'required',
            ],
        ];
        if (!$this->validate($rules)) {
            foreach ($this->request->getPost() as $key => $value) {
                $pesan[$key] = $validation->getError($key);
            }
            if (!($this->request->getPost('gender_calon'))) {
                $pesan['gender_calon'] = $validation->getError('gender_calon');
            }
            echo json_encode(array('status' => 400, 'pesan' => $pesan));
        } else {
            $oldImage = $calon['foto_calon'];
            $nama_calon = $this->request->getPost('nama_calon');
            if ($this->request->getPost('foto_calon') != "undefined") {
                $imageApps = $this->request->getPost('foto_calon');
                $imageApps = str_replace('data:image/png;base64,', '', $imageApps);
                $imageApps = str_replace(' ', '+', $imageApps);
                $dataImage = base64_decode($imageApps);
                $namaFoto = url_title($nama_calon, '_', true) . '_foto_calon' . '.png';
                $pathName = 'uploads/foto_calon/' . $namaFoto;
                if ($oldImage != 'DEFAULT-L.png' && $oldImage != 'DEFAULT-P.png') {
                    if (file_exists("uploads/foto_calon/" . $oldImage)) {
                        unlink("uploads/foto_calon/" . $oldImage);
                    }
                }
                file_put_contents($pathName, $dataImage);
            } else {
                $namaFoto = $oldImage;
            }

            $calon = [
                'nama_calon' => $nama_calon,
                'gender_calon' => $this->request->getPost('gender_calon'),
                'foto_calon' => $namaFoto
            ];
            $query = $this->CalonModel->update($id_calon, $calon);

            if ($query) {
                session()->setFlashdata('message_success', 'Data Calon Formatur Berhasil Diedit');
                echo json_encode(array('status' => 200, 'pesan' => 'Berhasil mengedit calon formatur!'));
            } else {
                echo json_encode(array('status' => 0, 'pesan' => 'Gagal mengedit calon formatur!'));
            }
        }
    }
}
