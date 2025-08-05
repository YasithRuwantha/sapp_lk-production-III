<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditFarmer2 extends Migration
{
    public function up()
    {
        $fields = [
            'age_while_register'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'after' => 'heighest_education_qualification',
                'comment' => 'Age at the time of registration',
            ],
        ];

        $this->forge->addColumn('farmer', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('farmer', 'age_while_register'); 
    }
}