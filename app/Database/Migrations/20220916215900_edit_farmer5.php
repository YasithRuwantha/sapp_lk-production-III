<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditFarmer5 extends Migration
{
    public function up()
    {
        $fields = [
            'civil_status'          => [
                'type'           => 'INT',
                'constraint'     => 1,
                'null'           => true,
                'after' => 'register_org',
                'comment' => 'Config 97',
            ],
            'no_household_members'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'after' => 'civil_status',
            ],
            'male_under_5'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'after' => 'no_household_members',
            ],
            'female_under_5'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'after' => 'male_under_5',
            ],
            'male_5_to_14'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'after' => 'female_under_5',
            ],
            'female_5_to_14'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'after' => 'male_5_to_14',
            ],
            'male_15_to_29'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'after' => 'female_5_to_14',
            ],
            'female_15_to_29'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'after' => 'male_15_to_29',
            ],
            'male_30_to_49'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'after' => 'female_15_to_29',
            ],
            'female_30_to_49'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'after' => 'male_30_to_49',
            ],
            'male_50_to_64'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'after' => 'female_30_to_49',
            ],
            'female_50_to_64'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
                'after' => 'male_50_to_64',
            ],
        ];

        $this->forge->addColumn('farmer', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('farmer', 'civil_status'); 
        $this->forge->dropColumn('farmer', 'no_household_members'); 
        $this->forge->dropColumn('farmer', 'male_under_5');
        $this->forge->dropColumn('farmer', 'female_under_5'); 
        $this->forge->dropColumn('farmer', 'male_5_to_14'); 
        $this->forge->dropColumn('farmer', 'female_5_to_14'); 
        $this->forge->dropColumn('farmer', 'male_15_to_29'); 
        $this->forge->dropColumn('farmer', 'female_15_to_29'); 
        $this->forge->dropColumn('farmer', 'male_30_to_49'); 
        $this->forge->dropColumn('farmer', 'female_30_to_49'); 
        $this->forge->dropColumn('farmer', 'male_50_to_64'); 
        $this->forge->dropColumn('farmer', 'female_50_to_64'); 
    }
}