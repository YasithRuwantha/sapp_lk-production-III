<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStaffContractMgt extends Migration
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
            'user_id'            => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key user table',
            ],
            'contract_effective_date'       => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'contract_expiary_date'       => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'contract_status'    => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => 'Config 55',
            ],
            'remarks'            => [
                'type'           => 'TEXT',
                'null'           => true,
                'comment'        => '',
            ],
            'created_at'         => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at'         => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'deleted_at'         => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addField('CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('staff_contract_mgt');
    }

    public function down()
    {
        $this->forge->dropTable('staff_contract_mgt');
    }
}