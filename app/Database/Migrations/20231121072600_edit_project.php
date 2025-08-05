<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditProject extends Migration
{
    public function up()
    {
        $fields = [
            'start_date'          => [
                'type'           => 'DATE',
                'comment' => 'project start date',
                'after' => 'deleted_at',
            ],
            'end_date'          => [
                'type'           => 'DATE',
                'comment' => 'project end date',
                'after' => 'start_date',
            ],
        ];

        $this->forge->addColumn('project', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('project', 'start_date'); 
        $this->forge->dropColumn('project', 'end_date'); 
    }
}

