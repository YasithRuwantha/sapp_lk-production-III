<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLoan extends Migration
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
            'project_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer project table primary key',
            ],
            'loan_scheme_name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'main_purpose'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'sub_purpose'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'status_applicant'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => '{"1":"Individual of a Company", "2":"Farmer Organization", "3":"Producer Organization", "4":"Farmer Group", "5":"Promoter"}',
            ],
            'source_of_loan'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => '{"1":"IFAD Direct Line", "2":"RF - GoSL"}',
            ],
            'loan_requirement'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'total_budget'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'max_loan_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'time_allocation'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'loan_status'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => '{"1":"Completed", "2":"In progress"}',
            ],
            'loan_effective_date'          => [
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (project_id) REFERENCES project(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('loan');
    }

    public function down()
    {
        $this->forge->dropTable('loan');
    }
}