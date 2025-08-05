<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStaffMeta extends Migration
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
            'permanant_address_no'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 32,
                'null'           => true,
            ],
            'permanant_address_street'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
            ],
            'permanant_address_city'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
            ],
            'temp_address_no'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 32,
                'null'           => true,
            ],
            'temp_address_street'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
            ],
            'temp_address_city'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
            ],
            'emergency_contact'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 16,
                'null'           => true,
            ],
            'assigned_admin_region'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
            ],
            'assigned_admin_division'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
            ],
            'appointment_date'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'employee_no'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 32,
                'null'           => true,
            ],
            'employer_no'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 32,
                'null'           => true,
            ],
            'maritial_status'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'null'           => true,
                'comment' => '1 - Married, 2 - Widowed, 3 - Separated, 4 - Divorced, 5 - Single',
            ],
            'recruitment_type'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'null'           => true,
                'comment' => 'Refer config table record number 4',
            ],
            'phone_office'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 16,
                'null'           => true,
            ],
            'phone_extension'          => [
                'type'           => 'INT',
                'constraint'     => 8,
                'unsigned'       => true,
                'null'           => true,
            ],
            'heighest_education_qualification'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'null'           => true,
                'comment' => 'Refer config table record number 5',
            ],
            'professional_membership'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
            ],
            'salary_scale'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
            ],
            'basic_salary'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'allowance'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'net_salary'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
            ],
            'employment_status'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'null'           => true,
                'comment' => '1 - Active, 2 - Left',
            ],
            'last_date_sapp'          => [
                'type'           => 'DATE',
                'null'           => true,
            ],
        ]);

        $this->forge->addField('CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(ID)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('staff_meta');
    }

    public function down()
    {
        $this->forge->dropTable('staff_meta');
    }
}