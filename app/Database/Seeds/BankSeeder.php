<?php
/**
 * Insert all site config values
 * Execute following command from project root and make sure to login as apache user or sudo
 * php spark db:seed ConfigSeeder
 */


namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BankSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'            => 1,
                'bank'     => 'Amana Bank',
            ],
            [
                'id'            => 2,
                'bank'     => 'Bank of Ceylon',
            ],
            [
                'id'            => 3,
                'bank'     => 'Bank of China',
            ],
            [
                'id'            => 4,
                'bank'     => 'Cargills Bank',
            ],
            [
                'id'            => 5,
                'bank'     => 'Citibank',
            ],
            [
                'id'            => 6,
                'bank'     => 'Commercial Bank of Ceylon',
            ],
            [
                'id'            => 7,
                'bank'     => 'Deutsche Bank',
            ],
            [
                'id'            => 8,
                'bank'     => 'DFCC Bank',
            ],
            [
                'id'            => 9,
                'bank'     => 'Habib Bank',
            ],
            [
                'id'            => 10,
                'bank'     => 'Hatton National Bank',
            ],
            [
                'id'            => 11,
                'bank'     => 'Indian Bank',
            ],
            [
                'id'            => 12,
                'bank'     => 'Indian Overseas Bank',
            ],
            [
                'id'            => 13,
                'bank'     => 'MCB Bank',
            ],
            [
                'id'            => 14,
                'bank'     => 'National Development Bank',
            ],
            [
                'id'            => 15,
                'bank'     => 'Nations Trust Bank',
            ],
            [
                'id'            => 16,
                'bank'     => 'Pan Asia Banking Corporation',
            ],
            [
                'id'            => 17,
                'bank'     => "People's Bank",
            ],
            [
                'id'            => 18,
                'bank'     => 'Public Bank Berhad',
            ],
            [
                'id'            => 19,
                'bank'     => 'Sampath Bank',
            ],
            [
                'id'            => 20,
                'bank'     => 'Seylan Bank',
            ],
            [
                'id'            => 21,
                'bank'     => 'Standard Chartered Bank',
            ],
            [
                'id'            => 22,
                'bank'     => 'State Bank of India',
            ],
            [
                'id'            => 23,
                'bank'     => 'HSBC',
            ],
            [
                'id'            => 24,
                'bank'     => 'Union Bank of Colombo',
            ],
            [
                'id'            => 25,
                'bank'     => 'HDFC',
            ],
            [
                'id'            => 26,
                'bank'     => 'National Savings Bank',
            ],
            [
                'id'            => 27,
                'bank'     => 'Pradeshiya Sanwardhana Bank',
            ],
            [
                'id'            => 28,
                'bank'     => 'Sanasa Development Bank',
            ],
            [
                'id'            => 29,
                'bank'     => 'Sri Lanka Savings Bank',
            ],
            [
                'id'            => 30,
                'bank'     => 'State Mortgage & Investment Bank',
            ],
        ];

        $this->db->table('banks')->insertBatch($data);
    }
}