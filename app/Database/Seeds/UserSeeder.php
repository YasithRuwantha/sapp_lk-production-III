<?php
/**
 * Insert all site config values
 * Execute following command from project root and make sure to login as apache user or sudo
 * php spark db:seed ConfigSeeder
 */


namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'            => 0,
                'added_on'     => 1,
                'ref_table'         => 'user',
                'relative_path'         => '/public/resource/common/placeholder.png',
                'status'     => 1,
            ]
        ];

        $this->db->table('file_registry')->insertBatch($data);
    }
}