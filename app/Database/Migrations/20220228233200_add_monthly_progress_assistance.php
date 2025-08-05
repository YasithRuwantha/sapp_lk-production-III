<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMonthlyProgressAssistance extends Migration
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
            'assistance_input'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'null'           => true,
                'comment' => '',
            ],
            'physical_progress_reporting_month'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '',
            ],
            'physical_progress_reporting_cumilative'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '',
            ],
            'financial_progress_reporting_month'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'financial_progress_reporting_cumilative'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'assistance_type'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => '{"1": "Grant","2": "Credit"}',
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
        $this->forge->createTable('monthly_progress_assistance');
    }

    public function down()
    {
        $this->forge->dropTable('monthly_progress_assistance');
    }
}