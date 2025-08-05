<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGeographicLocations extends Migration
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
            'entity_table'     => [
                'type'          => 'VARCHAR',
                'constraint'    => 256,
                'comment' => 'The table name',
            ],
            'entity_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'primary key of relavent table',
            ],
            'label'     => [
                'type'          => 'TEXT',
                'null'           => true,
            ],
            'lat'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '15,11',
                'default' => 0.00,
            ],
            'lng'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '15,11',
                'default' => 0.00,
            ],
            'altitude'          => [
                'type'           => 'INT',
                'constraint'     => 4,
                'unsigned'       => true,
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

        $this->forge->addKey('id', true);
        $this->forge->createTable('geographic_locations');
    }

    public function down()
    {
        $this->forge->dropTable('geographic_locations');
    }
}