<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCustomColumnForUser extends Migration
{
    public function up()
    {
        $fields = [
            "gender SET('L', 'P') NULL DEFAULT NULL COMMENT 'gender user'",
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255'
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255'
            ],
            'image_user' => [
                'type'       => 'VARCHAR',
                'constraint' => '255'
            ],
            'phone_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '20'
            ]
        ];
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $fields = [
            'gender',
            'first_name',
            'last_name',
            'image_user',
            'phone_number',
        ];
        $this->forge->dropColumn('users', $fields);
    }
}
