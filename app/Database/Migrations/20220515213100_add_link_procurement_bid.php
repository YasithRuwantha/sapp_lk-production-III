<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkProcurementBid extends Migration
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
            'procurement_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer procurement table primary key',
            ],
            'bid_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer procurement_bid table primary key',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (procurement_id) REFERENCES procurement(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (bid_id) REFERENCES procurement_bid(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('link_procurement_bid');
    }

    public function down()
    {
        $this->forge->dropTable('link_procurement_bid');
    }
}