<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMonthlyProgressMicroFinance extends Migration
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
            'monthly_progress_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer monthly_progress_report table primary key',
            ],
            'loans_applied_month'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '',
            ],
            'loans_reg_cbsl_month'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '',
            ],
            'no_loans_issued_month'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '',
            ],
            'loans_applied_cumilative'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '',
            ],
            'loans_reg_cbsl_cumilative'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '',
            ],
            'loans_issued_cumilative'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '',
            ],
            'loans_applied_lkr_month'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'loans_reg_cbsl_lkr_month'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'loans_issued_lkr_month'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'loans_applied_lkr_cumilative'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'loans_issued_lkr_cumilative'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'type_of_loan'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '{"1": "Capital Loan","2": "Seasonal Loan"}',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (monthly_progress_id) REFERENCES monthly_progress_report(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('monthly_progress_micro_finance');
    }

    public function down()
    {
        $this->forge->dropTable('monthly_progress_micro_finance');
    }
}