<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkPromoterBank extends Migration
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
            'bank_details_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer bank_details table primary key',
            ],
            'promoter_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer promoter table primary key',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (bank_details_id) REFERENCES bank_details(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (promoter_id) REFERENCES promoter(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('link_promoter_bank');
    }

    public function down()
    {
        $this->forge->dropTable('link_promoter_bank');
    }
}