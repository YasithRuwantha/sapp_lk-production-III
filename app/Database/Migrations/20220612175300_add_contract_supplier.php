<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddContractSupplier extends Migration
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
            'name'              => [
                'type'          => 'VARCHAR',
                'constraint'    => 64,
            ],
            'reg_no'            => [
                'type'          => 'VARCHAR',
                'constraint'    => 64,
            ],
            'country_of_origin'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer countrries table primary key',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (country_of_origin) REFERENCES countries(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('contract_supplier');
    }

    public function down()
    {
        $this->forge->dropTable('contract_supplier');
    }
}