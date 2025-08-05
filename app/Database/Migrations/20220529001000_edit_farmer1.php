<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditFarmer1 extends Migration
{
    public function up()
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
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'rpc_approval_date_time'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'liason_approval_date_time'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ];

        $this->forge->addColumn('farmer', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('farmer', 'vcm_recomendation');    
        $this->forge->dropColumn('farmer', 'vcm_recomendation_remark');   
        $this->forge->dropColumn('farmer', 'rpc_recomendation');   
        $this->forge->dropColumn('farmer', 'rpc_recomendation_remark');   
        $this->forge->dropColumn('farmer', 'liason_recomendation');   
        $this->forge->dropColumn('farmer', 'liason_recomendation_remark');       
        $this->forge->dropColumn('farmer', 'vcm_approval_date_time');  
        $this->forge->dropColumn('farmer', 'rpc_approval_date_time');  
        $this->forge->dropColumn('farmer', 'liason_approval_date_time');  
    }
}