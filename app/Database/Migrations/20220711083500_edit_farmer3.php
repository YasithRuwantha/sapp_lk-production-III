<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditFarmer3 extends Migration
{
    public function up()
    {
        $fields = [
            'nature_agri_expense'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'           => true,
                'after' => 'source_drinking_water',
                'comment' => '',
            ],
            'expense_agri'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'           => true,
                'after' => 'nature_agri_expense',
                'comment' => '',
            ],
            'nature_expense_other'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'           => true,
                'after' => 'expense_agri',
                'comment' => '',
            ],
            'expense_other'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'           => true,
                'after' => 'nature_expense_other',
                'comment' => '',
            ],
            'undergo_training'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'after' => 'expense_other',
                'comment' => 'Config 63',
            ],
            'samurdhi_pds'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'after' => 'undergo_training',
                'comment' => 'Config 64',
            ],
            'balance_diet'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'after' => 'samurdhi_pds',
                'comment' => 'Config 65',
            ],
            'no_balance_diet'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'after' => 'balance_diet',
                'comment' => '',
            ],
            'hunger_period'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'after' => 'no_balance_diet',
                'comment' => 'Config 66',
            ],
            'financial_decision'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'after' => 'hunger_period',
                'comment' => 'Config 67',
            ],
            'before_barrow'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'after' => 'financial_decision',
                'comment' => 'Config 68',
            ],
            'source_of_credit'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'after' => 'before_barrow',
                'comment' => 'Config 69',
            ],
            'informal_barrow'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'null'           => true,
                'after' => 'source_of_credit',
                'comment' => '',
            ],
            'formal_barrow'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'null'           => true,
                'after' => 'informal_barrow',
                'comment' => '',
            ],
            'repaid_status_informal'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'after' => 'formal_barrow',
                'comment' => 'Config 70',
            ],
            'repaid_status_formal'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'after' => 'repaid_status_informal',
                'comment' => 'Config 71',
            ],
            'repaid_formal'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'null'           => true,
                'after' => 'repaid_status_formal',
                'comment' => '',
            ],
            'repaid_informal'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'null'           => true,
                'after' => 'repaid_formal',
                'comment' => '',
            ],
            'registered_in'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'after' => 'repaid_informal',
                'comment' => 'Config 72',
            ],
            'register_org'     => [
                'type'          => 'VARCHAR',
                'constraint'    => 256,
                'after' => 'registered_in',
            ],
            'created_at'         => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at'         => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'deleted_at'         => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ];

        $this->forge->addColumn('farmer', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('farmer', 'nature_agri_expense'); 
        $this->forge->dropColumn('farmer', 'expense_agri'); 
        $this->forge->dropColumn('farmer', 'nature_expense_other'); 
        $this->forge->dropColumn('farmer', 'expense_other'); 
        $this->forge->dropColumn('farmer', 'undergo_training'); 
        $this->forge->dropColumn('farmer', 'samurdhi_pds'); 
        $this->forge->dropColumn('farmer', 'balance_diet'); 
        $this->forge->dropColumn('farmer', 'hunger_period'); 
        $this->forge->dropColumn('farmer', 'financial_decision'); 
        $this->forge->dropColumn('farmer', 'before_barrow'); 
        $this->forge->dropColumn('farmer', 'source_of_credit'); 
        $this->forge->dropColumn('farmer', 'informal_barrow'); 
        $this->forge->dropColumn('farmer', 'formal_barrow'); 
        $this->forge->dropColumn('farmer', 'repaid_status_informal'); 
        $this->forge->dropColumn('farmer', 'repaid_status_formal'); 
        $this->forge->dropColumn('farmer', 'repaid_formal'); 
        $this->forge->dropColumn('farmer', 'repaid_informal'); 
        $this->forge->dropColumn('farmer', 'registered_in'); 
        $this->forge->dropColumn('farmer', 'register_org'); 
    }
}