<?php
/**
 * Insert all site config values
 * Execute following command from project root and make sure to login as apache user or sudo
 * php spark db:seed GndAddSeeder
 */


namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GndAddSeeder extends Seeder
{
    public function run()
    {
        $dsd_data = [
            [
                'id' => 333,
                'district_id' => 1,
                'dsd' => 'Kalutara District',
            ],
            [
                'id' => 334,
                'district_id' => 2,
                'dsd' => 'Gampaha District',
            ],
            [
                'id' => 335,
                'district_id' => 3,
                'dsd' => 'Colombo District',
            ],
            [
                'id' => 336,
                'district_id' => 4,
                'dsd' => 'Nuwara Eliya District',
            ],
            [
                'id' => 337,
                'district_id' => 5,
                'dsd' => 'Kandy District',
            ],
            [
                'id' => 338,
                'district_id' => 6,
                'dsd' => 'Matale District',
            ],
            [
                'id' => 339,
                'district_id' => 7,
                'dsd' => 'Hambantota District',
            ],[
                'id' => 340,
                'district_id' => 8,
                'dsd' => 'Galle District',
            ],
            [
                'id' => 341,
                'district_id' => 9,
                'dsd' => 'Matara District',
            ],
            [
                'id' => 342,
                'district_id' => 10,
                'dsd' => 'Kilinochchi District',
            ],
            [
                'id' => 343,
                'district_id' => 11,
                'dsd' => 'Vavuniya District',
            ],
            [
                'id' => 344,
                'district_id' => 12,
                'dsd' => 'Mannar District',
            ],
            [
                'id' => 345,
                'district_id' => 13,
                'dsd' => 'Mullaitive District',
            ],
            [
                'id' => 346,
                'district_id' => 14,
                'dsd' => 'Jaffna District',
            ],
            [
                'id' => 347,
                'district_id' => 15,
                'dsd' => 'Batticaloa District',
            ],
            [
                'id' => 348,
                'district_id' => 16,
                'dsd' => 'Ampara District',
            ],
            [
                'id' => 349,
                'district_id' => 17,
                'dsd' => 'Trincomalee District',
            ],
            [
                'id' => 350,
                'district_id' => 18,
                'dsd' => 'Kurunegala District',
            ],
            [
                'id' => 351,
                'district_id' => 19,
                'dsd' => 'Puttalam District',
            ],
            [
                'id' => 352,
                'district_id' => 20,
                'dsd' => 'Anuradhapura District',
            ],
            [
                'id' => 353,
                'district_id' => 21,
                'dsd' => 'Polonnaruwa District',
            ],
            [
                'id' => 354,
                'district_id' => 22,
                'dsd' => 'Ratnapura District',
            ],
            [
                'id' => 355,
                'district_id' => 23,
                'dsd' => 'Kegalle District',
            ],
            [
                'id' => 356,
                'district_id' => 24,
                'dsd' => 'Monaragala District',
            ],
            [
                'id' => 357,
                'district_id' => 25,
                'dsd' => 'Badulla District',
            ],

        ];

        $this->db->table('dsd')->insertBatch($dsd_data);

        $gnd_data = [
            [
                'id' => 14052,
                'dsd_id' => 333,
                'gnd' => 'Kalutara District',
            ],
            [
                'id' => 14053,
                'dsd_id' => 334,
                'gnd' => 'Gampaha District',
            ],
            [
                'id' => 14054,
                'dsd_id' => 335,
                'gnd' => 'Colombo District',
            ],
            [
                'id' => 14055,
                'dsd_id' => 336,
                'gnd' => 'Nuwara Eliya District',
            ],
            [
                'id' => 14056,
                'dsd_id' => 337,
                'gnd' => 'Kandy District',
            ],
            [
                'id' => 14057,
                'dsd_id' => 338,
                'gnd' => 'Matale District',
            ],
            [
                'id' => 14058,
                'dsd_id' => 339,
                'gnd' => 'Hambantota District',
            ],
            [
                'id' => 14059,
                'dsd_id' => 340,
                'gnd' => 'Galle District',
            ],
            [
                'id' => 14060,
                'dsd_id' => 341,
                'gnd' => 'Matara District',
            ],
            [
                'id' => 14061,
                'dsd_id' => 342,
                'gnd' => 'Kilinochchi District',
            ],
            [
                'id' => 14062,
                'dsd_id' => 343,
                'gnd' => 'Vavuniya District',
            ],
            [
                'id' => 14063,
                'dsd_id' => 344,
                'gnd' => 'Mannar District',
            ],
            [
                'id' => 14064,
                'dsd_id' => 345,
                'gnd' => 'Mullaitive District',
            ],
            [
                'id' => 14065,
                'dsd_id' => 346,
                'gnd' => 'Jaffna District',
            ],
            [
                'id' => 14066,
                'dsd_id' => 347,
                'gnd' => 'Batticaloa District',
            ],
            [
                'id' => 14067,
                'dsd_id' => 348,
                'gnd' => 'Ampara District',
            ],
            [
                'id' => 14068,
                'dsd_id' => 349,
                'gnd' => 'Trincomalee District',
            ],
            [
                'id' => 14069,
                'dsd_id' => 350,
                'gnd' => 'Kurunegala District',
            ],
            [
                'id' => 14070,
                'dsd_id' => 351,
                'gnd' => 'Puttalam District',
            ],
            [
                'id' => 14071,
                'dsd_id' => 352,
                'gnd' => 'Anuradhapura District',
            ],
            [
                'id' => 14072,
                'dsd_id' => 353,
                'gnd' => 'Polonnaruwa District',
            ],
            [
                'id' => 14073,
                'dsd_id' => 354,
                'gnd' => 'Ratnapura District',
            ],
            [
                'id' => 14074,
                'dsd_id' => 355,
                'gnd' => 'Kegalle District',
            ],
            [
                'id' => 14075,
                'dsd_id' => 356,
                'gnd' => 'Monaragala District',
            ],
            [
                'id' => 14076,
                'dsd_id' => 357,
                'gnd' => 'Badulla District',
            ],
        ];

        $this->db->table('gnd')->insertBatch($gnd_data);

        $agg_data = [
            [
                'id' => 333,
                'name' => 'Kalutara District',
            ],
            [
                'id' => 334,
                'name' => 'Gampaha District',
            ],
            [
                'id' => 335,
                'name' => 'Colombo District',
            ],
            [
                'id' => 336,
                'name' => 'Nuwara Eliya District',
            ],
            [
                'id' => 337,
                'name' => 'Kandy District',
            ],
            [
                'id' => 338,
                'name' => 'Matale District',
            ],
            [
                'id' => 339,
                'name' => 'Hambantota District',
            ],[
                'id' => 340,
                'name' => 'Galle District',
            ],
            [
                'id' => 341,
                'name' => 'Matara District',
            ],
            [
                'id' => 342,
                'name' => 'Kilinochchi District',
            ],
            [
                'id' => 343,
                'name' => 'Vavuniya District',
            ],
            [
                'id' => 344,
                'name' => 'Mannar District',
            ],
            [
                'id' => 345,
                'name' => 'Mullaitive District',
            ],
            [
                'id' => 346,
                'name' => 'Jaffna District',
            ],
            [
                'id' => 347,
                'name' => 'Batticaloa District',
            ],
            [
                'id' => 348,
                'name' => 'Ampara District',
            ],
            [
                'id' => 349,
                'name' => 'Trincomalee District',
            ],
            [
                'id' => 350,
                'name' => 'Kurunegala District',
            ],
            [
                'id' => 351,
                'name' => 'Puttalam District',
            ],
            [
                'id' => 352,
                'name' => 'Anuradhapura District',
            ],
            [
                'id' => 353,
                'name' => 'Polonnaruwa District',
            ],
            [
                'id' => 354,
                'name' => 'Ratnapura District',
            ],
            [
                'id' => 355,
                'name' => 'Kegalle District',
            ],
            [
                'id' => 356,
                'name' => 'Monaragala District',
            ],
            [
                'id' => 357,
                'name' => 'Badulla District',
            ],

        ];

        $this->db->table('aggrarian_division')->insertBatch($agg_data);

    }
}