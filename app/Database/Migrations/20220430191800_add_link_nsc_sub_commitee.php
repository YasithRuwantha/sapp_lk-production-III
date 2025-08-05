<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkNscSubCommitee extends Migration
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
            'nsc_meeting_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer nsc_meeting table primary key',
            ],
            'sub_commitee_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer sub_commitee_member table primary key',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (nsc_meeting_id) REFERENCES nsc_meeting(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (sub_commitee_id) REFERENCES sub_commitee_members(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('link_nsc_sub_commitee');
    }

    public function down()
    {
        $this->forge->dropTable('link_nsc_sub_commitee');
    }
}