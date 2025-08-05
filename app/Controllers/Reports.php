<?php

namespace App\Controllers;
use App\Models\QueryTemplateModel;

class Reports extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 
        track();

        $this->data['barrower_type'] = array(1=>"Main",2=>"Sub");
        $this->data['gender'] = array(1=>"Male",2=>"Female");
        $this->data['user_type'] = json_decode(get_config(5),TRUE);
        $this->data['project_type'] = json_decode(get_config(18),TRUE);
    }

    public function underconstruction()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/underconstruction/";
        $this->data['csrf'] = 1;
        
        $entity_model = new QueryTemplateModel();        

        return view('dashboard/404',$this->data);
    }

    public function loan_profile()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/loan_profile/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 77;
        $this->data['query'] = 51;
        $this->data['filters'] = json_decode(get_config(77),TRUE);
        
        $sql = $this->query_filter(51);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/loan_profile',$this->data);
    }

    public function benificiary()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/benificiary/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 75;
        $this->data['query'] = 52;
        $this->data['filters'] = json_decode(get_config(75),TRUE);
        
        $sql = $this->query_filter(52);

        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }
        cano_set_alert("warning", "Please use SHIFT + Mouse wheel for Horizontal Scrolling");

        return view('reports/benificiary',$this->data);
    }

    public function training_programmes()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/training_programmes/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 78;
        $this->data['query'] = 9;
        $this->data['filters'] = json_decode(get_config(78),TRUE);
        
        $sql = $this->query_filter(9);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/training_programmes',$this->data);
    }

    public function loan_disbursement()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/loan_disbursement/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 79;
        $this->data['query'] = 10;
        $this->data['filters'] = json_decode(get_config(79),TRUE);
        
        $sql = $this->query_filter(10);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/loan_disbursement',$this->data);
    }

    public function sapp_progress()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/sapp_progress/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 80;
        $this->data['query'] = 11;
        $this->data['filters'] = json_decode(get_config(80),TRUE);
        
        $sql = $this->query_filter(11); 
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/sapp_progress',$this->data);
    }

    public function promotor()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/promotor/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 81;
        $this->data['query'] = 12;
        $this->data['filters'] = json_decode(get_config(81),TRUE);
        
        $sql = $this->query_filter(12);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }
        cano_set_alert("warning", "Please use SHIFT + Mouse wheel for Horizontal Scrolling");

        return view('reports/promotor',$this->data);
    }

    public function nsc_paper()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/nsc_paper/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 82;
        $this->data['query'] = 13;
        $this->data['filters'] = json_decode(get_config(82),TRUE);
        
        $sql = $this->query_filter(13);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/nsc_paper',$this->data);
    }

    public function eoi()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/eoi/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 83;
        $this->data['query'] = 14;
        $this->data['filters'] = json_decode(get_config(83),TRUE);
        
        $sql = $this->query_filter(14);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/eoi',$this->data);
    }

    public function procurement()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/procurement/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 84;
        $this->data['query'] = 15;
        $this->data['filters'] = json_decode(get_config(84),TRUE);
        
        $sql = $this->query_filter(15);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/procurement',$this->data);
    }

    public function off_farm_development()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/off_farm_development/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 85;
        $this->data['query'] = 16;
        $this->data['filters'] = json_decode(get_config(85),TRUE);
        
        $sql = $this->query_filter(16);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }
        cano_set_alert("warning", "Please use SHIFT + Mouse wheel for Horizontal Scrolling");

        return view('reports/off_farm_development',$this->data);
    }

    public function report_youth_farmer()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/report_youth_farmer/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 86;
        $this->data['query'] = 36;
        $this->data['filters'] = json_decode(get_config(86),TRUE);
        
        $sql = $this->query_filter(36);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/report_youth_farmer',$this->data);
    }

    public function report_non_eligible_farmers()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/report_non_eligible_farmers/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 87;
        $this->data['query'] = 37;
        $this->data['filters'] = json_decode(get_config(87),TRUE);
        
        $sql = $this->query_filter(37);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/report_non_eligible_farmers',$this->data);
    }

    public function list_of_4P_projects()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/list_of_4P_projects/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 88;
        $this->data['query'] = 38;
        $this->data['filters'] = json_decode(get_config(88),TRUE);
        
        $sql = $this->query_filter(38);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/list_of_4P_projects',$this->data);
    }

    public function contracts()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/contracts/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 89;
        $this->data['query'] = 40;
        $this->data['filters'] = json_decode(get_config(89),TRUE);
        
        $sql = $this->query_filter(40);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/contracts',$this->data);
    }

    public function inventory()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/inventory/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 90;
        $this->data['query'] = 41;
        $this->data['filters'] = json_decode(get_config(90),TRUE);
        
        $sql = $this->query_filter(41);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/inventory',$this->data);
    }

    public function is()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/is/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 91;
        $this->data['query'] = 42;
        $this->data['filters'] = json_decode(get_config(91),TRUE);
        
        $sql = $this->query_filter(42);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/is',$this->data);
    }

    public function leave_mgt()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/leave_mgt/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 93;
        $this->data['query'] = 47;
        $this->data['filters'] = json_decode(get_config(93),TRUE);
        
        $sql = $this->query_filter(47);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/leave_mgt',$this->data);
    }

    public function matching_grant()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/matching_grant/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 94;
        $this->data['query'] = 48;
        $this->data['filters'] = json_decode(get_config(94),TRUE);
        
        $sql = $this->query_filter(48);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/matching_grant',$this->data);
    }

    public function staff_contract()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/staff_contract/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 95;
        $this->data['query'] = 49;
        $this->data['filters'] = json_decode(get_config(95),TRUE);
        
        $sql = $this->query_filter(49);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/staff_contract',$this->data);
    }

    public function grant()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/grant/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 96;
        $this->data['query'] = 56;
        $this->data['filters'] = json_decode(get_config(96),TRUE);
        
        $sql = $this->special_query_filter(56);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }
        cano_set_alert("warning", "Please use SHIFT + Mouse wheel for Horizontal Scrolling");

        return view('reports/grant',$this->data);
    }

    public function access_stat()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/grant/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 96;
        $this->data['query'] = 69;
        $this->data['filters'] = json_decode(get_config(96),TRUE);
        
        $sql = $this->query_filter(69);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/access_stat',$this->data);
    }

    public function report_claim_track_sheet()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/benificiary/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = 75;
        $this->data['query'] = 71;
        $this->data['filters'] = json_decode(get_config(75),TRUE);
        
        $sql = $this->query_filter(71);

        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/report_claim_track_sheet',$this->data);
    }

    public function dynamic($filter,$query)
	{
        auth_rd();
        $this->data['active_module'] = "/reports/dynamic/".$filter."/".$query."/";
        $this->data['csrf'] = 1;
        $this->data['filter'] = $filter;
        $this->data['query'] = $query;
        $this->data['filters'] = json_decode(get_config($filter),TRUE);
        $this->data['heading'] = $this->selectHeading($filter);

        // Pagination setup
        $pager = service('pager');
        $perPage = 2000;  // Records per page
        $page = (int) ($this->request->getGet('page') ?? 1);  // Current page, default to 1
        $offset = ($page - 1) * $perPage;  // Offset for the query

        $sql = $this->query_filter($query, $perPage, $offset);
        
        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query1 = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query1->getResultArray();

            // Get the total number of records (without LIMIT and OFFSET) for pagination
            $sql_total = $this->query_filter($query, null, null);  // Same query without LIMIT/OFFSET

            $query_total = $this->data["db"]->query($sql_total);

            // Check if the total query executed successfully
            if ($query_total->resultID !== false) {
                $total = $query_total->getNumRows();  // Get the total number of matching records
            } else {
                // Handle query failure, fallback total records to 0
                $total = 0;
            }
            // Calculate start and end values for the current page
            $start = $offset + 1;
            $end = min($start + $perPage - 1, $total);

            // Generate pagination links
            $pager_links = $pager->makeLinks($page, $perPage, $total);
            $this->data['pager_links'] = $pager_links;
            $this->data['start'] = $start;
            $this->data['end'] = $end;
            $this->data['total'] = $total;
            $this->data['pager_links'] = $pager_links;
        }

        return view('reports/dynamic',$this->data);
    }

    private function selectHeading($filterNumber){
        switch ($filterNumber) {
            case '102':
                return "Short Farmer Profile";
                break;
            
            case '104':
                return "IS Activities";
                break;
            
            case '106':
                return "Project wise Grant Disbursement";
                break;

            case '112':
                return "Item wise Grant Disbursement";
                break;
            
            case '108':
                return "Claim Track";
                break;
            
            // case '101':
            //     return "Loan Type";
            //     break;
            
            case '101':
                return "Project wise Loan Disbursement";
                break;
            
            case '115':
                return "Loan Category Wise Disbursement";
                break;
            
            case '118':
                cano_set_alert("warning", "Please use SHIFT + Mouse wheel for Horizontal Scrolling");
                return "Startup Fund";
                break;
            
            case '113':
                return "Training Type";
                break;
            
            case '114':
                return "Project wise Training";
                break;
            
            case '104':
                return "IS Activities";
                break;
            
            case '103':
                return "Project Officers";
                break;
            
            case '111':
                return "Promoter Submissions";
                break;
            
            case '109':
                return "Doc Archive";
                break;
            
            case '83':
                return "EOI";
                break;
            
            case '89':
                cano_set_alert("warning", "Please use SHIFT + Mouse wheel for Horizontal Scrolling");
                return "Contracts";
                break;
            
            case '84':
                cano_set_alert("warning", "Please use SHIFT + Mouse wheel for Horizontal Scrolling");
                return "Procurement";
                break;
            
            case '95':
                return "Staff Contract";
                break;
            
            case '105':
                cano_set_alert("warning", "Please use SHIFT + Mouse wheel for Horizontal Scrolling");
                return "Staff Profile";
                break;
            
            case '110':
                return "SAPP Formats";
                break;
            
            case '116':
                return "Access Stats";
                break;

            case '79':
                cano_set_alert("warning", "Please use SHIFT + Mouse wheel for Horizontal Scrolling");
                return "Loan Disbursement";
                break;

            case '75':
                cano_set_alert("warning", "Please use SHIFT + Mouse wheel for Horizontal Scrolling");
                return "Beneficiary Details";
                break;
            
            default:
                return "Report";
                break;
        }
    }

    public function poc()
	{
        auth_rd();
        $this->data['active_module'] = "/reports/benificiary/";
        $this->data['csrf'] = 1;
        $this->data['filters'] = json_decode(get_config(75),TRUE);
        
        $sql = $this->query_filter(52);

        if(isset($_GET) && is_array($_GET) && count($_GET)>1)
        {
            $query = $this->data["db"]->query($sql);
            $this->data['list_all'] = $query->getResultArray();
        }

        return view('reports/poc',$this->data);
    }

    private function query_filter($id, $limit=null, $offset=null)
	{
        $sql = get_query($id, $limit, $offset);

        $where = " ";
        if(isset($_GET) && is_array($_GET))
        {
            foreach($_GET as $gkey=>$gval)
            {
                if(strlen($gval)>0)
                { 
                    if (strpos($gkey, "sdate-") !== false) {
                        $where .= str_replace("sdate-","",$gkey) . " >= '" . $gval . " 00:00:00' AND ";
                    }
                    elseif (strpos($gkey, "edate-") !== false) {
                        $where .= str_replace("edate-","",$gkey) . " <= '" . $gval . " 23:59:59' AND ";
                    }                    
                    elseif(is_numeric($gval))
                    {
                        $where .= str_replace("-",".",$gkey) . " = " . $gval . " AND ";
                    }
                    else
                    {
                        $where .= str_replace("-",".",$gkey) . " LIKE '%" . $gval . "%' AND ";
                    }
                }
            }
        }
        echo "<!--" . str_replace("<CANO_FILTER>",$where, $sql) . "-->";
        return str_replace("<CANO_FILTER>",$where, $sql);
    }

    private function special_query_filter($id, $limit=null, $offset=null)
	{
        $sql = special_get_query($id, $limit, $offset);

        $where = " ";
        if(isset($_GET) && is_array($_GET))
        {
            foreach($_GET as $gkey=>$gval)
            {
                if(strlen($gval)>0)
                { 
                    if (strpos($gkey, "sdate-") !== false) {
                        $where .= str_replace("sdate-","",$gkey) . " >= '" . $gval . " 00:00:00' AND ";
                    }
                    elseif (strpos($gkey, "edate-") !== false) {
                        $where .= str_replace("edate-","",$gkey) . " <= '" . $gval . " 23:59:59' AND ";
                    }                    
                    elseif(is_numeric($gval))
                    {
                        $where .= str_replace("-",".",$gkey) . " = " . $gval . " AND ";
                    }
                    else
                    {
                        $where .= str_replace("-",".",$gkey) . " LIKE '%" . $gval . "%' AND ";
                    }
                }
            }
        }
        echo "<!--" . str_replace("<CANO_FILTER>",$where, $sql) . "-->";
        return str_replace("<CANO_FILTER>",$where, $sql);
    }
}