<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\AppsModel;

class Apps extends BaseController
{
    protected $AppsModel;
    public function __construct()
    {
        $this->AppsModel = new AppsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Setting Aplikasi',
            'page' => 'apps',
            'apps' => $this->AppsModel->orderBy('conf_order', 'ASC')->find(),
            'validation' => \Config\Services::validation()
        ];
        $this->data_view = array_merge($this->data_view, $data);
        return view('dashboard/apps/index', $this->data_view);
    }
    public function updateApps()
    {
        $validation = \Config\Services::validation();
        $pesan = [];
        $apps = $this->AppsModel->orderBy('conf_order', 'ASC')->find();
        if ($this->validate($this->rulesValidationApps())) {
            foreach ($apps as $app) {
                $data = [];
                if ($app['conf_type'] == 'text' || $app['conf_type'] == 'textarea') {
                    $data = [
                        'conf_char' => $app['conf_char'],
                        'conf_value' => $this->request->getPost($app['conf_char']),
                        'conf_value_en' => $this->request->getPost($app['conf_char'] . '_en'),
                    ];
                } elseif ($app['conf_type'] == 'img') {
                    if ($this->request->getPost($app['conf_char']) != "undefined") {
                        $imageApps = $this->request->getPost($app['conf_char']);
                        $imageApps = str_replace('data:image/png;base64,', '', $imageApps);
                        $imageApps = str_replace(' ', '+', $imageApps);
                        $dataImage = base64_decode($imageApps);
                        $imageName = $app['conf_char'] . '_' . time() . '.png';
                        $pathName = 'assets/images/' . $imageName;
                        file_put_contents($pathName, $dataImage);
                        if (file_exists($app['conf_value'])) {
                            unlink($app['conf_value']);
                        }
                        $data = [
                            'conf_char' => $app['conf_char'],
                            'conf_value' => $pathName,
                            'conf_value_en' => $pathName,
                        ];
                    }
                }

                if ($data != []) {
                    $query = $this->AppsModel->save($data);
                }
            }
            if ($query) {
                session()->setFlashdata('message_success', 'Data Aplikasi Berhasil Diubah');
                echo json_encode(array('status' => 200, 'pesan' => 'Berhasil diubah!'));
            } else {
                echo json_encode(array('status' => 0, 'pesan' => 'Gagal diubah!'));
            }
        } else {
            foreach ($this->request->getPost() as $key => $value) {
                $pesan[$key] = $validation->getError($key);
            }
            echo json_encode(array('status' => 400, 'pesan' => $pesan));
        }
    }
    private function rulesValidationApps()
    {
        $config = [];
        $apps = $this->AppsModel->orderBy('conf_order', 'ASC')->find();
        foreach ($apps as $app) {
            if ($app['conf_type'] == 'text' || $app['conf_type'] == 'textarea') {
                $config[$app['conf_char']] = [
                    'label' => $app['conf_name'],
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ];
                $config[$app['conf_char'] . '_en'] = [
                    'label' => $app['conf_name'] . ' (EN)',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ];
            }
        }
        return $config;
    }
}
