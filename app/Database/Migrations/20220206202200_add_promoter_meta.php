<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPromoterMeta extends Migration
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
            'business_type'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => 'Refer config table row 20',
            ],
            'org_name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
            ],
            'business_registration_no'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
            ],
            'auth_officer_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer user table primary key',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (auth_officer_id) REFERENCES user(ID)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('promoter');
    }

    public function down()
    {
        $this->forge->dropTable('promoter');
    }
}