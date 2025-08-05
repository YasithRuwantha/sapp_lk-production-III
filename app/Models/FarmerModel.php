<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class FarmerModel extends Model
{
    protected $table = 'farmer';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = ['id', 'user_id', 'barrower_type', 'head_hh', 'address_no', 'address_street', 'address_city', 'whatsapp_no', 'citizenship_by', 'heighest_education_qualification', 'age_while_register', 'availability_drinking_water', 'source_drinking_water', 'availability_water_crops', 'source_water_crops', 'cond_house_floor', 'consumer_durables', 'avilability_vehicles', 'availability_water_crops', 'sanitation', 'agri_equipments', 'tools_farmland', 'main_source_income', 'main_source_income_nature', 'avg_main_agriculture_income', 'avg_main_agricultutre_income_nature', 'avg_harvest_income', 'other_income', 'other_income_nature', 'other_income_discription', 'availability_electricity', 'electricity_from','gnd', 'vcm_recomendation', 'vcm_recomendation_remark', 'rpc_recomendation', 'rpc_recomendation_remark', 'liason_recomendation', 'liason_recomendation_remark', 'vcm_approval_date_time', 'rpc_approval_date_time', 'liason_approval_date_time','gnd_id', 'nature_agri_expense', 'expense_agri', 'nature_expense_other', 'expense_other', 'undergo_training', 'samurdhi_pds', 'balance_diet', 'hunger_period', 'financial_decision', 'before_barrow', 'source_of_credit', 'informal_barrow', 'formal_barrow', 'no_balance_diet', 'repaid_status_informal', 'repaid_status_formal', 'repaid_formal', 'repaid_informal', 'registered_in', 'register_org', 'aggrarian_division_id','civil_status','no_household_members','male_under_5','female_under_5','male_5_to_14','female_5_to_14','male_15_to_29','female_15_to_29','male_30_to_49','female_30_to_49','male_50_to_64','female_50_to_64','male_over_65','female_over_65','status','approved_date','user','designation','reason'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}