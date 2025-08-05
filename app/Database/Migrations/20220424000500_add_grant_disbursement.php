<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGrantDisbursement extends Migration
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
            'grant_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer grant table primary key',
            ],
            'farmer_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer user table primary key',
            ],
            'remarks'          => [
                'type'           => 'TEXT',
                'null'           => true,
                'comment' => '',
            ],
            'total_grant_provided'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'max_grant_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'max_credit_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],            
            'disbursement_status'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => '{"1":"Scheduled", "2":"Grant Dispatched","3":"Cancelled","4":"Rejected"}',
            ],
            'date_of_grant'          => [
                'type'           => 'DATE',
                'null'           => true,
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (farmer_id) REFERENCES user(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (grant_id) REFERENCES `grant`(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('grant_disbursement');
    }

    public function down()
    {
        $this->forge->dropTable('grant_disbursement');
    }
}