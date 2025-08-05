<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTrainingResourcePerson extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_training'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_resource'          => [
                'type'           => 'INT',
                'constraint'     => 11,
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (id_training) REFERENCES training(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (id_resource) REFERENCES resource_person(id)');

        $this->forge->createTable('training_resource_person');
    }

    public function down()
    {
        $this->forge->dropTable('training_resource_person');
    }
}