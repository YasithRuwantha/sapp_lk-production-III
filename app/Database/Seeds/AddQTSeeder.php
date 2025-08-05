<?php

/**
 * Insert all site config values
 * Execute following command from project root and make sure to login as apache user or sudo
 * php spark db:seed AddQTSeeder
 */


namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddQTSeeder extends Seeder
{
    public function run()
    {
        $dashboardFarmerLocation = [
            'id'            => 106,
            'query_reference'     => 'Dashboard farmer location',
            'query_string'         => "SELECT 
            p.id, gl.lat, gl.lng, u.fname, u.lname, p.project_name,  farmer_project.project_status 
            FROM geographic_locations AS gl
            LEFT JOIN user AS u on gl.entity_id = u.id
            LEFT JOIN farmer_project ON farmer_project.farmer_id = u.id
            LEFT JOIN project AS p ON p.id = farmer_project.project_id
            WHERE u.deleted_at IS NULL AND 
            gl.entity_table = 'farmer' AND 
            farmer_project.deleted_at IS NULL AND 
            p.deleted_at IS NULL AND 
            gl.deleted_at IS NULL;"
        ];

        $this->db->table('query_template')->where('id', '106')->insert($dashboardFarmerLocation);

        $dashboardOffFarmLocation = [
            'id'            => 107,
            'query_reference'     => 'Dashboard off farm location',
            'query_string'         => "SELECT 
            p.project_id AS id, 
            p.id AS off_farm_id, 
            p.off_farm_dev_name,
            SUM(off_farm_activity.estimated_cost) AS estimated_cost,
            geo.lat, 
            geo.lng 
            FROM sapp_core.off_farm_development AS p
             LEFT join
             (SELECT entity_id, lat,lng FROM sapp_core.geographic_locations where entity_table = 'off_farm_development' and deleted_at IS null) as geo ON geo.entity_id = p.id
             LEFT JOIN off_farm_activity ON off_farm_activity.off_farm_development_id = p.id
             WHERE geo.lat IS NOT NULL AND 
             geo.lng IS NOT NULL AND 
             p.deleted_at IS NULL AND 
             off_farm_activity.deleted_at IS NULL
             GROUP by(off_farm_id);"
        ];

        $this->db->table('query_template')->where('id', '107')->insert($dashboardOffFarmLocation);

        $dashboardMatchingGrantLocation = [
            'id'            => 108,
            'query_reference'     => 'Dashboard matching grant location',
            'query_string'         => "SELECT 
            p.project_id, 
            p.id AS matching_grant_id, 
            p.matching_grant_dev_name, 
            SUM(matching_grant_activity.expense) as estimated_cost,
            geo.lat, 
            geo.lng 
            FROM sapp_core.matching_grant_development AS p 
            LEFT join
             (SELECT entity_id, lat,lng FROM sapp_core.geographic_locations where entity_table = 'matching_grant_development' and deleted_at IS null) as geo ON geo.entity_id = p.id
             LEFT JOIN matching_grant_activity on matching_grant_activity.matching_grant_development_id = p.id
            WHERE geo.lat IS NOT NULL AND 
            geo.lng IS NOT NULL AND 
            p.deleted_at IS NULL AND
            matching_grant_activity.deleted_at IS NULL
            GROUP BY(matching_grant_id);"
        ];

        $this->db->table('query_template')->where('id', '108')->insert($dashboardMatchingGrantLocation);

        $dashboardRuralFinanceGrant = [
            'id'            => 109,
            'query_reference'     => 'Dashboard Rural finance progress grant',
            'query_string'         => "SELECT 
            FORMAT(COALESCE(SUM(data.price * data.qty)/1000000, 0), 4, 0) AS y1,
            date_range.month AS x
         FROM (
             SELECT 
                 DATE_FORMAT(NOW() - INTERVAL seq MONTH, '%Y-%m') AS month
             FROM (
                 SELECT 
                     (0) AS seq 
                    UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 
                    UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 
                    UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 
                    UNION ALL SELECT 10 UNION ALL SELECT 11
             ) AS sequence
         ) AS date_range
         LEFT JOIN (
             SELECT 
                 DATE_FORMAT(grant_disbursement.date_of_grant, '%Y-%m') AS month,
                 grant_item_farmer.price,
               grant_item_farmer.qty
             FROM 
                 grant_disbursement
             LEFT JOIN 
                 grant_item_farmer ON grant_item_farmer.grant_disbursement_id = grant_disbursement.id
             WHERE 
                 grant_disbursement.deleted_at IS NULL 
                 AND grant_item_farmer.deleted_at IS NULL 
                 AND grant_disbursement.disbursement_status = 3 
         ) AS data ON date_range.month = data.month
         GROUP BY 
             date_range.month
         ORDER BY 
             STR_TO_DATE(date_range.month, '%Y-%m');"
        ];

        $this->db->table('query_template')->where('id', '109')->insert($dashboardRuralFinanceGrant);
    }
}
