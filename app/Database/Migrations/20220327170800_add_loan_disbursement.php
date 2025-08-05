<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLoanDisbursement extends Migration
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
            'loan_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer loan table primary key',
            ],
            'loan_disbursement_entity'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => '{"1":"Farmer Organaization", "2":"Farmer", "3":"Promoter"}',
            ],
            'cbsl_reg_no'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'cbsl_reg_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'required_loan_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'actual_loan_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],            
            'disbursement_status'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => '{"1":"Completed", "2":"In progress"}',
            ],
            'loan_disbursement_date'          => [
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (loan_id) REFERENCES loan(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('loan_disbursement');
    }

    public function down()
    {
        $this->forge->dropTable('loan_disbursement');
    }
}