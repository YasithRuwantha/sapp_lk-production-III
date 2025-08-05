<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkDisbursementPromoter extends Migration
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
            'promoter_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer promoter table primary key',
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
        $this->forge->addField('CONSTRAINT FOREIGN KEY (promoter_id) REFERENCES promoter(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('link_disbursement_promoter');
    }

    public function down()
    {
        $this->forge->dropTable('link_disbursement_promoter');
    }
}