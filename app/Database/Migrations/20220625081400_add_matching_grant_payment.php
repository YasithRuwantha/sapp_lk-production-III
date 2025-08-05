<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMatchingGrantPayment extends Migration
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
            'matching_grant_development_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key matching_grant_development table',
            ],
            'payment_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'payment_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'remarks'          => [
                'type'           => 'TEXT',
                'null'           => true,
                'comment' => '',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (matching_grant_development_id) REFERENCES matching_grant_development(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('matching_grant_payment');
    }

    public function down()
    {
        $this->forge->dropTable('matching_grant_payment');
    }
}