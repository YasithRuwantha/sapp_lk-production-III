<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFarmer extends Migration
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
            ],
            'barrower_type'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => '1 - Main, 2 - Sub',
            ],
            'head_hh'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'comment' => 'Refer config 38',
            ],
            'address_no'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 32,
                'null'           => true,
            ],
            'address_street'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
            ],
            'address_city'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
            ],
            'whatsapp_no'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 16,
                'null'           => true,
            ],
            'citizenship_by'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => 'Eg. 1 - By registration / 2 - By descent',
            ],
            'heighest_education_qualification'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'null'           => true,
                'comment' => 'Refer config table record number 5',
            ],
            'availability_drinking_water'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => 'Eg. 1-Yes / 2-No',
            ],
            'source_drinking_water'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'null'           => true,
                'comment' => 'Config row 10',
            ],
            'availability_water_crops'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => 'Eg. 1-Yes / 2-No',
            ],
            'source_water_crops'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'null'           => true,
                'comment' => 'Config row 11',
            ],
            'cond_house_floor'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'null'           => true,
                'comment' => 'Config row 12',
            ],
            'consumer_durables'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'null'           => true,
                'comment' => 'Config row 13',
            ],
            'avilability_vehicles'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'null'           => true,
                'comment' => 'Config row 14',
            ],
            'sanitation'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'null'           => true,
                'comment' => 'Config row 15',
            ],
            'agri_equipments'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'null'           => true,
                'comment' => 'Config row 16',
            ],
            'tools_farmland'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'null'           => true,
                'comment' => 'Config row 9',
            ],
            'main_source_income'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => 'Config row 17',
            ],
            'main_source_income_nature'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => 'Config row 7',
            ],
            'avg_main_agriculture_income'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'avg_main_agricultutre_income_nature'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => 'Config row 7',
            ],
            'avg_harvest_income'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'other_income'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'other_income_nature'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => 'Config row 7',
            ],
            'other_income_discription'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'null'           => true,
            ],
            'availability_electricity'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => 'Eg. 1-Yes / 2-No',
            ],
            'electricity_from'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => 'Config row 8',
            ],
        ]);

        $this->forge->addField('CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(ID)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('farmer');
    }

    public function down()
    {
        $this->forge->dropTable('farmer');
    }
}