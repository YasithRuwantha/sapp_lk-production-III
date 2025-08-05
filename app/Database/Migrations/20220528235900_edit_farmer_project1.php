<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditFarmerProject1 extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('farmer_project', 'vcm_recomendation');    
        $this->forge->dropColumn('farmer_project', 'vcm_recomendation_remark');   
        $this->forge->dropColumn('farmer_project', 'rpc_recomendation');   
        $this->forge->dropColumn('farmer_project', 'rpc_recomendation_remark');   
        $this->forge->dropColumn('farmer_project', 'liason_recomendation');   
        $this->forge->dropColumn('farmer_project', 'liason_recomendation_remark');       
        $this->forge->dropColumn('farmer_project', 'vcm_approval_date_time');  
        $this->forge->dropColumn('farmer_project', 'rpc_approval_date_time');  
        $this->forge->dropColumn('farmer_project', 'liason_approval_date_time');  
    }

    public function down()
    {
        $fields = [
            'vcm_recomendation'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => '{"1": "Approved", "2":"Rejected", "3":"Pending"}',
            ],
            'vcm_recomendation_remark'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'rpc_recomendation'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => '{"1": "Approved", "2":"Rejected", "3":"Pending"}',
            ],
            'rpc_recomendation_remark'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'liason_recomendation'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => '{"1": "Approved", "2":"Rejected", "3":"Pending"}',
            ],
            'liason_recomendation_remark'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'vcm_approval_date_time'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'rpc_approval_date_time'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'liason_approval_date_time'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
        ];

        $this->forge->addColumn('farmer_project', $fields);
    }
}