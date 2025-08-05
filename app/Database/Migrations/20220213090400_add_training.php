<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTraining extends Migration
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
            'id_project'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer project table primary key',
            ],
            'training_name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'comment' => '',
            ],
            'start_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'end_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'objective'          => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'type_of_training'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => 'Refer config table row 21',
            ],
            'category'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => '{"1": "4P","2": "Youth"}',
            ],
            'training_status'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => '{"1": "Planned","2": "Completed","3": "Cancelled"}',
            ],
            'organized_by'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => '{"1": "Promoter","2": "PMU","3": "PFI","4": "FO"}',
            ],
            'organizer_name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
            ],
            'participants_male'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '',
            ],
            'participants_female'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '',
            ],
            'participants_gender_not_specified'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '',
            ],
            'no_guest_attendees'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => '',
            ],
            'key_points_discussed'          => [
                'type'           => 'TEXT',
                'null'           => true,
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (id_project) REFERENCES project(ID)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('training');
    }

    public function down()
    {
        $this->forge->dropTable('training');
    }
}