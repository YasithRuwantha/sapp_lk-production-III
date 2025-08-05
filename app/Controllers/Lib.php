<?php

namespace App\Controllers;
use App\Models\LibModel;
use App\Models\UserModel;

class Lib extends BaseController
{
	private $data;

    public function __construct()
    {
        $this->data = array();
		helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect();
	}

	public function index()
	{
		return view('welcome_message');
	}

	public function ssh_cmd()
	{
		$host = '184.73.125.236';
		$port = 22;
		$user = 'sinon';
		$pass = 'Hchk2021';

		$connection = ssh2_connect($host, $port, array('hostkey'=>'ssh-rsa'));
		ssh2_auth_password($connection, $user, $pass);

		$cmd = '
		MEM_TOTAL=`cat /proc/meminfo | grep "MemTotal:" | awk \'{ print $2 }\'` 
		MEM_FREE=`cat /proc/meminfo | grep "MemAvailable:" | awk \'{ print $2 }\'`
		MEM_USED=$((MEM_TOTAL-MEM_FREE))
		MEM_RATIO=`echo "$MEM_USED / $MEM_TOTAL" | bc -l`
		MEM_PERCENT=`echo "$MEM_RATIO * 100" | bc`
		MEM_PERC_ROUND=`printf "%.0f" "$MEM_PERCENT"`
		echo \'' . $pass . '\' | sudo -S whoami
		whoami
		echo $MEM_PERC_ROUND
		';

		$stream = ssh2_exec($connection, $cmd);

		stream_set_blocking($stream, true);
		$stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
		$err = ssh2_fetch_stream($stream,SSH2_STREAM_STDERR);
		echo "<pre>";
		echo stream_get_contents($stream_out);
		echo stream_get_contents($err);
	}

	public function xml_parser()
	{
		$xml_object=simplexml_load_file("/mnt/www/general/www.canopuz.com/cms/resources/poc/sample.kml") or die("Error: Cannot create object");
		$xml_array=json_decode(json_encode($xml_object),TRUE);
		$arr_points = explode(" ",trim($xml_array["Document"]["Placemark"]["Polygon"]["outerBoundaryIs"]["LinearRing"]["coordinates"]));
		$polygon = array();
		echo "<pre>";

		foreach($arr_points as $val)
		{
			$coordinates = explode(",",$val);
			$polygon[] = array("lat"=>floatval($coordinates[1]),"lng"=>floatval($coordinates[0]));
		}
		print_r(json_encode($polygon));
	}

	public function db_chk()
	{
		$libModel = new LibModel();
		$users = $libModel->orderBy('ID', 'DESC')->findAll();
		print_r($users);
	}

	public function wp_user()
	{
		echo '<pre>';
		$arr = wp_get_current_user();
		$user = json_decode(json_encode($arr),TRUE);
		echo get_avatar_url( $user['data']['ID']);
		print_r($user);
		if ( current_user_can( 'add_work_group' ) ) {
			echo "I can add";
		}
		echo wp_logout_url( "https://www.canopuz.com/cms/public/" ) . "<br>";
		echo wp_login_url( "https://www.canopuz.com/cms/public/");
	}

	public function wp_login()
	{
		echo '<pre>';
		$arr = json_encode(wp_authenticate( "wp_user", "Wp_Apass2020" ));
		$user = json_decode($arr,TRUE);
		if(isset($user['data']['user_email']))
		{
			echo $user['data']['user_email'];
		}
		print_r($user);
	}

	public function wp_user_by()
	{
		echo '<pre>';
		$arr = json_encode(get_user_by('email', 'wpuser@gmail.com'));
		$user = json_decode($arr,TRUE);
		if(isset($user['data']['user_email']))
		{
			echo $user['data']['user_email'];
		}
		print_r($user);
	}

	public function wp_get_url()
	{
		echo site_url();
		echo "<br>" . site_url('forums/thread');
	}

	public function elapsed()
	{
		echo elapsed(362100);
	}

	public function date()
	{
		echo date("Y-m-d H:i:s", 1618712220) . "<br/>";
		echo strtotime("2021-04-17 21:17:00"). "<br/>";
		echo date("d-m-Y", strtotime("2021-04-17 21:17:00"));
	}

	public function get_users()
	{
		$blogusers = get_users();
		pre($blogusers);
	}

	public function ping_log($key="general")
	{
		$file = '/mnt/www/general/www.canopuz.com/cms/resources/poc/ping.txt';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= $key . ": " . date('Y-m-d H:i:s') . " \n";
		// Write the contents back to the file
		file_put_contents($file, $current);
		pre($current);
	}

	public function img($path)
	{
        if(isset($_SESSION['user_id']))
        {
            $path = s3_tmp_url("rwss-resource",str_replace("Images/","rzImages/",implode('/', func_get_args())));             
        }else{
            $path = "resources/sitecontent/notauthorized.png";
        }
        
        $ext = pathinfo($path, PATHINFO_EXTENSION);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $path); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // good edit, thanks!
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1); // also, this seems wise considering output is image.
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
        

        header('Pragma: public');
        header('Cache-Control: max-age=86400');
        header('Expires: '. gmdate('D, d M Y H:i:s \G\M\T', time() + 86400));
        header('Content-Type: image/jpg');

        imagejpeg($dest_image,NULL,90);
        imagedestroy($dest_image);
        imagedestroy($im);
    }

	public function s3handling()
	{
		$bucket = "cano-mis";
		$bucket = config("App")->s3BucketName;
		$local_path = "/mnt/www/disk2/git/venera/resources/poc/sugu.png";
		$server_path = "venera/poc/sugu.png";
		//s3_upload($bucket,$local_path,$server_path);
		//echo s3_tmp_url($bucket,$server_path);
		//s3_delete($bucket,$server_path);
	}

	public function list_file()
	{
		if ($handle = opendir("/mnt/www/disk2/www.pli-sanasacampus.com/survey/resources/survey/")) {
            while (false !== ($entry = readdir($handle))) {        
                if (is_file("/mnt/www/disk2/www.pli-sanasacampus.com/survey/resources/survey/" . $entry)) {
                    echo $entry . "<br>";
                }
            }
            closedir($handle);
        }

		rename("/mnt/www/disk2/www.pli-sanasacampus.com/survey/resources/survey/65847a98af77a71425a3624df91f69e3.jpg", "/mnt/www/disk2/www.pli-sanasacampus.com/survey/resources/survey/del/65847a98af77a71425a3624df91f69e3.jpg");

	}

	public function lex()
	{
		return view('/lib/lex',$this->data);
	}

	public function bot()
	{
		return view('/lib/bot',$this->data);
	}

	public function bot_poc()
	{
		return view('/lib/bot_poc',$this->data);
	}

	public function pulse()
	{
		track();
	}

	public function whatsapp()
	{
		$query = $this->data["db"]->query('SELECT * FROM ven_acc_entries AS ae LEFT JOIN ven_acc_entry_type AS aet ON ae.entry_type_id = aet.id LIMIT 50');
        echo json_encode($query->getResultArray());
	}

	public function stat()
	{
        auth_rd();
        $this->data['csrf'] = 1;
        
        $query = $this->data["db"]->query("SELECT * FROM `view_visit_stats`");
        $this->data['list_all'] = $query->getResultArray();

        return view('lib/stat',$this->data);
	}

	public function google_map()
	{
        auth_rd();
        $this->data['csrf'] = 1;

        return view('lib/google_map',$this->data);
	}

	public function map_travel()
	{
        auth_rd();
        $this->data['csrf'] = 1;

        return view('lib/map_travel',$this->data);
	}

	public function map_info()
	{
        auth_rd();
        $this->data['csrf'] = 1;

        return view('lib/map_info',$this->data);
	}

	public function print()
	{
        return view('lib/print',$this->data);
	}

	public function auth()
	{
		$servername = "mysql.canopuz.com";
		$username = "sapp_user";
		$password = "UsrSapp#2022";
		$dbname = "sapp_core";







		if(isset($_POST['pwd']))
		{	
			echo "<h2>Direct SQL</h2>";
			$sql = "SELECT id,profile_picture,fname,lname,mobile,email FROM user WHERE mobile LIKE '" . $_POST['user'] . "' AND password LIKE '" . md5($_POST['pwd']) . "'";
			echo "Raw SQL: " . $sql . "<br>";
			$raw_arr = array();

			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					$raw_arr = array("id" => $row["id"], "fname" => $row["fname"], "lname" => $row["lname"]);
				}
			} else {
				echo "0 results";
			}

			echo "Result:<br>";
			pre($raw_arr);

			mysqli_close($conn);


			echo "<h2>Prepared Statements</h2>";

			// using codigniter methord
			$entity_model = new UserModel();
			$action_list = $entity_model->select("id,fname,lname")
                            ->where("mobile", $_POST['user'])
							->where("password", md5($_POST['pwd']))
							->first(); 

			
			$query = $this->data["db"]->getLastQuery();
			echo "SQL: " . (string)$query . "<br>";

			echo "Result:<br>";
			pre($action_list);
		}
		else
		{
        	return view('lib/auth',$this->data);
		}
	}

	public function csv()
	{
		return view('lib/csv',$this->data);
	}

	public function email()
	{
		error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
		$to = "thulasivarman@gmail.com";
        $subject = "SAPP - You wee added to SAPP MIS";
		$title = "Welcome to SAPP<br />Let's get into the system.";
		$message = '<p>Hi Kumaraguru Sugunan </p><p> Welcome to SAPP system. You can reset your password by clicking this link </p>
		<p><a style="background-color: #9e1d1d; border-radius: 4px; color: #fcf6e7; padding: 15px; font-size: 14px; text-decoration: none; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;" href="http://google.com">Password Reset</a>. </p><p> Please note that this link will only work for one time.</p>';
		
        send_mail($to,$subject,$title,$message);
	}

	public function session()
	{
		auth_rd();
		var_dump(is_auth(257));
		pre($_SESSION);
	}

	public function trap($id)
	{
		auth_rd();
		$_SESSION['user']['id'] = $id;
	}

	public function usr()
	{
		$user_model = new UserModel();
        $this->data['user_list'] = $user_model->select("*")
                            ->where("is_delete = 0")
                            ->findAll();
		pre($this->data['user_list']);
	}
}
