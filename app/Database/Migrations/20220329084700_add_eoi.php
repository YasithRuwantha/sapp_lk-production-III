<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEoi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'eoi_name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ], 
            'eoi_type'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => '{"1":"Grant Only", "2":"Loan Only", "3":"Grant & Loan"}',
            ],  
            'eoi_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],        
            'eoi_status'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => '{"1":"Planned", "2":"Published", "3":"Closed", "4":"BP Accepted"}',
            ], 
            'created_at'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'deleted_at'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('eoi');
    }

    public function down()
    {
        $this->forge->dropTable('eoi');
    }
}