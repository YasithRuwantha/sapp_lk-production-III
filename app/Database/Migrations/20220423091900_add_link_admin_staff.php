<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkAdminStaff extends Migration
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
            'admin_division_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer admin_division table primary key',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (admin_division_id) REFERENCES admin_division(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('link_admin_staff');
    }

    public function down()
    {
        $this->forge->dropTable('link_admin_staff');
    }
}