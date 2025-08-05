<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Edit_off_farm_activity1 extends Migration
{
    public function up()
    {
        $fields = [
            'estimated_cost'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'agreed_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'admin_cost'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'implementation_agency'          => [
                'type'           => 'TEXT',
            ],
        ];

        $this->forge->dropColumn('off_farm_activity', 'expense');  

        $this->forge->addColumn('off_farm_activity', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('off_farm_activity', 'estimated_cost');
        $this->forge->dropColumn('off_farm_activity', 'agreed_amount');
        $this->forge->dropColumn('off_farm_activity', 'admin_cost');
        $this->forge->dropColumn('off_farm_activity', 'implementation_agency');

        $fields = [
            'expense'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
        ];
        $this->forge->addColumn('off_farm_activity', $fields);
    }
}