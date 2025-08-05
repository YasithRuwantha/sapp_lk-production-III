<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditLoan2 extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('loan', 'status_applicant');    
        $this->forge->dropColumn('loan', 'source_of_loan');   
        $this->forge->dropColumn('loan', 'total_budget');   
        $this->forge->dropColumn('loan', 'max_loan_amount');   
        $this->forge->dropColumn('loan', 'time_allocation');   
        $this->forge->dropColumn('loan', 'loan_effective_date');       
    }

    public function down()
    {
        $fields = [
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
            'loan_effective_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
        ];

        $this->forge->addColumn('loan', $fields);
    }
}