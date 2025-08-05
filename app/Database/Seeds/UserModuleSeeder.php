<?php
/**
 * Insert all site config values
 * Execute following command from project root and make sure to login as apache user or sudo
 * php spark db:seed ConfigSeeder
 */


namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserModuleSeeder extends Seeder
{
    public function run()
    {
        $data_module = [
            [
                'id'            => 1,
                'module_name'     => 'Dashboard',
            ],
            [
                'id'            => 2,
                'module_name'     => 'Users',
            ],
            [
                'id'            => 3,
                'module_name'     => 'Projects',
            ],
            [
                'id'            => 4,
                'module_name'     => 'Promoter',
            ],
            [
                'id'            => 5,
                'module_name'     => 'Training',
            ],
            [
                'id'            => 6,
                'module_name'     => 'Monthly progress report',
            ],
        ];

        $this->db->table('module')->insertBatch($data_module);

        $data_action = [
            [
                'id'              => 1,
                'module_id'       => 1,
                'action_name'     => 'Dashboard List',
            ],
            [
                'id'              => 2,
                'module_id'       => 1,
                'action_name'     => 'Dashboard View',
            ],
            [
                'id'              => 3,
                'module_id'       => 1,
                'action_name'     => 'Dashboard Add',
            ],
            [
                'id'              => 4,
                'module_id'       => 1,
                'action_name'     => 'Dashboard Edit',
            ],
            [
                'id'              => 5,
                'module_id'       => 1,
                'action_name'     => 'Dashboard Delete',
            ],
            [
                'id'              => 6,
                'module_id'       => 1,
                'action_name'     => 'Dashboard Grant',
            ],
            [
                'id'              => 7,
                'module_id'       => 2,
                'action_name'     => 'User List',
            ],
            [
                'id'              => 8,
                'module_id'       => 2,
                'action_name'     => 'User View',
            ],
            [
                'id'              => 9,
                'module_id'       => 2,
                'action_name'     => 'User Add',
            ],
            [
                'id'              => 10,
                'module_id'       => 2,
                'action_name'     => 'User Edit',
            ],
            [
                'id'              => 11,
                'module_id'       => 2,
                'action_name'     => 'User Delete',
            ],
            [
                'id'              => 12,
                'module_id'       => 2,
                'action_name'     => 'User Grant',
            ],
            [
                'id'              => 13,
                'module_id'       => 3,
                'action_name'     => 'Projects List',
            ],
            [
                'id'              => 14,
                'module_id'       => 3,
                'action_name'     => 'Projects View',
            ],
            [
                'id'              => 15,
                'module_id'       => 3,
                'action_name'     => 'Projects Add',
            ],
            [
                'id'              => 16,
                'module_id'       => 3,
                'action_name'     => 'Projects Edit',
            ],
            [
                'id'              => 17,
                'module_id'       => 3,
                'action_name'     => 'Projects Delete',
            ],
            [
                'id'              => 18,
                'module_id'       => 3,
                'action_name'     => 'Projects Grant',
            ],
            [
                'id'              => 19,
                'module_id'       => 4,
                'action_name'     => 'Promoter List',
            ],
            [
                'id'              => 20,
                'module_id'       => 4,
                'action_name'     => 'Promoter View',
            ],
            [
                'id'              => 21,
                'module_id'       => 4,
                'action_name'     => 'Promoter Add',
            ],
            [
                'id'              => 22,
                'module_id'       => 4,
                'action_name'     => 'Promoter Edit',
            ],
            [
                'id'              => 23,
                'module_id'       => 4,
                'action_name'     => 'Promoter Delete',
            ],
            [
                'id'              => 24,
                'module_id'       => 4,
                'action_name'     => 'Promoter Grant',
            ],
            [
                'id'              => 25,
                'module_id'       => 5,
                'action_name'     => 'Training List',
            ],
            [
                'id'              => 26,
                'module_id'       => 5,
                'action_name'     => 'Training View',
            ],
            [
                'id'              => 27,
                'module_id'       => 5,
                'action_name'     => 'Training Add',
            ],
            [
                'id'              => 28,
                'module_id'       => 5,
                'action_name'     => 'Training Edit',
            ],
            [
                'id'              => 29,
                'module_id'       => 5,
                'action_name'     => 'Training Delete',
            ],
            [
                'id'              => 30,
                'module_id'       => 5,
                'action_name'     => 'Training Grant',
            ],
            [
                'id'              => 31,
                'module_id'       => 6,
                'action_name'     => 'Monthly progress report List',
            ],
            [
                'id'              => 32,
                'module_id'       => 6,
                'action_name'     => 'Monthly progress report View',
            ],
            [
                'id'              => 33,
                'module_id'       => 6,
                'action_name'     => 'Monthly progress report Add',
            ],
            [
                'id'              => 34,
                'module_id'       => 6,
                'action_name'     => 'Monthly progress report Edit',
            ],
            [
                'id'              => 35,
                'module_id'       => 6,
                'action_name'     => 'Monthly progress report Delete',
            ],
            [
                'id'              => 36,
                'module_id'       => 6,
                'action_name'     => 'Monthly progress report Grant',
            ],
        ];

        $this->db->table('module_action')->insertBatch($data_action);

        $data_group = [
            [
                'id'            => 1,
                'group_name'     => 'Default',
            ],
            [
                'id'            => 2,
                'group_name'     => 'Super Admin',
            ],
        ];

        $this->db->table('user_group')->insertBatch($data_group);

        $data_group_link = [
            [
                'group_id'      => 1,
                'action_id'     => 2,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 1,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 2,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 3,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 4,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 5,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 6,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 7,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 8,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 9,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 10,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 11,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 12,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 13,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 14,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 15,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 16,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 17,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 18,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 19,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 20,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 21,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 22,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 23,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 24,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 25,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 26,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 27,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 28,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 29,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 30,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 31,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 32,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 33,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 34,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 35,
            ],
            [
                'group_id'      => 2,
                'action_id'     => 36,
            ],
        ];

        $this->db->table('link_action_group')->insertBatch($data_group_link);
    }
}