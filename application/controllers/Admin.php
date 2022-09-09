<?php
// include 'session.inc';
class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
        $this->load->model('model');
    }
    
    function index()
    {
        $this->go_dashboard();
    }

    function dashboard_submit()
    {
        $this->go_dashboard($_REQUEST['month']);
    }

    function go_dashboard($month = '')
    {
        
        $this->load->view('header', array('page' => 'dashboard'));
        $this->load->view('dashboard');
        // $this->googleAnalytics();
        // $this->google_api();
    }
    function google_api() {
        $this->load->library('ga_api');

        // Set new profile id if not the default id within your config document
        $this->ga_api->login();
        $this->ga_api->init(array('profile_id' => '237612638'));

        // Query Google metrics and dimensions
        // Documentation: http://code.google.com/apis/analytics/docs/gdata/dimsmets/dimsmets.html)
        $data = $this->ga_api
            ->dimension('adGroup , campaign , adwordsCampaignId , adwordsAdGroupId')
            ->metric('impressions')
            ->limit(30)
            ->get_object();

        // Also please note, if you using default values you still need to init()
        $data = $this->ga_api->login()
            ->dimension('adGroup , campaign , adwordsCampaignId , adwordsAdGroupId')
            ->metric('impressions')
            ->limit(30)
            ->get_object();


        // Please note you can also query against your account and find all the profiles associated with it by
        // grab all profiles within your account
        $data['accounts'] = $this->ga_api->login()->get_accounts();
    }

    function googleAnalytics() {

        $this->config->load('ga_api');
        
        $ga_params = array(
            'applicationName' => $this->config->item('ga_api_applicationName'),
            'clientID' => $this->config->item('ga_api_clientId'),
            'clientSecret' => $this->config->item('ga_api_clientSecret'),
            'redirectUri' => $this->config->item('ga_api_redirectUri'),
            'developerKey' => $this->config->item('ga_api_developerKey'),
            'profileID' => $this->config->item('ga_api_profileId')
        );

        $this->load->library('GoogleAnalytics', $ga_params);

        $data = array(
            'users' => $this->googleanalytics->get_total('users'),
            'sessions' => $this->googleanalytics->get_total('sessions'),
            'browsers' => $this->googleanalytics->get_dimensions('browser','sessions'),
            'operatingSystems' => $this->googleanalytics->get_dimensions('operatingSystem','sessions'),
            'profileInfo' => $this->googleanalytics->get_profile_info()
        );

        //$this->googleanalytics->some_function();

        var_dump($data);
    }

    public function logout() {
        $this->config->load('ga_api');
        $ga_params = array(
            'applicationName' => $this->config->item('ga_api_applicationName'),
            'clientID' => $this->config->item('ga_api_clientId'),
            'clientSecret' => $this->config->item('ga_api_clientSecret'),
            'redirectUri' => $this->config->item('ga_api_redirectUri'),
            'developerKey' => $this->config->item('ga_api_developerKey'),
            'profileID' => $this->config->item('ga_api_profileId')
        );
        $this->load->library('GoogleAnalytics', $ga_params);
        $this->googleanalytics->logout();
    }

    function go_articles()
    {

        $result = $this->model->get_article_array($data);
        $this->load->view('header', array('page' => 'articles'));   
        $this->load->view('admin/articles', array('data' => $data['data'])); 
    }

    function go_notification()
    {
        $result = $this->model->get_account_array($data);
        $this->load->view('header', array('page' => 'notification'));   
        $this->load->view('admin/notification', array('data' => $data['data']));   
    }

    function send_text_notification()
    {
        //$images = $_REQUEST['files'];        
        $text = $_REQUEST['text'];        
        $id = $_REQUEST['id'];
        $this->sendGCM('text', $text, $id);
        // echo $id;
        // echo $this->model->add_article($str_images, $title, $description);
    }

    function add_notification($article_id, $text) {
        $result = $this->model->add_notification($article_id, $text);
    }

    function add_article()
    {
        //$images = $_REQUEST['files'];        
        $title = $_REQUEST['title'];        
        $description = $_REQUEST['description'];
        //var_dump(count($images));
        /*for($i = 0; $i < count($images); $i ++) {
            print_r($images[$i]);
        }*/
        // $description = nl2br($description);
        $arr_image = array();
        $uploads_dir = FCPATH. '/uploads';
        foreach ($_FILES["files"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["files"]["tmp_name"][$key];
                // basename() may prevent filesystem traversal attacks;
                // further validation/sanitation of the filename may be appropriate
                $name = basename($_FILES["files"]["name"][$key]);
                move_uploaded_file($tmp_name, "$uploads_dir/$name");
                array_push($arr_image, $name);
            }
        }
        $str_images = implode(",", $arr_image);
        $result = $this->model->add_article($str_images, $title, $description, $insert_id);
        if ($result == 200) {
            $this->sendGCM('article', '', $insert_id);
        } else {
            echo $result;
        }
    }

    function edit_article()
    {
        $id = $_REQUEST['id'];
        $description = $_REQUEST['description'];
        echo $this->model->edit_article($id, $description);
    }

    function delete_item($table, $id)
    {
        $this->model->delete_item($table, $id);
        switch ($table) {
            case 'tbl_article':
                $this->go_articles();
                break;
            default:
                break;
        }
    }

    function sendGCM($type, $message, $article_id) {
        if ($type == "article") {
            $body = "SEMVAC posted a new article.";
        } else {
            $body = $message;
        }
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array (
                // 'registration_ids' => array (
                //     'fsoUkkEPQweHDD5JAuieul:APA91bGmyqD3BG4z_eyjKaFIEg55In2d5xmXKPLYc_0N6c7Hz95LIWtLhpe3fK0kywKXFxw1k5K0ExgLdgHClmiwSzQSStIdPPe_Z-ruz0O6TeXqe61-fosOa3-zA1xlCNuIqcNNOi7J'
                // ),
                'to' => '/topics/'.FB_TOPIC
                ,
                'notification' => array (
                            'body'  => $body,
                            'title'     => "Notification from SEMVAC",
                            'vibrate'   => 1,
                            'sound'     => 1,
                        )
                ,
                'data' => array (
                    "title" =>  "SEMVAC notification",
                    'article_id' => $article_id,
                    'text' => $message,
                    'type' => $type,

                )
        );
        $fields = json_encode ( $fields );
        $headers = array (
            'Authorization: key='.FB_SERVER_KEY,
            'Content-Type: application/json'
        );
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        $result = curl_exec ( $ch ); 
        $s_result = json_decode($result);
        if (isset($s_result->message_id)) {
            $this->add_notification($article_id, $message);
            echo 200;
        } else {
            echo 400;
        }
        curl_close ($ch);
    }
    function edit_profile()
    {
        $userid = $_REQUEST['userid'];
        $password = $_REQUEST['password'];
        $password_new = $_REQUEST['password_new'];
        $pw_update = $_REQUEST['pw_update'];
        $result = $this->model->update_profile($userid, $password, $password_new, $pw_update, $data);
        if ($result == 200) {
            $_SESSION = array();
            $_SESSION[S_SITE] = array(S_LOG => true, S_DATA => $data['data']);
        }
        echo $result;
    }


    function go_profile()
    {
        $result = $this->model->get_admin_profile($data);
        $this->load->view('header', array('page' => 'profile'));   
        $this->load->view('profile', array('data' => $data['data']));   
    }









    function go_payments()
    {
        $result = $this->model->get_payment_array($data);
        $this->load->view('header', array('page' => 'payments'));   
        $this->load->view('admin/payments', array('data' => $data['data']));   
    }

    function add_payment()
    {
        $email = $_REQUEST['email'];        
        $site = $_REQUEST['site'];        
        $date = $_REQUEST['date'];
        echo $this->model->add_payment($email, $site, $date);
    }

    function edit_payment()
    {
        $id = $_REQUEST['id'];        
        $email = $_REQUEST['email'];        
        $site = $_REQUEST['site'];        
        $date = $_REQUEST['date'];
        echo $this->model->edit_payment($id, $email, $site, $date);
    }

    

    function change_item($table, $id)
    {
        $this->model->change_item($table, $id);
        switch ($table) {
            case 'tbl_user':
                $this->go_users();
                break;
            case 'tbl_earning':
                $this->go_earnings();
                break;
            case 'tbl_account':
                $this->go_accounts();
                break;
            case 'tbl_payment':
                $this->go_payments();
                break;
            default:
                break;
        }
    }

    function order_array_by_earning(&$array, $field1, $field2)
    {
        for ($i=0; $i < count($array[$field2]); $i++) { 
            for ($j=0; $j <= $i; $j++) { 
                if ($array[$field2][$i] > $array[$field2][$j]) {
                    $tmp1 = $array[$field1][$i];
                    $tmp2 = $array[$field2][$i];
                    $array[$field1][$i] = $array[$field1][$j];
                    $array[$field1][$j] = $tmp1;
                    $array[$field2][$i] = $array[$field2][$j];
                    $array[$field2][$j] = $tmp2;
                }
            }
        }
    }

}
?>