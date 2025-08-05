<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBankDetails extends Migration
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
            'acc_no'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'bank_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true,
                'comment' => 'Refer primary key of banks table',
            ],
            'bank_code'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'branch'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'comment' => '',
            ],
            'branch_code'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (bank_id) REFERENCES banks(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('bank_details');
    }

    public function down()
    {
        $this->forge->dropTable('bank_details');
    }
}