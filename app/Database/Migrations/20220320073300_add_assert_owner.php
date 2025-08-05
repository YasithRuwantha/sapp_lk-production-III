<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAssertOwner extends Migration
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
            'fixed_asset_registry_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer fixed_asset_registry table primary key',
            ],
            'user_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer user table primary key',
            ],
            'ownership_status'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'comment' => '{1:"Using", 2:"Disposed", 3:"Transferred to another user"}',
            ],
            'ownership_transfer_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'remarks'          => [
                'type'           => 'TEXT',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (fixed_asset_registry_id) REFERENCES fixed_asset_registry(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('fixed_asset_owner');
    }

    public function down()
    {
        $this->forge->dropTable('fixed_asset_owner');
    }
}