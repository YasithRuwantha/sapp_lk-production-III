<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditLoan1 extends Migration
{
    public function up()
    {
        $fields = [
            'type_of_loan_scheme'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'after' => 'loan_scheme_name',
                'comment' => 'Refer config table number 31',
            ],
        ];

        $this->forge->addColumn('loan', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('loan', 'type_of_loan_scheme');
    }
}