<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Entities\User;
use App\Models\MyUserModel;
use \Hermawan\DataTables\DataTable;

class Pemilih extends BaseController
{
    protected $MyUserModel;
    public function __construct()
    {
        $this->MyUserModel = new MyUserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pemilih',
            'page' => 'pemilih',
            'groups' => ['superadmin', 'admin'],
        ];
        // dd($data);
        $this->data_view = array_merge($this->data_view, $data);
        return view('dashboard/pemilih/index', $this->data_view);
    }

    public function getAllPemilih()
    {
        $db = db_connect();
        $builder = $db->table('users')
            ->select('username, first_name, last_name, gender, users.created_at as tgl_daftar, auth_identities.secret as email, users.id as user_id, image_user,')
            ->join('auth_identities', 'auth_identities.user_id = users.id AND auth_identities.type = "email_password"')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->where('auth_groups_users.group', 'user')
            ->where('users.deleted_at', null);

        return DataTable::of($builder)
            ->filter(function ($builder, $request) {
                if ($request->gender)
                    $builder->where('gender', $request->gender);
            })
            ->postQuery(function ($builder) {
                $builder->orderBy('users.created_at', 'DESC');
            })
            ->addNumbering('no')
            ->edit('first_name', function ($row) {
                return getFullname($row->first_name, $row->last_name);
            })
            ->edit('gender', function ($row) {
                if ($row->gender == 'L') {
                    return 'Laki-laki';
                } else {
                    return 'Perempuan';
                }
            })
            ->edit('image_user', function ($row) {
                $out = '<a href="' . checkImageUser($row->image_user) . '" class="image-link">
                <img src="' . checkImageUser($row->image_user) . '" class="rounded" width="30px;" alt="Image User">
                </a>';
                return $out;
            })
            ->add('action', function ($row) {
                $out = '<div class="btn-group btn-group-sm" role="group">
                            <a href="' . base_url() . '/dashboard/pemilih/edit/' . $row->user_id . '" class="btn btn-warning"><i class="ri-file-edit-line fs-14 align-middle"></i></a>
                            <button class="btn btn-danger delete-pemilih" data-id="' . $row->user_id . '" data-name="' . getFullname($row->first_name, $row->last_name) . '"><i class="ri-delete-bin-5-line fs-14 align-middle"></i></button>
                        </div>';
                return $out;
            })
            ->setSearchableColumns(['first_name', 'last_name', 'phone_number', 'username', 'auth_identities.secret'])
            ->toJson(true);
    }

    public function addPemilih()
    {
        $data = [
            'title' => 'Tambah Data Pemilih',
            'page' => 'pemilih',
        ];
        $this->data_view = array_merge($this->data_view, $data);

        return view('dashboard/pemilih/add', $this->data_view);
    }

    public function insertPemilih()
    {
        $validation = \Config\Services::validation();
        $pesan = [];
        $rules = setting('Validation.registration');
        if (!$this->validate($rules)) {
            foreach ($this->request->getPost() as $key => $value) {
                $pesan[$key] = $validation->getError($key);
            }
            if (!($this->request->getPost('gender'))) {
                $pesan['gender'] = $validation->getError('gender');
            }
            echo json_encode(array('status' => 400, 'pesan' => $pesan));
        } else {
            if ($this->request->getPost('image_user') != "undefined") {
                $imageApps = $this->request->getPost('image_user');
                $imageApps = str_replace('data:image/png;base64,', '', $imageApps);
                $imageApps = str_replace(' ', '+', $imageApps);
                $dataImage = base64_decode($imageApps);
                $namaFoto = url_title($this->request->getPost('email'), '_', true) . '_image_user' . '.png';
                $pathName = 'uploads/image_user/' . $namaFoto;
                file_put_contents($pathName, $dataImage);
            } else {
                $namaFoto = 'DEFAULT-' . $this->request->getPost('gender') . '.png';
            }

            $allowedPostFields = array_merge(
                setting('Auth.validFields'),
                setting('Auth.personalFields'),
                ['password']
            );
            $user = new User();
            $user->fill($this->request->getPost($allowedPostFields));
            $user->image_user = $namaFoto;
            $user->active = 1;
            $query = $this->MyUserModel->save($user);
            $user = $this->MyUserModel->findById($this->MyUserModel->getInsertID());
            $query = $user->addGroup('user');

            if ($query) {
                session()->setFlashdata('message_success', 'Data Pemilih Berhasil Ditambahkan');
                echo json_encode(array('status' => 200, 'pesan' => 'Berhasil menambahkan pemilih!'));
            } else {
                echo json_encode(array('status' => 0, 'pesan' => 'Gagal menambahkan pemilih!'));
            }
        }
    }

    public function deletePemilih()
    {
        $id = $this->request->getPost('id');
        $user = $this->MyUserModel->findById($id);
        if (empty($user)) {
            echo json_encode(array('status' => 0, 'pesan' => 'Pemilih tidak ditemukan!'));
            return;
        }
        $query = $this->MyUserModel->delete($id);
        if ($query) {
            session()->setFlashdata('message_success', 'Data Pemilih Berhasil Dihapus');
            echo json_encode(array('status' => 200, 'pesan' => 'Berhasil menghapus pemilih!'));
        } else {
            echo json_encode(array('status' => 0, 'pesan' => 'Gagal menghapus pemilih!'));
        }
    }

    public function editPemilih($user_id)
    {
        $user = $this->MyUserModel->findById($user_id);
        if (empty($user)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Pemilih tidak ditemukan.');
        }
        $data = [
            'title' => 'Edit Data Pemilih',
            'page' => 'pemilih',
            'user' => $user,
        ];
        $this->data_view = array_merge($this->data_view, $data);
        // dd($this->data_view);
        return view('dashboard/pemilih/edit', $this->data_view);
    }

    public function updatePemilih()
    {
        $user_id = $this->request->getPost('user_id');
        $user = $this->MyUserModel->findById($user_id);
        if (empty($user)) {
            echo json_encode(array('status' => 0, 'pesan' => 'Pemilih tidak ditemukan!'));
            return;
        }
        $validation = \Config\Services::validation();
        $pesan = [];
        $rules = setting('Validation.registration');
        unset($rules['password']);
        unset($rules['password_confirm']);

        if ($this->request->getPost('username') == $user->username) {
            $rules['username']['rules'] = str_replace('|is_unique[pemilih.username]', '', $rules['username']['rules']);
        }
        if ($this->request->getPost('email') == $user->getEmail()) {
            $rules['email']['rules'] = str_replace('|is_unique[auth_identities.secret]', '', $rules['email']['rules']);
        }
        if (!$this->validate($rules)) {
            foreach ($this->request->getPost() as $key => $value) {
                $pesan[$key] = $validation->getError($key);
            }
            if (!($this->request->getPost('gender'))) {
                $pesan['gender'] = $validation->getError('gender');
            }
            echo json_encode(array('status' => 400, 'pesan' => $pesan));
        } else {
            $oldImage = $user->image_user;
            if ($this->request->getPost('image_user') != "undefined") {
                $imageApps = $this->request->getPost('image_user');
                $imageApps = str_replace('data:image/png;base64,', '', $imageApps);
                $imageApps = str_replace(' ', '+', $imageApps);
                $dataImage = base64_decode($imageApps);
                $namaFoto = url_title($this->request->getPost('email'), '_', true) . '_image_user' . '.png';
                $pathName = 'uploads/image_user/' . $namaFoto;
                if ($oldImage != 'DEFAULT-L.png' && $oldImage != 'DEFAULT-P.png') {
                    if (file_exists("uploads/image_user/" . $oldImage)) {
                        unlink("uploads/image_user/" . $oldImage);
                    }
                }
                file_put_contents($pathName, $dataImage);
            } else {
                $namaFoto = $oldImage;
            }

            $allowedPostFields = array_merge(
                setting('Auth.validFields'),
                setting('Auth.personalFields')
            );
            $user = new User();
            $user->fill($this->request->getPost($allowedPostFields));
            $user->image_user = $namaFoto;
            $user->id = $user_id;
            $query = $this->MyUserModel->update($user_id, $user);

            if ($query) {
                session()->setFlashdata('message_success', 'Data Pemilih Berhasil Diedit');
                echo json_encode(array('status' => 200, 'pesan' => 'Berhasil mengedit pemilih!'));
            } else {
                echo json_encode(array('status' => 0, 'pesan' => 'Gagal mengedit pemilih!'));
            }
        }
    }
}
