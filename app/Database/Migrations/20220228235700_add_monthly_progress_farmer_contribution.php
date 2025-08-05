<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMonthlyProgressFarmerContribution extends Migration
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
            'activity'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => '{"1": "Land preparation","2": "Planting","3": "Insurance","4": "Harvesting","5": "Other (pls specify)"}',
            ],
            'other_activity'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'null'           => true,
                'comment' => '',
            ],
            'no_of_activity_reporting_month'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '',
            ],
            'estimated_cost_reporting_month'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'no_of_activity_cumilative'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '',
            ],            
            'estimated_cost_cumilative'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
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
        $this->forge->createTable('monthly_progress_farmer_contribution');
    }

    public function down()
    {
        $this->forge->dropTable('monthly_progress_farmer_contribution');
    }
}