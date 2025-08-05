<?php

namespace App\Controllers;
use App\Models\CdnregistryModel;

class Batchjob extends BaseController
{

	public function index()
	{
		return view('welcome_message');
	}

    public function s3_list($limit=300)
	{
        $db = \Config\Database::connect();
        $query = $db->query("SELECT bucket,s3_path,uploaded_date,reference,id FROM ven_cdn_registery WHERE status = 1 ORDER BY id DESC LIMIT " . $limit);
        $result_set = $query->getResultArray();
        if(isset($result_set) && is_array($result_set))
        {
            foreach($result_set as $val)
            {
                echo '<a href="https://www.canopuz.com/cms/public/api/img/' . $val['bucket'] . '/' . $val['s3_path'] . '" target="_blank">' . date("Y-m-d H:i:s", $val['uploaded_date']) . ' : ' . json_encode($val) . '</a><br>';
            }
        }
    }

	public function s3_folder_sync()
	{
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM ven_s3sync WHERE `status` = 1");
        $result_set = $query->getResultArray();
        if(isset($result_set) && is_array($result_set))
        {
            foreach($result_set as $val)
            {
                $this->s3_upload_all($val);
            }
        }
    }

    private function s3_upload_all($obj)
    {
        $cdn_registry_model = new CdnregistryModel(); 

        if ($handle = opendir($obj['local_path'])) {
            while (false !== ($entry = readdir($handle))) {        
                if (is_file($obj['local_path'] . $entry)) {
                    s3_upload($obj['bucket'],$obj['local_path'] . $entry,$obj['s3_path'] . $entry,$obj['aws_access_key'],$obj['aws_secret']);
                    $details = [
                        'bucket' => $obj['bucket'],
                        's3_path' => $obj['s3_path'] . $entry,
                        'reference' => $obj['label'],
                        'uploaded_date' => time(),
                        'status' => 1,
                    ];
                    $cdn_registry_model->insert($details);
                    rename($obj['local_path'] . $entry, $obj['local_path'] . "del/" . $entry);
                }
            }
            closedir($handle);
        }
    }

    public function fb_data_del()
    {
        return "in progress";
    }
}