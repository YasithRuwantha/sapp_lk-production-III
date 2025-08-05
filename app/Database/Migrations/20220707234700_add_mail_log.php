<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMailLog extends Migration
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
            'to_address'        => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'subject'        => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'body'        => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'status'    => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => '{"1":"Pending","2":"Sent","3":"Delivered"}',
            ],
            'log_text'        => [
                'type'           => 'TEXT',
                'null'           => true,
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

        $this->forge->addKey('id', true);
        $this->forge->createTable('mail_log');
    }

    public function down()
    {
        $this->forge->dropTable('mail_log');
    }
}