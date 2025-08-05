<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddContract extends Migration
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
            'contract_name'     => [
                'type'          => 'VARCHAR',
                'constraint'    => 64,
            ],
            'contract_number'            => [
                'type'          => 'VARCHAR',
                'constraint'    => 64,
            ],
            'procurement_discrption'            => [
                'type'          => 'TEXT',
            ],
            'supplier_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer contract_supplier table primary key',
            ],
            'date_of_signed'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],            
            'duration_months'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'respective_sapp_division'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => 'Config 40',
            ],
            'sapp_representive_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer contract_supplier table primary key',
            ],
            'prior_post_review'     => [
                'type'          => 'VARCHAR',
                'constraint'    => 64,
            ],
            'start_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],  
            'end_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],  
            'currency'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => 'Config 41',
            ],
            'ifad_financing'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => 'Config 42',
            ],
            'ifad_no_objection_no'     => [
                'type'          => 'VARCHAR',
                'constraint'    => 256,
            ],
            'contract_status'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => 'Config 43',
            ],
            'percentage_physical_progress'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'performance_evaluation'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => 'Config 44',
            ],
            'remarks'            => [
                'type'           => 'TEXT',
            ],
            'claimed_widrawal'     => [
                'type'          => 'VARCHAR',
                'constraint'    => 64,
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (supplier_id) REFERENCES contract_supplier(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (sapp_representive_id) REFERENCES user(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('contract');
    }

    public function down()
    {
        $this->forge->dropTable('contract');
    }
}