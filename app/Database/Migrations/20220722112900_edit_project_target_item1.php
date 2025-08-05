<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditProjectTargetItem1 extends Migration
{
    public function up()
    {
        $fields = [
            'project_target_item_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'after' => 'item_name',
                'comment' => 'Forign key project_target_item table',
            ],
        ];

        $this->forge->addField('CONSTRAINT FOREIGN KEY (project_target_item_id) REFERENCES project_target_item(id)');

        $this->forge->addColumn('grant_item_farmer', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('grant_item_farmer', 'project_target_item_id'); 
    }
}