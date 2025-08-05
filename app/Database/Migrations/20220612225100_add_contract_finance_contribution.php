<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddContractExtention extends Migration
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
            'contract_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer contract table primary key',
            ],
            'fianance_source'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => 'Config 45',
            ],
            'amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'remarks'            => [
                'type'           => 'TEXT',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (contract_id) REFERENCES contract(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('contract_finance_contribution');
    }

    public function down()
    {
        $this->forge->dropTable('contract_finance_contribution');
    }
}