<?php

namespace App\Models;

use CodeIgniter\Model;

class CalonModel extends Model
{
    protected $table            = 'calon';
    protected $primaryKey       = 'id_calon';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'nama_calon', 'gender_calon', 'foto_calon', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function getHasilVote()
    {
        return $this->select('calon.*, (SELECT COUNT(*) FROM vote WHERE id_calon=calon.id_calon AND deleted_at IS NULL) AS jumlah_hasil')
            ->orderBy('jumlah_hasil', 'DESC')
            ->find();
    }
}
