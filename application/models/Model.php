<?php

class Model extends CI_Model
{
	private $DATA_ARRAY = array('data' => array(), 'error' => '');
    public function __construct()
    {
        parent::__construct();
		$this->load->database();
        // $this->load->library('encryption');
    }

    function get_user_info($userid, $pwd, &$data)
    {
    	$data = $this->DATA_ARRAY;
    	$result = $this->db->get_where('tbl_user', array('userid' => $userid, 'deleted' => 0))->result_array();
    	if (count($result) == 0) {
    		$data['error'] = 'Invalid UserID!';
    		return 400;
    	}
    	if ($result[0]['password'] != $pwd) {
    		$data['error'] = 'Incorrect Password!';
    		return 400;
    	}
    	$data['data'] = $result[0];
    	return 200;
    }

    function get_admin_profile(&$data) {
        $data = $this->DATA_ARRAY;
        $result = $this->db->get_where('tbl_user', array('id' => 1))->result_array();
        $data['data'] = $result[0];
        return 200;
    }

    function update_profile($userid, $password, $password_new, $pw_update, &$data) 
    {
        $data = $this->DATA_ARRAY;
        $result = $this->db->get_where('tbl_user', array('id' => 1))->result_array();
        if ($result[0]['password'] == $password) {
            $data['data'] = $result[0];
            $this->db->where('id', 1);
            if ($pw_update == 1) {
                $this->db->update('tbl_user', array('userid' => $userid, 'password' => $password_new));
                $data['data']['userid'] = $userid;
                $data['data']['password'] = $password_new;
            } else {
                $this->db->update('tbl_user', array('userid' => $userid));
                $data['data']['userid'] = $userid;
            }
            return 200;
        } else {
            return 400;
        }
    }

    function set_user_info($name, $userid, $pwd, &$data)
    {
    	$data = $this->DATA_ARRAY;
    	$result = $this->db->get_where('tbl_user', array('userid' => $userid, 'deleted' => 0))->result_array();
    	if (count($result) > 0) {
    		$data['error'] = 'The userID already exists!';
    		return 400;
    	}
    	$data['data'] = array('name' => $name, 'userid' => $userid, 'password' => $pwd, 'type' => USER, 'created' => time());
    	$this->db->insert('tbl_user', $data['data']);
    	return 200;
    }

    function get_article_array(&$data)
    {
        $data = $this->DATA_ARRAY;
        $this->db->order_by('created', 'DESC');
        $data['data'] = $this->db->get_where('tbl_article', array('deleted' => 0))->result_array();
        for ($i=0; $i < count($data['data']); $i++) { 
            $arr_images = explode(',', $data['data'][$i]['images']);
            $data['data'][$i]['img_arr'] = $arr_images;
        }
        // var_dump($data['data']);
        return 200;     
    }

    function add_notification($article_id, $text)
    {
        $date = date('Y/m/d H:i:s', time());
        $this->db->insert('tbl_notification', array('text' => $text, 'created' => time(), 'article_id' => $article_id, 'date' => $date));
        $insert_id = $this->db->insert_id();
        return 200;     
    }

    function add_article($str_images, $title, $description, &$insert_id)
    {
        $date = date('Y/m/d H:i:s', time());
        $this->db->insert('tbl_article', array('title' => $title, 'description' => $description, 'images' => $str_images, 'created' => time(), 'date' => $date));
        $insert_id = $this->db->insert_id();
        return 200;     
    }

    function edit_article($id, $description)
    {
        // $date = date('Y/m/d H:i:s', time());
        $this->db->where('id', $id);
        $this->db->update('tbl_article', array('description' => $description));
        return 200;     
    }

    function add_favor($id)
    {
        $result = $this->db->get_where('tbl_article', array('id' => $id, 'deleted' => 0))->result_array();
        if (count($result) > 0) {
            $this->db->where('id', $id);
            $this->db->update('tbl_article', array('favors' => $result[0]['favors']+1));
        }
        return 200;     
    }

    function add_share($id)
    {
        $result = $this->db->get_where('tbl_article', array('id' => $id, 'deleted' => 0))->result_array();
        if (count($result) > 0) {
            $this->db->where('id', $id);
            $this->db->update('tbl_article', array('shares' => $result[0]['shares']+1));
        }
        return 200;     
    }

    function remove_favor($id)
    {
        $result = $this->db->get_where('tbl_article', array('id' => $id, 'deleted' => 0))->result_array();
        if (count($result) > 0) {
            $favors = $result[0]['favors']-1;
            if ($favors < 0) {
                $favors = 0;
            }
            $this->db->where('id', $id);
            $this->db->update('tbl_article', array('favors' => $favors));
        }
        return 200;     
    }

    function add_open($id)
    {
        $result = $this->db->get_where('tbl_article', array('id' => $id, 'deleted' => 0))->result_array();
        if (count($result) > 0) {
            $this->db->where('id', $id);
            $this->db->update('tbl_article', array('opens' => $result[0]['opens']+1));
        }
        return 200;     
    }

    function get_favors($arr_ids, &$data)
    {
        $data = $this->DATA_ARRAY;
        for ($i=0; $i < count($arr_ids); $i++) { 
            $result = $this->db->get_where('tbl_article', array('id' => $arr_ids[$i], 'deleted' => 0))->result_array();
            if (count($result) > 0) {
                $arr_images = explode(',', $result[0]['images']);
                $result[0]['img_arr'] = $arr_images;
                array_push($data['data'], $result[0]);
            }
        }
        return 200;     
    }

    function get_article($id, &$data) 
    {
        $data = $this->DATA_ARRAY;
        $result = $this->db->get_where('tbl_article', array('id' => $id, 'deleted' => 0))->result_array();
        if (count($result) > 0) {
            $arr_images = explode(',', $result[0]['images']);
            $result[0]['img_arr'] = $arr_images;
            array_push($data['data'], $result[0]);
            $data = $result[0];
        }
        return 200;    
    }





















    function get_user_array(&$data)
    {
    	$data = $this->DATA_ARRAY;
    	$month = date('Y-m', time());
    	$data['data'] = $this->db->get_where('tbl_user', array('type' => USER, 'deleted' => 0))->result_array();
    	for ($i=0; $i < count($data['data']); $i++) { 
    		$data['data'][$i]['earning_total'] = $this->get_earning_total_by_user_id($data['data'][$i]['id']);
    		$data['data'][$i]['earning_month'] = $this->get_earning_month_by_user_id($data['data'][$i]['id'], $month);
    	}
    	return 200;
    }

    

    function get_user_earning_array(&$data, $user_id)
    {
        $data = $this->DATA_ARRAY;
        $this->db->order_by('date', 'DESC');
        $data['data'] = $this->db->get_where('tbl_earning', array('user_id' => $user_id, 'deleted' => 0))->result_array();
        for ($i=0; $i < count($data['data']); $i++) {
            $data['data'][$i]['payment_email'] = $this->get_data_by_id('tbl_payment', $data['data'][$i]['payment_id'], 'email');
        }
        return 200;     
    }

    function get_account_array(&$data)
    {
    	$data = $this->DATA_ARRAY;
    	$data['data'] = $this->db->get_where('tbl_account', array('deleted' => 0))->result_array();
    	for ($i=0; $i < count($data['data']); $i++) {
    		$data['data'][$i]['payment_email'] = $this->get_data_by_id('tbl_payment', $data['data'][$i]['payment_id'], 'email');
    		$data['data'][$i]['user_name'] = $this->get_data_by_id('tbl_user', $data['data'][$i]['user_id'], 'name');
    	}
    	return 200;    	
    }

    function get_user_account_array(&$data, $user_id)
    {
        $data = $this->DATA_ARRAY;
        $data['data'] = $this->db->get_where('tbl_account', array('user_id' => $user_id, 'deleted' => 0))->result_array();
        for ($i=0; $i < count($data['data']); $i++) {
            $data['data'][$i]['payment_email'] = $this->get_data_by_id('tbl_payment', $data['data'][$i]['payment_id'], 'email');
        }
        return 200;     
    }

    function get_payment_array(&$data)
    {
    	$data = $this->DATA_ARRAY;
    	$data['data'] = $this->db->get_where('tbl_payment', array('deleted' => 0))->result_array();
    	return 200;    	
    }

    function add_payment($email, $site, $date)
    {
    	$result = $this->db->get_where('tbl_payment', array('email' => $email, 'deleted' => 0))->result_array();
    	if (count($result) > 0) {
    		return 400;
    	}
    	$this->db->insert('tbl_payment', array('email' => $email, 'site' => $site, 'date' => $date));
    	return 200;
    }

    function edit_payment($id, $email, $site, $date)
    {
        $result = $this->db->get_where('tbl_payment', array('email' => $email, 'deleted' => 0))->result_array();
        if (count($result) > 0) {
            if ($result[0]['id'] != $id) {
                return 400;
            }
        }
        $this->db->where('id', $id);
        $this->db->update('tbl_payment', array('email' => $email, 'site' => $site, 'date' => $date));
        return 200;
    }

    function add_earning($payment_email, $task, $amount, $date, $user_id)
    {
        $result = $this->db->get_where('tbl_payment', array('email' => $payment_email, 'deleted' => 0))->result_array();
        if (count($result) == 0) {
            return 400;
        }
        $this->db->insert('tbl_earning', array('user_id' => $user_id, 'payment_id' => $result[0]['id'], 'task' => $task, 'amount' => $amount, 'date' => $date));
        return 200;
    }

    function edit_earning($payment_email, $task, $amount, $date, $id)
    {
        $result = $this->db->get_where('tbl_payment', array('email' => $payment_email, 'deleted' => 0))->result_array();
        if (count($result) == 0) {
            return 400;
        }
        $this->db->where('id', $id);
        $this->db->update('tbl_earning', array('payment_id' => $result[0]['id'], 'task' => $task, 'amount' => $amount, 'date' => $date));
        return 200;
    }

    function add_account($email, $payment_email, $site, $date, $review, $user_id)
    {
        $result = $this->db->get_where('tbl_account', array('email' => $email, 'deleted' => 0))->result_array();
        if (count($result) > 0) {
            return 401;
        }
        $result = $this->db->get_where('tbl_payment', array('email' => $payment_email, 'deleted' => 0))->result_array();
        if (count($result) == 0) {
            return 400;
        }
        $this->db->insert('tbl_account', array('user_id' => $user_id, 'payment_id' => $result[0]['id'], 'site' => $site, 'email' => $email, 'date' => $date, 'review' => $review));
        return 200;
    }

    function edit_account($email, $payment_email, $site, $date, $review, $id)
    {
        $result = $this->db->get_where('tbl_account', array('email' => $email, 'deleted' => 0))->result_array();
        if (count($result) > 0) {
            if ($id != $result[0]['id']) {
                return 401;
            }
        }
        $result = $this->db->get_where('tbl_payment', array('email' => $payment_email, 'deleted' => 0))->result_array();
        if (count($result) == 0) {
            return 400;
        }
        $this->db->where('id', $id);
        $this->db->update('tbl_account', array('payment_id' => $result[0]['id'], 'site' => $site, 'email' => $email, 'date' => $date, 'review' => $review));
        return 200;
    }

    function get_earning_total_array_by_users_month(&$data)
    {
        $earning_array = array(); $user_array = array();
        $result = $this->db->get_where('tbl_user', array('deleted' => 0))->result_array();
        for ($i=0; $i < count($result); $i++) { 
            if ($i == 0) {
                continue;
            }
            array_push($user_array, $result[$i]['name']);
            array_push($earning_array, $this->get_earning_total_by_user_id($result[$i]['id']));
        }
        $data = array('user' => $user_array, 'earning' => $earning_array);
    }

    function get_earning_array_by_users_month(&$data, $month)
    {
        $earning_array = array(); $user_array = array();
        $result = $this->db->get_where('tbl_user', array('deleted' => 0))->result_array();
        for ($i=0; $i < count($result); $i++) { 
            if ($i == 0) {
                continue;
            }
            array_push($user_array, $result[$i]['name']);
            array_push($earning_array, $this->get_earning_month_by_user_id($result[$i]['id'], $month));
        }
        $data = array('user' => $user_array, 'earning' => $earning_array);
    }

    function get_earning_array_by_team_month(&$data)
    {
        $month = '';
        $month_array = array(); $earning_array = array(); $earning_sum = 0;
        $this->db->order_by('date', 'ASC');
        $result = $this->db->get_where('tbl_earning', array('deleted' => 0))->result_array();
        for ($i=0; $i < count($result); $i++) { 
            $month = substr($result[$i]['date'], 0, 7); 
            if (!in_array($month, $month_array)) {
                if (count($month_array)>0) {
                    array_push($earning_array, $earning_sum);
                    $earning_sum = 0;
                }
                array_push($month_array, $month);
            }
            $earning_sum += $result[$i]['amount'];
            if ($i>0 && $i == count($result)-1) {
                array_push($earning_array, $earning_sum);
            }
        }
        $data = array('month' => $month_array, 'earning' => $earning_array);
    }

    function get_earning_array_by_user_month(&$data, $user_id)
    {
        $month = '';
        $month_array = array(); $earning_array = array(); $earning_sum = 0;
        $this->db->order_by('date', 'ASC');
        $result = $this->db->get_where('tbl_earning', array('user_id' => $user_id, 'deleted' => 0))->result_array();
        for ($i=0; $i < count($result); $i++) { 
            $month = substr($result[$i]['date'], 0, 7); 
            if (!in_array($month, $month_array)) {
                if (count($month_array)>0) {
                    array_push($earning_array, $earning_sum);
                    $earning_sum = 0;
                }
                array_push($month_array, $month);
            }
            $earning_sum += $result[$i]['amount'];
            if (($i>0 && $i == count($result)-1) || ($i==0 && count($result)==1)) {
                array_push($earning_array, $earning_sum);
            }
        }
        $data = array('month' => $month_array, 'earning' => $earning_array);
    }

    function get_earning_total_by_user_id($user_id)
    {
		$this->db->select_sum('amount');
		$this->db->from('tbl_earning');
		$this->db->where('user_id', $user_id);
		$this->db->where('deleted', 0);
	    $row = $this->db->get()->row();
	    return intval($row->amount);
    }

    function get_earning_month_by_user_id($user_id, $month)
    {
		$this->db->select_sum('amount');
		$this->db->from('tbl_earning');
		$this->db->where('user_id', $user_id);
		$this->db->where('date>=', $month.'-01');
		$this->db->where('date<=', $month.'-31');
		$this->db->where('deleted', 0);
	    $row = $this->db->get()->row();
	    return intval($row->amount);
    }

    function delete_item($table, $id)
    {
    	$this->db->where('id', $id);
    	$this->db->update($table, array('deleted' => 1));
    }

    function change_item($table, $id)
    {
    	$result = $this->db->get_where($table, array('id' => $id))->result_array();
    	$new_value = 0;
    	if ($result[0]['locked'] == 0) {
	    	$new_value = 1;
    	}
    	$this->db->where('id', $id);
    	$this->db->update($table, array('locked' => $new_value));
    }

    function get_data_by_id($table, $id, $field)
    {
    	$result = $this->db->get_where($table, array('id' => $id, 'deleted' => 0))->result_array();
    	if (count($result) > 0) {
    		return $result[0][$field];
    	}
    	return '';
    }














	function get_users(&$array)
	{
		$array = array();
		$this->db->where('deleted', 0);
		$this->db->where('character_id>', 0);
		$cur_time = time();

		$array = $this->db->get('tbl_user')->result_array();
		for ($i=0; $i < count($array); $i++) { 
			$array[$i]['time'] = date('d/m/Y h:i a', $array[$i]['created']);
			$result = $this->db->get_where('tbl_country', array('phonecode' => $array[$i]['country_code']))->result_array();
			$array[$i]['country_name'] = $result[0]['nicename'];
			$array[$i]['country_flag'] = base_url().'assets/images/flags/'.strtolower($result[0]['iso']).'.png';
			$result = $this->db->get_where('tbl_character', array('id' => $array[$i]['character_id']))->result_array();
			$array[$i]['characterr'] = $result[0]['name'];
			$array[$i]['character'] = base_url().'uploadImages/character/'.$result[0]['image'];

			if (($cur_time - $array[$i]['timestamp']) > REALTIME_PERIOD) {
				$this->db->where('id', $array[$i]['id']);
				$this->db->update('tbl_user', array('latitude' => 0, 'longitude' => 0));
			}

		}
		return 200;
	}
	function get_redeem(&$array)
	{
		$array = array();
		$array = $this->db->get_where('tbl_redeem', array('deleted' => 0))->result_array();
		for ($i=0; $i < count($array); $i++) { 
			$array[$i]['time'] = date('d/m/Y h:i a', $array[$i]['created']);
			$result = $this->db->get_where('tbl_user', array('id' => $array[$i]['user_id']))->result_array();
			$array[$i]['user'] = $result[0]['firstname'].' '.$result[0]['lastname'];
		}
		return 200;
	}
	function change_redeem($id)
	{
		$this->db->where('id', $id);
		$this->db->update('tbl_redeem', array('isread' => 1));
		return 200;
	}
	function fetch_userById($id, &$array)
	{
		$array = array();
		$array = $this->db->get_where('tbl_user', array('id' => $id))->result_array()[0];
		$array['name'] = $array['firstname'].' '.$array['lastname'];
		$result = $this->db->get_where('tbl_country', array('phonecode' => $array['country_code']))->result_array();
		$array['country_name'] = $result[0]['nicename'];
		$array['country_flag'] = base_url().'assets/images/flags/'.strtolower($result[0]['iso']).'.png';
			$result = $this->db->get_where('tbl_character', array('id' => $array['character_id']))->result_array();
			$array['characterr'] = $result[0]['name'];
			$array['character'] = base_url().'uploadImages/character/'.$result[0]['image'];

		
		$array['emergency_count'] = count($this->db->get_where('tbl_emergency', array('user_id' => $id, 'deleted' => 0))->result_array());
		$array['groups'] = '';
		$group_arr = $this->db->get_where('tbl_group', array('deleted' => 0))->result_array();
		for ($i=0; $i < count($group_arr); $i++) { 
			$member_arr = explode(",", $group_arr[$i]['members']);
			if (in_array($id, $member_arr)) {
				if ($array['groups'] == '') {
					$array['groups'] = $group_arr[$i]['name'];
				} else {
				    $array['groups'] = $array['groups'].', '.$group_arr[$i]['name'];
				}
			}			
		}
		return 200;
	}
	function update_password($id, $password, $error)
	{
 		$result = $this->db->get_where('tbl_user', array('id' => $id, 'deleted' => 0))->result_array();
		if (count($result) == 0) {
			$error = 'Invalid user!';
			return 400;
		}
		$this->db->where('id', $id);
		$this->db->update('tbl_user', array('password' => $password));
		return 200;
	}
	function getIdByEmail($email, &$out_array)
	{
 		$result = $this->db->get_where('tbl_user', array('email' => $email, 'deleted' => 0))->result_array();
		if (count($result) == 0) {
			$out_array['reason'] = 'Invalid user!';
			return 400;
		}
		if ($result[0]['isverified'] == 0) {
			$out_array['reason'] = 'Email was not verified!';
			return 400;
		}
		$out_array = $result[0];
		return 200;
	}
}

?>