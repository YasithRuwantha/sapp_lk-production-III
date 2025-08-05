<?php
/**
 * Insert all site config values
 * Execute following command from project root and make sure to login as apache user or sudo
 * php spark db:seed ConfigSeeder
 */


namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ConfigSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'            => 1,
                'reference'     => 'wp_url',
                'value'         => 'https://www.canopuz.com/'
            ],
            [
                'id'            => 2,
                'reference'     => 'wp_path',
                'value'         => '/mnt/www/general/www.canopuz.com/'
            ],
            [
                'id'            => 3,
                'reference'     => 'entity_lock_duration_sec',
                'value'         => '300'
            ],
            [
                'id'            => 4,
                'reference'     => 'staff_meta_recruitment_type',
                'value'         => '{"1": "Contract","2": "Permanent"}'
            ],
            [
                'id'            => 5,
                'reference'     => 'heighest_education_qualification',
                'value'         => '{"1": "Doctorate","2": "Masters","3": "Postgraduate Diploma","4": "Bachelors","5": "Diploma","6": "Other related qualification"}'
            ],
            [
                'id'            => 6,
                'reference'     => 'user_type',
                'value'         => '{"1": "Staff","2": "Farmer","3": "Producer","4": "Promoter"}'
            ],
            [
                'id'            => 7,
                'reference'     => 'income_nature',
                'value'         => '{"1": "Daily","2": "Monthly","3": "Seasonally"}'
            ],
            [
                'id'            => 8,
                'reference'     => 'electricity_from',
                'value'         => '{"1": "National Grid","2": "Village","3": "HH generation"}'
            ],
            [
                'id'            => 9,
                'reference'     => 'tools_farmland',
                'value'         => '{"1": "Hand tools","2": "Own Animal","3": "Hired Animal","4": "Own Tractor","5": "Hired Tractor"}'
            ],
            [
                'id'            => 10,
                'reference'     => 'source_drinking_water',
                'value'         => '{"1": "Well","2": "Pipe","3": "Public tap","4": "Tube wells","5": "lake / pond","6": "River / Stream","7": "Tap water (Main)","8": "Tap water (other)"}'
            ],
            [
                'id'            => 11,
                'reference'     => 'source_water_crops',
                'value'         => '{"1": "HH Well","2": "Agro Well","3": "River or tank","4": "Rain water"}'
            ],
            [
                'id'            => 12,
                'reference'     => 'cond_house_floor',
                'value'         => '{"1": "Earth","2": "Sand","3": "Dung","4": "Cement","5": "Ceramic tile","6": "Carpet"}'
            ],
            [
                'id'            => 13,
                'reference'     => 'consumer_durables',
                'value'         => '{"1": "Radio","2": "Television","3": "Refrigerator","4": "Others (Fan, Mobile phone, Landline ,etc.)"}'
            ],
            [
                'id'            => 14,
                'reference'     => 'avilability_vehicles',
                'value'         => '{"1": "Push bicycle","2": "Motorcycle or scooter","3": "Three-wheel","4": "Car or van","5": "truck"}'
            ],
            [
                'id'            => 15,
                'reference'     => 'sanitation',
                'value'         => '{"1": "No toilet facility","2": "Traditional latrine","3": "Flush toilet","4": "Other","5": "Exclusive","6": "Not using a toilet"}'
            ],
            [
                'id'            => 16,
                'reference'     => 'agri_equipments',
                'value'         => '{"1": "2- Wheel Tractors","2": "Agricultural Tractors","3": "Combines Harvesters","4": "Sprayer","5": "Bush cutters","6": "Tillers","7": "Grass choppers","8": "Milking Machine","9": "Chilling Tanks","10": "Water pump","11": "Inter – cultivator"}'
            ],
            [
                'id'            => 17,
                'reference'     => 'main_source_income',
                'value'         => '{"1": "Agriculture and sales of corps","2": "Fishing and sale of fish","3": "Livestock and sales of animals","4": "Aquaculture and Omamental","5": "Fish Petty trading Unskilled labor","6": "Salaries","7": "Wages (employees)","8": "Apiculture","9": "Remittances","10": "Seaweed cultivation and selling Floriculture","11": "Other"}'
            ],
            [
                'id'            => 18,
                'reference'     => 'project_type',
                'value'         => '{"1": "New","2": "Existing"}'
            ],
            [
                'id'            => 19,
                'reference'     => 'project_status',
                'value'         => '{"1": "In progress","2": "In active","3": "Completed"}'
            ],
            [
                'id'            => 20,
                'reference'     => 'promoter_business_type',
                'value'         => '{"1": "Diary","2": "Crop Production","3": "Fruits & Vegetables"}'
            ],
            [
                'id'            => 21,
                'reference'     => 'type_of_training',
                'value'         => '{"1": "Technical","2": "Financial","3": "Book keeping","4": "Gender","5": "Nutrition","6": "Environment","7": "Business Proposal making","8": "Exposure Visit"}'
            ]
        ];

        $this->db->table('config')->insertBatch($data);
    }
}