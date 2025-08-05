<?php

/**
 * This file is part of the CodeIgniter 4 framework.
 *
 * (c) Canopus Pvt Ltd. <zugunan@gmail.com>
 *
 * For any updates or clarify contact canopus dev team
 */

/**
 * CodeIgniter Canopus Helpers
 */

if (! function_exists('is_logged'))
{
	/**
	 * Check if the user logged in or not
	 *
	 * @param string null
	 *
	 * @return boolion
	 */
	function is_logged()
	{
        return isset($_SESSION['user']['id']);
	}
}

if (! function_exists('auth_rd'))
{
	/**
	 * Check if the user autherized if not redirect for login
	 *
	 * @param string null
	 *
	 * @return boolion
	 */
	function auth_rd($cap="")
	{
        $login_url = base_url();

		$db = \Config\Database::connect();
        
		if(isset($_SESSION['user']['id']) && $cap=="")
		{
        	return true;
		}
		else if(isset($_SESSION['user']['actions']) && in_array($cap,$_SESSION['user']['actions']))
		{
        	return true;
		}
		else if(isset($_SESSION['user']['groups']) && in_array(2,$_SESSION['user']['groups']))
		{
			return true;
		}
		else
		{
			cano_set_alert("danger","You don't have privilege to access this page.");
			$_SESSION['redirect'] = base_url();
            header("Location:" . $login_url); 
            die;
		}
	}
}

if (! function_exists('is_auth'))
{
	/**
	 * Check if the user autherized if not redirect for login
	 *
	 * @param string null
	 *
	 * @return boolion
	 */
	function is_auth($cap)
	{
		$db = \Config\Database::connect();
        
		if(isset($_SESSION['user']['actions']) && in_array($cap,$_SESSION['user']['actions']))
		{
        	return true;
		}
		else if(isset($_SESSION['user']['groups']) && in_array(2,$_SESSION['user']['groups']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

if (! function_exists('is_group'))
{
	/**
	 * Check if the user autherized if not redirect for login
	 *
	 * @param string null
	 *
	 * @return boolion
	 */
	function is_group($cap)
	{
		$db = \Config\Database::connect();
        
		if(isset($_SESSION['user']['groups']) && in_array($cap,$_SESSION['user']['groups']))
		{
        	return true;
		}
		else if(isset($_SESSION['user']['groups']) && in_array(2,$_SESSION['user']['groups']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

if (! function_exists('farmer_approval'))
{
	/**
	 * Check if the user autherized if not redirect for login
	 *
	 * @param string null
	 *
	 * @return boolion
	 */
	function farmer_approval($cap,$record)
	{
		$db = \Config\Database::connect();

		
        
		if(isset($_SESSION['user']['groups']) && in_array($cap,$_SESSION['user']['groups']))
		{
        	switch($cap) {
				case 32:
					if(true || (isset($record['liason_recomendation']) && isset($record['rpc_recomendation']) && $record['liason_recomendation']<1 && $record['rpc_recomendation']<1))
					{
						return true;
					}
					else
					{
						return false;
					}
					break;
				case 33:
					if(true || (isset($record['vcm_recomendation']) && isset($record['liason_recomendation']) && $record['vcm_recomendation']>0 && $record['liason_recomendation']<1))
					{
						return true;
					}
					else
					{
						return false;
					}
					break;
				case 36:
					if(true || (isset($record['rpc_recomendation']) && isset($record['vcm_recomendation']) && $record['rpc_recomendation']>0 && $record['vcm_recomendation']>0))
					{
						return true;
					}
					else
					{
						return false;
					}
					break;
				default:
					return false;
			}
		}
		else
		{
			return false;
		}
	}
}

if (! function_exists('get_config'))
{
	/**
	 * Check if the user autherized if not redirect for login
	 *
	 * @param string null
	 *
	 * @return boolion
	 */
	function get_config($id=1)
	{
        $db = \Config\Database::connect();
        
        $query = $db->query('SELECT value FROM config WHERE id = ' . $id);
        $row   = $query->getRowArray();

        return $row['value'];
	}
}

if (! function_exists('get_query_template_attom'))
{
	/**
	 * Make sure the alias always says "value" and return single value
	 *
	 * @param string null
	 *
	 * @return boolion
	 */
	function get_query_template_attom($id=1)
	{
        $db = \Config\Database::connect();
        
        $query = $db->query('SELECT query_string FROM query_template WHERE id = ' . $id);
        $row   = $query->getRowArray();

		$where = " ";
        if(isset($_GET) && is_array($_GET))
        {
            foreach($_GET as $gkey=>$gval)
            {
                if(strlen($gval)>0)
                {
                    $where .= str_replace("-",".",$gkey) . " LIKE '%" . $gval . "%' AND ";
                }
            }
        }

        $sql = str_replace("<CANO_FILTER>",$where, $row['query_string']);

		$query1 = $db->query($sql);
        $row1   = $query1->getRowArray();

        return $row1['value'];
	}
}

if (! function_exists('get_query_template_array'))
{
	/**
	 * Return the result set of query
	 *
	 * @param string null
	 *
	 * @return boolion
	 */
	function get_query_template_array($id=1)
	{
        $db = \Config\Database::connect();
        
        $query = $db->query('SELECT query_string FROM query_template WHERE id = ' . $id);
        $row   = $query->getRowArray();

		$where = " ";
        if(isset($_GET) && is_array($_GET))
        {
            foreach($_GET as $gkey=>$gval)
            {
                if(strlen($gval)>0)
                {
					if(is_numeric($gval))
                    {
                        $where .= str_replace("-",".",$gkey) . " = " . $gval . " AND ";
                    }
                    else
                    {
                        $where .= str_replace("-",".",$gkey) . " LIKE '%" . $gval . "%' AND ";
						// $where .= str_replace("-",".",$gkey) . " LIKE '%" . $gval . "%' AND ";
                    }
                }
            }
        }

        $sql = str_replace("<CANO_FILTER>",$where, $row['query_string']);

		$query1 = $db->query($sql);
        $row1   = $query1->getResultArray();

        return $row1;
	}
}

if (! function_exists('get_query'))
{
	/**
	 * Return the result set of query
	 *
	 * @param string null
	 *
	 * @return boolion
	 */
	function get_query($id=1, $limit=null, $offset=null)
	{
        $db = \Config\Database::connect();
        
        $query = $db->query('SELECT query_string FROM query_template WHERE id = ' . $id);
        $row   = $query->getRowArray();

		$where = " ";
        if(isset($_GET) && is_array($_GET))
        {
            foreach($_GET as $gkey=>$gval)
            {
                if(strlen($gval)>0)
                {
                    if (strpos($gkey, "sdate-") !== false) {
                        $where .= str_replace("-",".",str_replace("sdate-","",$gkey)) . " >= '" . $gval . " 00:00:00' AND ";
                    }
                    elseif (strpos($gkey, "edate-") !== false) {
                        $where .= str_replace("-",".",str_replace("edate-","",$gkey)) . " <= '" . $gval . " 23:59:59' AND ";
                    }                    
                    elseif(is_numeric($gval))
                    {
						// check gkey is page
						if ($gkey != 'page') {
                        	$where .= str_replace("-",".",$gkey) . " = " . $gval . " AND ";
						}
                    }
                    else
                    {
                        $where .= str_replace("-",".",$gkey) . " LIKE '%" . $gval . "%' AND ";
                    }
                }
            }
        }

        $sql = str_replace("<CANO_FILTER>",$where, $row['query_string']);
		// Adding the LIMIT and OFFSET to the query
		// $sql = str_replace("<CANO_FILTER>", $where, $row['query_string']) . " LIMIT " . $limit . " OFFSET " . $offset;

		if (!is_null($limit) && is_numeric($limit)) {
			// if ';' existing in sql string, then remove the ;
			$sql = str_replace(';','',$sql);

			$sql .= " LIMIT " . $limit;
			if (!is_null($offset) && is_numeric($offset)) {
				$sql .= " OFFSET " . $offset;
			}
		}
		

		echo "<!--" . $sql . "-->";

        return $sql;
	}
}

if (! function_exists('special_get_query'))
{
	/**
	 * Return the result set of query
	 *
	 * @param string null
	 *
	 * @return boolion
	 */
	function special_get_query($id=1, $limit=null, $offset=null)
	{
        $db = \Config\Database::connect();
        
        $query = $db->query('SELECT query_string FROM query_template WHERE id = ' . $id);
        $row   = $query->getRowArray();

		$where = " ";
        if(isset($_GET) && is_array($_GET))
        {
            foreach($_GET as $gkey=>$gval)
            {
                if(strlen($gval)>0)
                {
                    if (strpos($gkey, "sdate-") !== false) {
                        $where .= str_replace("-",".",str_replace("sdate-","",$gkey)) . " >= '" . $gval . " 00:00:00' AND ";
                    }
                    elseif (strpos($gkey, "edate-") !== false) {
                        $where .= str_replace("-",".",str_replace("edate-","",$gkey)) . " <= '" . $gval . " 23:59:59' AND ";
                    }                    
                    elseif(is_numeric($gval))
                    {
						// check gkey is page
						if ($gkey != 'page') {
                        	$where .= str_replace("-",".",$gkey) . " = " . $gval . " AND ";
						}
                    }
                    else
                    {
						if ($gkey == 'disbursed_item-item_description'){
							$where .= str_replace("-",".",$gkey) . " = '" . $gval . "' AND ";
						} else {
							$where .= str_replace("-",".",$gkey) . " LIKE '%" . $gval . "%' AND ";
						}

                    }
                }
            }
        }

        $sql = str_replace("<CANO_FILTER>",$where, $row['query_string']);
		// Adding the LIMIT and OFFSET to the query
		// $sql = str_replace("<CANO_FILTER>", $where, $row['query_string']) . " LIMIT " . $limit . " OFFSET " . $offset;

		if (!is_null($limit) && is_numeric($limit)) {
			// if ';' existing in sql string, then remove the ;
			$sql = str_replace(';','',$sql);

			$sql .= " LIMIT " . $limit;
			if (!is_null($offset) && is_numeric($offset)) {
				$sql .= " OFFSET " . $offset;
			}
		}
		

		echo "<!--" . $sql . "-->";

        return $sql;
	}
}

if (! function_exists('sql_fetch'))
{
	/**
	 * Return the result set of query
	 *
	 * @param string null
	 *
	 * @return boolion
	 */
	function sql_fetch($sql)
	{
        $db = \Config\Database::connect();

		$query1 = $db->query($sql);
        $row1   = $query1->getResultArray();

        return $row1;
	}
}

if (! function_exists('print_db_data'))
{
	/**
	 * Return the result set of query
	 *
	 * @param string null
	 *
	 * @return boolion
	 */
	function print_db_data($str=1)
	{
		if (strpos($str, 'json:') !== false || strpos($str, 'attom:') !== false)
		{
			$db = \Config\Database::connect();

			$out = "";
			
			if (strpos($str, 'json:') !== false)
			{
				$split_str = explode(":",$str);

				$query = $db->query('SELECT value FROM config WHERE id = ' . $split_str[1]);
				$row   = $query->getRowArray();
				$config_val = json_decode($row['value'],true);

				$json_arr = json_decode($split_str[2],true);
				
				if(isset($json_arr) && is_array($json_arr))
				{
					$arr_len = count($json_arr) - 1;
					foreach($json_arr as $key=>$json_val)
					{
						$out .= $config_val[$json_val];
						if($arr_len > $key)
						{
							$out .= ", ";
						}
					}
				}
			}

			if (strpos($str, 'attom:') !== false)
			{
				$split_str = explode(":",$str);

				$query = $db->query('SELECT value FROM config WHERE id = ' . $split_str[1]);
				$row   = $query->getRowArray();
				if(isset($row['value'])){ $config_val = json_decode($row['value'],true); }
				if(isset($split_str[2]) && isset($config_val[$split_str[2]]))
				{
					$out .= $config_val[$split_str[2]];
				}
				else
				{ 
					$out .= "Unknown - " . $str;
				}
			}

			return $out;
			
		}
		else
		{
			if (strpos($str, "https://") !== false) 
			{
				return '<a href="' . $str . '" targget="_blank">Download</a>';
			}
			else
			{
				return $str;
			}
		}
	}
}

if (! function_exists('pre'))
{
	/**
	 * Flatten a multidimensional array using dots as separators.
	 *
	 * @param iterable $array The multi-dimensional array
	 * @param string   $id    Something to initially prepend to the flattened keys
	 *
	 * @return array The flattened array
	 */
	function pre($array)
	{
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}
}

if (! function_exists('elapsed'))
{
	/**
	 * Seconds to human readable form
	 *
	 * @param seconds as integer
	 *
	 * @return string human readable form
	 */
	function elapsed($seconds)
	{
		$dtF = new \DateTime('@0');
		$dtT = new \DateTime("@$seconds");

		$time_human_readable = "";

		if($seconds<60)
		{
			$time_human_readable = $dtF->diff($dtT)->format('%s seconds');
		}
		elseif($seconds<3600)
		{
			$time_human_readable = $dtF->diff($dtT)->format('%i minutes and %s seconds');
		}
		elseif($seconds<86400)
		{
			$time_human_readable = $dtF->diff($dtT)->format('%h hours, %i minutes and %s seconds');
		}
		else
		{
			$time_human_readable = $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
		}

		return $time_human_readable;
	}
}

if (! function_exists('cano_set_alert'))
{
	/**
	 * Set the alert message and it's type
	 *
	 * @param type as string
	 * @param message as string
	 *
	 * @return null
	 */
	function cano_set_alert($type,$message)
	{
		$_SESSION['alert_type'] = $type;
		$_SESSION['alert_message'] = $message;
	}
}

if (! function_exists('cano_get_alert'))
{
	/**
	 * Set the alert message and it's type
	 *
	 * @param void
	 *
	 * @return string
	 */
	function cano_get_alert()
	{
		if(isset($_SESSION['alert_type']))
		{
			echo '<div class="alert alert-'.$_SESSION['alert_type'].' alert-dismissible fade show" role="alert">
			'.$_SESSION['alert_message'].'
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>';
			unset($_SESSION['alert_type']);
			unset($_SESSION['alert_message']);
		}
	}
}

if (! function_exists('lock_entity'))
{
	/**
	 * Set the alert message and it's type
	 *
	 * @param id as integer
	 * @param table as string
	 *
	 * @return entity as array
	 */
	function lock_entity($id,$table)
	{
		$user['ID'] = $_SESSION['user']['id'];
		$db = \Config\Database::connect();

		$del_query = $db->table('entity_lock')
						->where('locked_at <' . (time()-get_config(3)));
		$del_query->delete();

		$query = $db->table('entity_lock')
					->select('entity_lock.id,entity_lock.table_name,entity_lock.primary_key,entity_lock.csrf_id,user.ID,user.display_name')
					->join('user', 'user.ID = entity_lock.locked_by', 'left')
					->where('entity_lock.table_name', $table)
					->where('entity_lock.primary_key', $id)
					->where('entity_lock.locked_at >' . (time()-get_config(3)))
					->get();
		$result = $query->getRowArray();

		if(isset($result['ID']))
		{
			if($result['ID']!=$user['ID'])
			{
				$result['is_locked'] = TRUE;
				cano_set_alert("danger",'<strong>Locked for editing!</strong> Currently this record being edit by "' . $result['display_name'] . '". Please wait till the edit completed or contact "' . $result['display_name'] . '" and ask to finish the editing. If the user inactive then it will be auto reset in 10 minute.');
			}
			else
			{
				$result['is_locked'] = FALSE;

				$update_query = $db->table('entity_lock');
				$update_query->set('locked_at', time());
				$update_query->where('id', $result['id']);
				$update_query->update();
			}
		}
		else
		{
			$result = [
				'table_name' => $table,
				'primary_key'  => $id,
				'csrf_id'  => md5($table . $id . time() . rand(1,999999)),
				'locked_at' => time(),
				'locked_by' => $user['ID'],
			];

			if($id > 0)
			{
				$insert_query = $db->table('entity_lock');
				$insert_query->insert($result);
			}

			$result['ID'] = $user['ID'];
			$result['is_locked'] = FALSE;
		}

		if($id==0)
		{
			$result['is_locked'] = FALSE;
		}

		return $result;
	}
}

if (! function_exists('relese_entity'))
{
	/**
	 * Set the alert message and it's type
	 *
	 * @param id as integer
	 *
	 * @return entity as array
	 */
	function relese_entity($id)
	{
		$user['ID'] = $_SESSION['user']['id'];
		$db = \Config\Database::connect();

		$del_query = $db->table('entity_lock')
						->where('id',$id)
						->where('locked_by',$user['ID']);
		$del_query->delete();
	}
}

if (! function_exists('get_current_url'))
{
	/**
	 * This is to return current url
	 *
	 * @param void
	 *
	 * @return url as string
	 */
	function get_current_url()
	{
		return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}
}


/**
 * All aws SDK function are being placed here
 * Consider the package import are bellow
 */
use Aws\S3\S3Client;
use Aws\Credentials\Credentials;
use Aws\Exception\MultipartUploadException;
use Aws\S3\MultipartUploader;

if ( ! function_exists('s3_upload'))
{
	function s3_upload($local_path,$server_path,$bucket="",$key="",$secret="")
	{
		if(strlen($key)>3)
		{
			$data['AWS_ACCESS_KEY_ID'] = $key;
			$data['AWS_SECRET_ACCESS_KEY'] = $secret;
		}
		else
		{
			$data['AWS_ACCESS_KEY_ID'] = config("App")->awsAccessKey;
			$data['AWS_SECRET_ACCESS_KEY'] = config("App")->awsSecretKey;
			$bucket = config("App")->s3BucketName;
		}
        
        $status = FALSE;

        $credentials = new Credentials($data['AWS_ACCESS_KEY_ID'], $data['AWS_SECRET_ACCESS_KEY']);
        
        // Instantiate the S3 client with your AWS credentials
        $client = S3Client::factory(array(
			'version'     => 'latest',
			'region'      => 'us-east-1',
            'credentials' => $credentials
        ));

		$uploader = new MultipartUploader($client, $local_path, [
			'bucket' => $bucket,
			'key' => $server_path,
		]);

        // Perform the upload. Abort the upload if something goes wrong
        try {
            $uploader->upload();
            $status = TRUE;
        } catch (MultipartUploadException $e) {
            $uploader->abort();
            echo "Upload failed.";
        }

        return $status;
	}
}

if ( ! function_exists('s3_tmp_url'))
{
	function s3_tmp_url($server_path,$bucket="")
	{
        $data['AWS_ACCESS_KEY_ID'] = config("App")->awsAccessKey;
        $data['AWS_SECRET_ACCESS_KEY'] = config("App")->awsSecretKey;

		if(strlen($bucket)<3)
		{
			$bucket = config("App")->s3BucketName;
		}
        
        $credentials = new Credentials($data['AWS_ACCESS_KEY_ID'], $data['AWS_SECRET_ACCESS_KEY']);
        
        // Instantiate the S3 client with your AWS credentials
        $client = S3Client::factory(array(
			'version'     => 'latest',
			'region'      => 'us-east-1',
            'credentials' => $credentials
        ));

		$cmd = $client->getCommand('GetObject', [
			'Bucket' => $bucket,
			'Key' => $server_path
		]);

        $request = $client->createPresignedRequest($cmd, '+20 minutes');

		return (string)$request->getUri();
	}
}

if ( ! function_exists('s3_delete'))
{
	function s3_delete($server_path,$bucket="")
	{
        $data['AWS_ACCESS_KEY_ID'] = config("App")->awsAccessKey;
        $data['AWS_SECRET_ACCESS_KEY'] = config("App")->awsSecretKey;
        
		if(strlen($bucket)<3)
		{
			$bucket = config("App")->s3BucketName;
		}

        $credentials = new Credentials($data['AWS_ACCESS_KEY_ID'], $data['AWS_SECRET_ACCESS_KEY']);
        
        // Instantiate the S3 client with your AWS credentials
        $client = S3Client::factory(array(
			'version'     => 'latest',
			'region'      => 'us-east-1',
            'credentials' => $credentials
        ));

		return $client->deleteObject([
			'Bucket' => $bucket,
			'Key'    => $server_path
		]);
	}
}

if ( ! function_exists('cano_poc'))
{
	function cano_poc()
	{
        echo config("App")->awsAccessKey;
	}
}

if (! function_exists('track'))
{
	/**
	 * Tracking user activity
	 *
	 * @param string null
	 *
	 * @return boolion
	 */
	function track()
	{
		if(isset($_SESSION['user']['id']))
		{
			$user_id = $_SESSION['user']['id'];
		}
		else
		{
			$user_id = 1;
		}
		$db = \Config\Database::connect();

		if(isset($_POST['pwd'])){ unset($_POST['pwd']); }
		if(isset($_POST['cpwd'])){ unset($_POST['cpwd']); }
		if(isset($_POST['pass'])){ unset($_POST['pass']); }

		$result = [
			'session' => json_encode($_SESSION),
			'post'  => json_encode($_POST),
			'header'  => json_encode($_SERVER),
			'date_time' => time(),
			'user_id' => $user_id,
		];

		$insert_query = $db->table('stats');
		$insert_query->insert($result);

		$del_query = $db->table('stats')
						->where('date_time <' . (time()-2592000));
		$del_query->delete();
	}
}

if (! function_exists('active_module'))
{
	/**
	 * Tracking user activity
	 *
	 * @param string null
	 *
	 * @return boolion
	 */
	function active_module($active_module,$mod="")
	{
		if(isset($active_module) && $active_module==$mod)
		{
			echo "active";
		}
	}
}

if (! function_exists('send_mail'))
{
	function send_mail($to_adress,$subject,$title = null,$message = null,$attachmentArray = null){

		$db = \Config\Database::connect();		
		
		$query1 = $db->query('SELECT * FROM config WHERE id = 60');
        $row1   = $query1->getRowArray();

		$query2 = $db->query('SELECT * FROM config WHERE id = 61');
        $row2   = $query2->getRowArray();

		$query3 = $db->query('SELECT * FROM config WHERE id = 62');
        $row3   = $query3->getRowArray();

		$mail_body = $row1['value'] . $title . $row3['value'] . $message . $row2['value'];

		if(empty($to_adress) || empty($subject) || empty($message)){
			throw new Exception("Invalid data sent to send email method");
		}

		$email = \Config\Services::email();
		$email->setTo($to_adress);
		$email->setSubject($subject);
		$email->setMessage($mail_body);

		if(!empty($attachmentArray)){
			foreach($attachmentArray as $attachmentPath){
				if(!$email->attach($attachmentPath)){
					throw new Exception("Invalid file path");
				}
			}
		}		

		if($email->send()){
			$response = $email->printDebugger(['header']);

			$mail_log = [
				'to_address' => $to_adress,
				'subject'  => $subject,
				'body'  => $mail_body,
				'status'  => 2,
				'log_text'  => $response,
				'created_at' => date('Y-m-d H:i:s'),
			];	
		}
		else
		{
			$error_data = $email->printDebugger(['header']);
			
			$mail_log = [
				'to_address' => $to_adress,
				'subject'  => $subject,
				'body'  => $mail_body,
				'status'  => 3,
				'log_text'  => $error_data,
				'created_at' => date('Y-m-d H:i:s'),
			];	
		}

		$insert_query = $db->table('mail_log');
		$insert_query->insert($mail_log);
	}
}