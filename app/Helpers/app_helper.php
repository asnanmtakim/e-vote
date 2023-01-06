<?php
if (!function_exists("formatRupiah")) {
    function formatRupiah($angka)
    {
        $rupiah = number_format($angka, 0, ',', '.');
        return $rupiah;
    }
}

if (!function_exists("formatSubstr")) {
    function formatSubstr($string, $length)
    {
        $string = strip_tags(substr($string, 0, $length));
        return $string . ' [...]';
    }
}

if (!function_exists("formatTanggalDB")) {
    function formatTanggalDB($tanggal)
    {
        return date("Y-m-d", strtotime($tanggal));
    }
}

if (!function_exists("formatTanggalIndo")) {
    function formatTanggalIndo($tanggal)
    {
        $tanggal = date('Y-m-d', strtotime($tanggal));
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $tgl = explode('-', $tanggal);
        return $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0];
    }
}

if (!function_exists("formatTanggalBulanIndo")) {
    function formatTanggalBulanIndo($tanggal)
    {
        $tanggal = date('Y-m-d', strtotime($tanggal));
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $tgl = explode('-', $tanggal);
        return $bulan[(int)$tgl[1]] . ' ' . $tgl[0];
    }
}

if (!function_exists("getUmur")) {
    function getUmur($tanggal_lahir)
    {
        $birthDate = new DateTime($tanggal_lahir);
        $today = new DateTime("today");
        if ($birthDate > $today) {
            exit("0");
        }
        $y = $today->diff($birthDate)->y;
        return $y;
    }
}

if (!function_exists("slugify")) {
    function slugify($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        $text = url_title($text, '-', true);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
}

if (!function_exists("formatTanggalIndoJam")) {
    function formatTanggalIndoJam($tanggal)
    {
        $tanggal = date('Y-m-d H:i:s', strtotime($tanggal));
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $waktu = explode(' ', $tanggal);
        $tgl = explode('-', $waktu[0]);
        return $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0] . ' ' . $waktu[1];
    }
}

if (!function_exists("appIdentity")) {
    function appIdentity()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('app_identity');
        $output = $builder->orderBy('conf_order', 'ASC')->get()->getResultArray();
        $locale = session()->get('lang');
        if ($locale == 'en') {
            $output = [
                'app_title' => $output[0]['conf_value_en'],
                'app_description' => $output[1]['conf_value_en'],
                'app_name' => $output[2]['conf_value_en'],
                'app_icon' => base_url() . '/' . $output[3]['conf_value_en'],
                'app_brand' => base_url() . '/' . $output[4]['conf_value_en'],
                'app_brand_light' => base_url() . '/' . $output[5]['conf_value_en'],
                'app_maps' => $output[6]['conf_value_en'],
                'app_address' => $output[7]['conf_value_en'],
                'app_email' => $output[8]['conf_value_en'],
                'app_phone' => $output[9]['conf_value_en'],
                'app_facebook' => $output[10]['conf_value_en'],
                'app_twitter' => $output[11]['conf_value_en'],
                'app_instagram' => $output[12]['conf_value_en'],
                'app_youtube' => $output[13]['conf_value_en'],
            ];
        } else {
            $output = [
                'app_title' => $output[0]['conf_value'],
                'app_description' => $output[1]['conf_value'],
                'app_name' => $output[2]['conf_value'],
                'app_icon' => base_url() . '/' . $output[3]['conf_value'],
                'app_brand' => base_url() . '/' . $output[4]['conf_value'],
                'app_brand_light' => base_url() . '/' . $output[5]['conf_value'],
                'app_maps' => $output[6]['conf_value'],
                'app_address' => $output[7]['conf_value'],
                'app_email' => $output[8]['conf_value'],
                'app_phone' => $output[9]['conf_value'],
                'app_facebook' => $output[10]['conf_value'],
                'app_twitter' => $output[11]['conf_value'],
                'app_instagram' => $output[12]['conf_value'],
                'app_youtube' => $output[13]['conf_value'],
            ];
        }
        return $output;
    }
}

if (!function_exists("appFooter")) {
    function appFooter()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('app_footer');
        $output = $builder->orderBy('created_at', 'ASC')->get()->getResultArray();
        return $output;
    }
}

if (!function_exists("countVisitor")) {
    function countVisitor()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('visit');
        $yesterday = date('Y-m-d', strtotime('-1 days'));
        $yesterday = $builder->selectCount('*', 'total')->like('tanggal_visit', $yesterday)->get()->getRowArray();
        $today = date('Y-m-d');
        $today = $builder->selectCount('*', 'total')->like('tanggal_visit', $today)->get()->getRowArray();
        $thisMonth = date('Y-m');
        $thisMonth = $builder->selectCount('*', 'total')->like('tanggal_visit', $thisMonth)->get()->getRowArray();
        $thisYear = date('Y');
        $thisYear = $builder->selectCount('*', 'total')->like('tanggal_visit', $thisYear)->get()->getRowArray();
        $allTime = $builder->selectCount('*', 'total')->get()->getRowArray();
        $output = [
            'yesterday' => $yesterday['total'],
            'today' => $today['total'],
            'thisMonth' => $thisMonth['total'],
            'thisYear' => $thisYear['total'],
            'allTime' => $allTime['total']
        ];
        return $output;
    }
}

if (!function_exists("checkImageUser")) {
    function checkImageUser($file = null)
    {
        if ($file == '' || !file_exists('uploads/image_user/' . $file)) {
            helper('auth');
            if (auth()->loggedIn()) {
                if (auth()->user()->gender != '') {
                    $file = base_url() . '/uploads/image_user/DEFAULT-' . auth()->user()->gender . '.png';
                } else {
                    $file = base_url() . '/uploads/image_user/DEFAULT-L.png';
                }
            } else {
                $file = base_url() . '/uploads/image_user/DEFAULT-L.png';
            }
        } else {
            $file = base_url() . '/uploads/image_user/' . $file;
        }
        return $file;
    }
}

if (!function_exists("checkImageCalon")) {
    function checkImageCalon($file = null, $gender = null)
    {
        if ($file == '' || !file_exists('uploads/foto_calon/' . $file)) {
            $file = base_url() . '/uploads/foto_calon/DEFAULT-' . $gender . '.png';
        } else {
            $file = base_url() . '/uploads/foto_calon/' . $file;
        }
        return $file;
    }
}

if (!function_exists("checkImageCover")) {
    function checkImageCover($file = null)
    {
        if ($file == '' || !file_exists('uploads/image_cover/' . $file)) {
            $file = base_url() . '/uploads/image_cover/default.jpg';
        } else {
            $file = base_url() . '/uploads/image_cover/' . $file;
        }
        return $file;
    }
}

if (!function_exists("getFullname")) {
    function getFullname($nama_depan = null, $nama_belakang = null)
    {
        if ($nama_depan != '') {
            return $nama_depan . ' ' . $nama_belakang;
        } else {
            return $nama_belakang;
        }
    }
}

if (!function_exists("getTTL")) {
    function getTTL($tempat = null, $tanggal = null)
    {
        if ($tempat == null || $tanggal == null) {
            return null;
        } else {
            return $tempat . ', ' . formatTanggalIndo($tanggal);
        }
    }
}

if (!function_exists("getGender")) {
    function getGender($gender)
    {
        if ($gender == 'L') {
            $out = 'Laki-laki';
        } elseif ($gender == 'P') {
            $out = 'Perempuan';
        } else {
            $out = 'Tidak Ditemukan';
        }
        return $out;
    }
}

if (!function_exists("appContact")) {
    function appContact($limit = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('contacts');
        $builder->where('status', 0);
        if ($limit != null) {
            $builder->limit($limit);
        }
        $output = $builder->orderBy('created_at', 'DESC')->get()->getResultArray();
        return $output;
    }
}

if (!function_exists("selisihTanggal")) {
    function selisihTanggal($tanggal)
    {
        $tanggal = strtotime($tanggal);
        $selisih = time() - $tanggal;
        $hari = floor($selisih / (60 * 60 * 24));
        $jam = floor(($selisih % (60 * 60 * 24)) / (60 * 60));
        $menit = floor((($selisih % (60 * 60 * 24)) % (60 * 60)) / 60);
        $detik = floor((($selisih % (60 * 60 * 24)) % (60 * 60)) % 60);
        if ($hari > 0) {
            return $hari . ' h ' . $jam . ' j ' . $menit . ' m';
        } elseif ($jam > 0) {
            return $jam . ' j ' . $menit . ' m';
        } elseif ($menit > 0) {
            return $menit . ' menit';
        } else {
            return 'baru saja';
        }
    }
}

if (!function_exists("getFileSize")) {
    function getFileSize($folder, $type = 'mb')
    {
        $file = new \CodeIgniter\Files\File(FCPATH . $folder);
        $size = $file->getSizeByUnit('mb');
        $size = round($size, 2);
        return $size . ' ' . $type;
    }
}

if (!function_exists("checkData")) {
    function checkData($data)
    {
        if ($data == null || $data == '') {
            return '<span class="badge badge-danger">' . lang('Home.global.no_data') . '</span>';
        } else {
            return $data;
        }
    }
}
