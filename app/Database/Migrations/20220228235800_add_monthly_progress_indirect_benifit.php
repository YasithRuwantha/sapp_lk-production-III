<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMonthlyProgressIndirectBenifit extends Migration
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
            'benifit'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'null'           => true,
                'comment' => '',
            ],
            'reporting_month'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'null'           => true,
                'comment' => '',
            ],
            'cumilative'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'null'           => true,
                'comment' => '',
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
        $this->forge->createTable('monthly_progress_indirect_benifit');
    }

    public function down()
    {
        $this->forge->dropTable('monthly_progress_indirect_benifit');
    }
}