<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEoiApplicant extends Migration
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
            'title_of_applicant'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ], 
            'first_name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ], 
            'last_name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ], 
            'address'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ], 
            'district_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key district table',
            ],  
            'contact_no_land'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 16,
                'null'           => true,
                'comment' => '',
            ], 
            'contact_no_mobile'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 16,
                'null'           => true,
                'comment' => '',
            ], 
            'email'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ], 
            'nature_of_business'          => [
                'type'           => 'TEXT',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (district_id) REFERENCES district(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('eoi_applicant');
    }

    public function down()
    {
        $this->forge->dropTable('eoi_applicant');
    }
}