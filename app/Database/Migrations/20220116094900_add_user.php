<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUser extends Migration
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
            'pin'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 16,
                'comment' => 'This is the personal identification number as NIC / Passport number',
            ],
            'profile_picture'    => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'default' => 1,
            ],
            'fname'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
            ],
            'lname'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
            ],
            'mobile'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 16,
            ],
            'email'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
            ],
            'password'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 32,
            ],
            'otp'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 32,
                'default' => 1,
            ],
            'dob'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'gender'          => [
                'type'           => 'INT',
                'constraint'     => 1,
                'comment' => '1-male, 2-female',
            ],
            'language'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 4,
                'default' => 'en',
                'comment' => 'en, si, ta',
            ],
            'status'          => [
                'type'           => 'INT',
                'constraint'     => 1,
                'default' => 3,
                'comment' => '1_active, 2_suspended, 3_pending, 4_inactive',
            ],
            'is_delete'          => [
                'type'           => 'INT',
                'constraint'     => 1,
                'default' => 0,
                'comment' => '0-not deleted,1-deleted',
            ],
        ]);

        $this->forge->addField('CONSTRAINT FOREIGN KEY (profile_picture) REFERENCES file_registry(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}