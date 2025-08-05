<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTrainingExpenditure extends Migration
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
            'id_training'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'expenditure_type'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'null'           => true,
                'comment' => '{"1": "Refreshment & Foods","2": "Travel Expenses","3": "Resource Persons","4": "Other"}',
            ],
            'amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
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

        $this->forge->addKey('id', true);
        $this->forge->createTable('training_expenditure');
    }

    public function down()
    {
        $this->forge->dropTable('training_expenditure');
    }
}