<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditGrantItemFarmer1 extends Migration
{
    public function up()
    {
        $fields = [
            'status'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'after' => 'supplier_name',
                'comment' => 'Config 39',
            ],
        ];

        $this->forge->addColumn('grant_item_farmer', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('grant_item_farmer', 'status'); 
    }
}