<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStaffLeave extends Migration
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
            'user_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer user table primary key',
            ],
            'report_period'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 16,
                'null'           => true,
                'comment' => 'Reporting Month should couple with year Ex. Jan/22',
            ],
            'no_casual_leave'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default' => 0,
            ],
            'no_annual_leave'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default' => 0,
            ],
            'no_sick_leave'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default' => 0,
            ],
            'no_duty_leave'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default' => 0,
            ],
            'no_nopay_leave'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default' => 0,
            ],
            'no_lieu_leave'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default' => 0,
            ],
            'no_short_leave'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default' => 0,
            ],
            'hrs_overtime'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default' => 0,
            ],
            'no_ph_work'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default' => 0,
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(ID)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('staff_leave');
    }

    public function down()
    {
        $this->forge->dropTable('staff_leave');
    }
}