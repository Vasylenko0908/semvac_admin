<?php

    class Mobile extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            // $this->load->helper(array('form', 'url'));
            $this->load->helper('url');
            $this->load->database();
            $this->load->model('model');
        }
        
        function index()
        {
            $status = 400;
            $in_array = array();
            $out_array = array('reason' => '');
            
            $type = $_REQUEST['type'];
            switch ($type) {
                case 'get_articles':
                    $status = $this->model->get_article_array($out_array);
                    break;
                case 'add_favor':
                    $status = $this->model->add_favor($_REQUEST['id']);
                    break;
                case 'add_share':
                    $status = $this->model->add_share($_REQUEST['id']);
                    break;
                case 'remove_favor':
                    $status = $this->model->remove_favor($_REQUEST['id']);
                    break;
                case 'add_open':
                    $status = $this->model->add_open($_REQUEST['id']);
                    break;
                case 'get_favors':
                    $arr_ids = explode(',', $_REQUEST['ids']);
                    $status = $this->model->get_favors($arr_ids, $out_array);
                    break;
                case 'get_article':
                    $status = $this->model->get_article($_REQUEST['id'], $out_array);
                    break;











                    

                case 'search_services':
                    $this->load->model('service_model');
                    $this->service_model->checkFeaturedServices();

                    $this->load->model('mobile_model');
                    $status = $this->mobile_model->search_services($_REQUEST['id'], $_REQUEST['search_key'], $out_array['data']);
                    break;
                case 'add_like':
                    $this->load->model('mobile_model');
                    $status = $this->mobile_model->add_like($_REQUEST['id'], $_REQUEST['islike'], $out_array);
                    break;
                case 'get_all_services':
                    $this->load->model('service_model');
                    $this->service_model->checkFeaturedServices();

                    $this->load->model('mobile_model');
                    $status = $this->mobile_model->get_all_services($out_array['data']);
                    break;
                case 'get_all_members':
                    $this->load->model('user_model');
                    $status = $this->user_model->get_userById(1, $out_array['admin'][0]);
                    $status = $this->user_model->get_members('operator', $out_array['operators']);
                    $status = $this->user_model->get_members('provider', $out_array['providers']);
                    $status = $this->user_model->get_members('user', $out_array['users']);
                    break;
                case 'compare':
                    if ($_REQUEST['operator_array'] == "ALL") {
                        $operator_array = array();
                    } else {
                        $operator_array = explode(",", $_REQUEST['operator_array']);
                    }
                    $this->load->model('mobile_model');
                    $status = $this->mobile_model->compare($_REQUEST['service_name'], $operator_array, $out_array['data']);
                    break;
                case 'get_messages':
                    $this->load->model('message_model');
                    $status = $this->message_model->getInbox($_REQUEST['user_id'], $out_array['inbox']);
                    $status = $this->message_model->getSent($_REQUEST['user_id'], $out_array['sent']);
                    break;
                case 'read_message':
                    $this->load->model('message_model');
                    $status = $this->message_model->fetch_messageById($_REQUEST['id'], TRUE, $array);
                    if ($status != 200) {
                        $out_array['reason'] = 'Invalid message';
                    }
                    break;
                case 'add_message':
                    if ($_REQUEST['receiver_array'] == "ALL") {
                        $receiver_arr = array();
                    } else {
                        $receiver_arr = explode(",", $_REQUEST['receiver_array']);
                    }
                    $this->load->model('mobile_model');
                    $status = $this->mobile_model->add_message($_REQUEST['sender_id'], $receiver_arr, 
                        $_REQUEST['service_id'], $_REQUEST['content'] ,$_REQUEST['concern_id'], time());
                    break;
                case 'forgot_password':
                    $this->load->model('user_model');
                    $status = $this->user_model->get_IdByEmail($_REQUEST['email'], $id);
                    if ($status == 200) {
                        $this->send_email($_REQUEST['email'], $id);
                    } else {
                        $out_array['reason'] = 'Invalid User';
                    }
                case 'update_profile':
                    $in_array = array('id' => $_REQUEST['id'], 'username' => $_REQUEST['username'], 'country_code' => $_REQUEST['country_code']
                        , 'number' => $_REQUEST['number'], 'gender' => $_REQUEST['gender'], 'birthday' => $_REQUEST['birthday']);
                    $this->load->model('mobile_model');
                    $status = $this->mobile_model->update_profile($in_array, $out_array);
                    break;
                case 'change_password':
                    $this->load->model('user_model');
                    $status = $this->user_model->update_password($_REQUEST['id'], $_REQUEST['password'], $error);
                    $out_array['password'] = $_REQUEST['password'];
                    break;
                case 'load_interest':
                    $this->load->model('mobile_model');
                    $status = $this->mobile_model->load_interest($_REQUEST['id'], $out_array);
                    break;
                case 'add_interest_operator':
                    $operator_arr = explode(",", $_REQUEST['operator_array']);
                    $this->trim_array($operator_arr);
                    $this->load->model('mobile_model');
                    $status = $this->mobile_model->add_interest_operator($_REQUEST['id'], $operator_arr, $out_array);
                    break;
                case 'add_interest_category':
                    $category_arr = explode(",", $_REQUEST['category_array']);
                    $this->trim_array($category_arr);
                    $this->load->model('mobile_model');
                    $status = $this->mobile_model->add_interest_category($_REQUEST['id'], $category_arr, $out_array);
                    break;
                default:
                    break;
            }
            // header('Content-Type: application/json');
            echo json_encode(array('status' => $status, 'data' => $out_array));
        }
        function trim_array(&$array) 
        {
            if (count($array) == 1 && $array[0] == '') {
                $array = array();
            }
        }
        function send_email($email, $user_id)
        {
            $site_email = SERVER_EMAIL; //who does this mail get sent from (must be in the same domain as this site)
            $recipient = $email;    //who does this mail get sent to?
            $body = "Please click the following url to reset your password. \n".base_url().'index.php/verify/forgot_password/'.$user_id;
            $subject = "Reset password";
            $headers = "From: ". $site_email . "\r\n";
            
            if (!mail ($recipient, $subject, $body, $headers))
                echo "Couldn't send mail";
        
        }

        function push_android($type, $token, $message, $badge, $data = '')
        {
            $this->load->library('ci_pusher');
            $pusher = $this->ci_pusher->get_pusher();
            $result = $pusher->notify(
              array($token),
              array(
                'gcm' => array(
                  'notification' => array(
                    'title' => S_SITE,
                    'body' => $message,
                    'icon' => 'androidlogo',
                    'sound' => 'default',
                  ),
                  'data' => array(
                    'data' => array('info' => $data,
                        'badge' => intval($badge),
                        'title' => $message,
                        'type' => $type),
                  ),
                ),
                'webhook_url' => 'http://requestb.in/y0xssw70',
                'webhook_level' => 'INFO',
              )
            );
        }

   }
?>