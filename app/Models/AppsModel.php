<?php

namespace App\Models;

use CodeIgniter\Model;

class AppsModel extends Model
{
    protected $table = 'app_identity';
    protected $primaryKey = 'conf_char';
    protected $allowedFields = [
        'conf_name', 'conf_type', 'conf_value', 'conf_value_en', 'conf_description', 'conf_order',
        'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'
    ];
}
