<?php

namespace App\Controllers;

class Api extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        $this->data["db"] = \Config\Database::connect(); 
    }

	public function index()
	{
		return view('welcome_message');
	}

	public function img($pa)
	{
        /**
         * The way of using the api
         * https://www.someexample.com/api/img/{backet name}/{repeat the folder structure with slashes}/{file name}
         * https://www.canopuz.com/cms/public/api/img/cano-mis/pli-sanasacampus/00477da37e2493ec4b3011fc3fe32c86.jpg
         */
        $path_arr = func_get_args();

        $path = s3_tmp_url($path_arr[0],str_replace($path_arr[0]."/","",implode('/', func_get_args())));

        $ext = pathinfo($path, PATHINFO_EXTENSION);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $path); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);

        $im = imagecreatefromstring($data);

        if(strtolower($ext)=="jpg" || strtolower($ext)=="jpeg")
        {
            $im = imagecreatefromjpeg($data);
        }
        elseif(strtolower($ext)=="png")
        {
            $im = imagecreatefrompng($data);
            imagealphablending($im, false);
            imagesavealpha($im, true);
        }        
        
        $source_imagex = imagesx($im);
        $source_imagey = imagesy($im);
        $dest_imagex = 600;
        $dest_imagey = round(($dest_imagex/$source_imagex)*$source_imagey);
        $dest_image = imagecreatetruecolor($dest_imagex, $dest_imagey);
        imagecopyresampled($dest_image, $im, 0, 0, 0, 0, $dest_imagex, 
        $dest_imagey, $source_imagex, $source_imagey);
        
        $this->response->setHeader('Pragma', 'public')
            ->appendHeader('Cache-Control', 'max-age=86400')
            ->appendHeader('Expires', gmdate('D, d M Y H:i:s \G\M\T', time() + 86400))
            ->appendHeader('Content-Type', 'image/jpg');

        imagejpeg($dest_image,NULL,90);
        imagedestroy($dest_image);
        imagedestroy($im);
    }

    public function farmer()
    {
        if(!isset($_SESSION['user'])){
            return redirect()->to('/');
        }

        $search = $this->request->getGet('search');  // Get the search term
        $page = $this->request->getGet('page');  // Get the pagination page
        $perPage = 5000;  // Number of results to return per request

        // Calculate the offset for pagination
        $offset = ($page - 1) * $perPage;

        // Query your database for the matching results
        if (!empty($search)) {
            $builder = $this->data['db']
                ->table('user')
                ->where('user_type', '2')
                ->where('deleted_at', null)
                ->groupStart() // Start grouping OR conditions
                    ->like('fname', $search)
                    ->orLike('lname', $search)
                    ->orLike('pin', $search)
                ->groupEnd(); // End grouping
        } else {
            $builder = $this->data['db']
                ->table('user')
                ->where('user_type', '2')
                ->where('deleted_at', null);    
        }

        // Get the paginated results
        $results = $builder->limit($perPage, $offset)->get()->getResultArray();

        // Calculate whether there are more results
        $totalRecords = $builder->countAllResults(false);  // Total records (without limit)
        $more = ($offset + $perPage) < $totalRecords;

        // Prepare data in Select2 format
        $data = [];
        foreach ($results as $result) {
            $data[] = [
                'id' => $result['id'],  // The value that will be sent to the server
                'fname' => $result['fname'],
                'lname' => $result['lname'],
                'pin' => $result['pin'],  // The label displayed in the dropdown
                'user_type' => $result['user_type']
            ];
        }

        return $this->response->setJSON([
            'results' => $data,
            'pagination' => ['more' => $more],  // Indicates if more pages are available
            'generateQuery' => $builder->getCompiledSelect()
        ]);

    }

    public function get_dsd_by_district()
    {
        $district_id = $this->request->getPost('district_id');
        
        if(!$district_id){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'District ID is required'
            ]);
        }

        $query = $this->data["db"]->query("SELECT id, dsd FROM dsd WHERE district_id = ? ORDER BY dsd", [$district_id]);
        $dsds = $query->getResultArray();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $dsds
        ]);
    }
    
}