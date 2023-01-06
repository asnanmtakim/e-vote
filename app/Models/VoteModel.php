<?php

namespace App\Models;

use CodeIgniter\Model;

class VoteModel extends Model
{
    protected $table            = 'vote';
    protected $primaryKey       = 'id_vote';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'id_pemilih', 'id_calon', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function getVotebyPemilih($id_pemilih)
    {
        return $this->selectCount('*', 'total')->where('id_pemilih', $id_pemilih)
            ->first();
    }
}
