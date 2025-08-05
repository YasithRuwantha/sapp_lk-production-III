<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkDisbursementCommunityOrg extends Migration
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
            'loan_disbursement_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer loan_disbursement table primary key',
            ],           
            'community_org_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer community_org table primary key',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (loan_disbursement_id) REFERENCES loan_disbursement(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (community_org_id) REFERENCES community_org(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('link_disbursement_community_org');
    }

    public function down()
    {
        $this->forge->dropTable('link_disbursement_community_org');
    }
}