<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLoanDisbursementStatus extends Migration
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
            'disbursement_status'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => '{"1":"Completed", "2":"In progress"}',
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

        $this->forge->addKey('id', true);
        $this->forge->createTable('loan_disbursement_status');
    }

    public function down()
    {
        $this->forge->dropTable('loan_disbursement_status');
    }
}