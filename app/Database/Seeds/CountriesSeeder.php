<?php
/**
 * Insert all site config values
 * Execute following command from project root and make sure to login as apache user or sudo
 * php spark db:seed ConfigSeeder
 */


namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CountriesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'            => 213,
                'phone_code'     => '94',
                'country_code'         => 'LK',
                'country_name'         => 'Sri Lanka',
            ],
            [
                'id'            => 213,
                'phone_code'     => '91',
                'country_code'         => 'IN',
                'country_name'         => 'India',
            ],
        ];

        $this->db->table('countries')->insertBatch($data);
    }
}