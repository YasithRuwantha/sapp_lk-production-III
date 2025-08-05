<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkUserBank extends Migration
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
            'bank_details_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer bank_details table primary key',
            ],
            'user_id'          => [
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (bank_details_id) REFERENCES bank_details(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('link_user_bank');
    }

    public function down()
    {
        $this->forge->dropTable('link_user_bank');
    }
}