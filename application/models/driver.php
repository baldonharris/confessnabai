<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Driver extends CI_Model
{
	public function get_secret_questions()
	{
		$query = $this->db->get('secret_questions');

		$question = array();
		foreach($query->result() as $questions)
			$question[$questions->secret_questions_id] = $questions->questions;

		return $question;
	}

	public function register($data)
	{
		$fields = $this->db->list_fields('accounts');

		$insert = array();

		for($y=0; $y<count($fields); $y++)
			$insert[$fields[$y]] = '';

		for($x=0; $x<count($data); $x++)
			$insert[$fields[$x+1]] = $data[$x];

		$insert['account_type'] = 2;
		$insert['account_status'] = 1;

		$this->db->insert('accounts', $insert);

		// get accounts_id for uploading purposes
		$result = $this->get_user_info(array('username'=>$insert['username']));
		$account_info = $result[0]->result_array();
		// end

		return array('username'=>$account_info[0]['username'], 'accounts_id'=>$account_info[0]['accounts_id']);
	}

	public function get_user_info($key = '') // array should be passed 'column'=>'key'
	{										 // to access info, index [1][0][''] should be used.
		$query = $this->db->query("SELECT * FROM accounts WHERE username LIKE '%".$this->db->escape_like_str($key['username'])."%'");

		if(!$query->num_rows())
			return 0;
		else
		{
			$x = 0;
			foreach($query->result_array() as $user)
			{
				$user_search[$x]['id'] = $user['accounts_id'];
				$user_search[$x]['password'] = $user['password'];
				$user_search[$x]['username'] = $user['username'];
				$user_search[$x]['profile_picture'] = $user['profile_picture'];
				$user_search[$x]['total_post'] = $user['total_post'];
				$user_search[$x]['account_status'] = $user['account_status'];
				$user_search[$x]['secret_questions_id'] = $user['secret_questions_id'];
				$user_search[$x]['secret_question_answer'] = $user['secret_question_answer'];
				
				$id = $user_search[$x]['secret_questions_id'];

				$query_1 = $this->db->get_where('secret_questions', array('secret_questions_id'=>$id));

				foreach($query_1->result_array() as $q)
				{
					$user_search[$x]['secret_question'] = $q['questions'];
				}

				$x++;
			}

			// $query->free_result();
			// echo $this->db->last_query();
			// echo print_r($query);
			return array($query, $user_search);
		}
	}

	public function edit_user_extended_registration($accounts_id, $uploaded_filename)
	{
		$this->db->where('accounts_id', $accounts_id);
		$this->db->update('accounts', array('profile_picture'=>$uploaded_filename));
	}

	public function get_users_info_by($data = '')
	{
		$this->db->select('*');
		$this->db->from('accounts');
		$this->db->order_by($data, 'desc');
		$this->db->limit(5);

		return $query = $this->db->get();
	}

	public function check_login($username = '', $password = '')
	{
		$query = $this->db->get_where('accounts', array('username'=>$username));

		if(!$query->num_rows())
		{
			$query->free_result();
			return array('notif'=>0);		// no username found in db_table
		}
		else
		{
			foreach($query->result_array() as $user)
			{
				$user_accounts_id = $user['accounts_id'];
				$user_username = $user['username'];
				$user_password = $user['password'];
				$user_profile_picture = $user['profile_picture'];
				$user_account_type = $user['account_type'];
				$user_total_post = $user['total_post'];
				$user_account_status = $user['account_status'];
			}

			if(!strcmp($user_password, md5($password)))	// login success
			{
				$query->free_result();
				if($user_account_status == 1)
					return array('accounts_id'=>$user_accounts_id, 'username'=>$user_username, 'profile_picture'=>$user_profile_picture, 'account_type'=>$user_account_type, 'total_post'=>$user_total_post, 'notif'=>1);
				else
					return array('notif'=>2);			// account suspended
			}
			else
			{
				$query->free_result();
				return array('notif'=>0);		// wrong password
			}
		}
	}

	public function get_categories()
	{
		$query = $this->db->get('category');

		$category = array();
		foreach($query->result() as $category_me)
			$category[$category_me->category_id] = ucwords($category_me->category);

		$query->free_result();

		//print_r($category);
		return $category;
	}

	public function get_groups($where = '', $mode = 0)
	{
		if(!$where)
			$query = $this->db->get('groups');
		else
		{
			if(!$mode)
			{
				$query = $this->db->query("SELECT * FROM groups WHERE group_name LIKE '%".$this->db->escape_like_str($where)."%'");
			}
			else
			{
				$query = $this->db->get_where('groups', array('group_id'=>$where));
			}
		}
		

		$groups = array();
		$z=0;
		foreach($query->result() as $group_me)
		{
			$groups['group_name'][$z] = $group_me->group_name;
			$groups['group_index'][$z] = $group_me->group_id;
			$groups['group_admin_id'][$z] = $group_me->group_accounts_id_admin;
			$query_again = $this->db->get_where('accounts', array('accounts_id'=>$group_me->group_accounts_id_admin));

			if(!$query_again->num_rows())
				$groups['group_admin'][$z] = 'None';
			else
			{
				foreach($query_again->result() as $admin_me)
					$admin = $admin_me->username;

				$groups['group_admin'][$z] = $admin;
			}
			$z++;
		}

		$query->free_result();

		return $groups;
	}

	public function add_group($group)				
	{
		$group_name = $group['group_name'];
		$group_admin = $group['group_admin'];

		$query = $this->db->get_where('accounts', array('username'=>$group_admin));

		$insert = array();
		foreach($query->result() as $admin_to_be)
			$insert['group_accounts_id_admin'] = $admin_to_be->accounts_id;

		$insert['group_id'] = '';
		$insert['group_name'] = ucwords($group_name);

		$this->db->insert('groups', $insert);

		$query->free_result();

		$accounts_id = $insert['group_accounts_id_admin'];
		$this->db->where('accounts_id', $accounts_id);
		$this->db->update('accounts', array('account_type'=>2));
	}

	public function follow_user($follower, $following)
	{
		$query_follower = $this->db->get_where('accounts', array('username'=>$follower));

		foreach($query_follower->result() as $follower_username)
			$follower_id = $follower_username->accounts_id;

		$query_following = $this->db->get_where('accounts', array('username'=>$following));

		foreach($query_following->result() as $following_username)
			$following_id = $following_username->accounts_id;
		
		$insert = array(
				'followers_id'=>'',
				'user_accounts_id' => $following_id,
				'followers_accounts_id' => $follower_id
			);

		$query = $this->db->insert('followers', $insert);

		return 1;
	}

	public function get_count_follower($username = '')
	{
		//echo $username;
		$query = $this->db->get_where('accounts', array('username'=>$username));

		foreach($query->result() as $getme)
			$username_id = $getme->accounts_id;

		$query->free_result();

		$query = '';
		$getme = '';
		$query = $this->db->get_where('followers', array('user_accounts_id'=>$username_id));
		$query_me = $this->db->get_where('followers', array('followers_accounts_id'=>$username_id));

		$follower_id[0] = 0;
		$x = 1;
		foreach($query->result() as $getme)
		{
			$follower_id[$x] = $getme->followers_accounts_id;
			$x++;
		}

		$total_followers = $query->num_rows();
		$total_following = $query_me->num_rows();

		return array('num_follower'=>$total_followers, 'follower_id'=>$follower_id, 'num_following'=>$total_following);
	}

	public function get_row($table = '', $array_where = '', $mode = 0)
	{
		if(empty($table))
			return 0;
		else
		{
			//echo $table;
			//print_r($array_where);

			if(!$array_where)
				$query = $this->db->get($table);
			else
				$query = $this->db->get_where($table, $array_where);
		}

		if(!$mode)
			return $query->num_rows()+1;
		else
			return $query->num_rows();
	}

	public function get_specific_confession($post_id = '')
	{
		$this->db->order_by('posts_id', 'desc');
		$query = $this->db->get('posts');

		if(!$query->num_rows())
			return 0;

		$post_me = array();
		$x = 0;
		foreach($query->result() as $post)
		{
			$post_me[$x] = $post->posts_id;
			$x++;
		}

		for($y=0; $y<$x; $y++)
		{
			if(!strcmp(md5($post_me[$y]), $post_id))
			{
				$post_id = $post_me[$y];
				break;
			}
		}

		$query->free_result();

		$query = $this->db->get_where('posts', array('posts_id'=>$post_id));

		foreach($query->result() as $c)
		{
			$confession['posts_id'] = $c->posts_id;
			$confession['post'] = $c->post;
			$confession['post_accounts_id'] = $c->post_accounts_id;
			$confession['group_id'] = $c->group_id;
			$confession['category_id'] = $c->category;
			$confession['time_stamp'] = $c->time_stamp;
			$confession['with_picture'] = $c->with_picture;
			$confession['file_name'] = $c->file_name;
		}

		$query->free_result();

		$accounts_id = $confession['post_accounts_id'];

		if(!$accounts_id)
		{
			$confession['username'] = 'anonymous';
			$confession['profile_picture'] = 'default.jpg';
		}
		else
		{
			$query = $this->db->get_where('accounts', array('accounts_id'=>$accounts_id));

			foreach($query->result() as $a)
			{
				$confession['username'] = $a->username;
				$confession['profile_picture'] = $a->profile_picture;
			}

			$query->free_result();
		}

		$group_id = $confession['group_id'];

		$query = $this->db->get_where('groups', array('group_id'=>$group_id));

		foreach($query->result() as $g)
		{
			$confession['group_name'] = $g->group_name;
		}

		$query->free_result();

		$category_id = $confession['category_id'];

		$query = $this->db->get_where('category', array('category_id'=>$category_id));

		foreach($query->result() as $cat)
		{
			$confession['category_name'] = ucfirst($cat->category);
		}

		$query->free_result();

		return $confession;
	}

	public function get_comments_of_post($posts_id = '')
	{
		if(!$posts_id)
			return 0;
		else
		{
			$this->db->order_by('posts_id', 'desc');
			$query = $this->db->get('posts');

			if(!$query->num_rows())
				return 0;

			$post_me = array();
			$x = 0;
			foreach($query->result() as $post)
			{
				$post_me[$x] = $post->posts_id;
				$x++;
			}

			for($y=0; $y<$x; $y++)
			{
				if(!strcmp(md5($post_me[$y]), $posts_id))
				{
					$posts_id = $post_me[$y];
					break;
				}
			}

			$query->free_result();

			$query = $this->db->get_where('comments', array('posts_id'=>$posts_id));

			if(!$query->num_rows())
				return 0;
			else
			{
				$x = 0;
				foreach($query->result() as $result)
				{
					$comment['comment'][$x] = $result->comment;
					$comment['time_stamp'][$x] = $result->time_stamp;
					$comment['accounts_id'][$x] = $result->user_accounts_id;

					$accounts_id = $comment['accounts_id'][$x];

					if(!$accounts_id)
					{
						$comment['username'][$x] = 'anonymous';
						$comment['profile_picture'][$x] = 'default.jpg';
					}
					else
					{
						$query_account = $this->db->get_where('accounts', array('accounts_id'=>$accounts_id));

						foreach($query_account->result() as $result_account)
						{
							$comment['username'][$x] = $result_account->username;
							$comment['profile_picture'][$x] = $result_account->profile_picture;
						}
						$query_account->free_result();
					}
					
					$x++;
				}

				return $comment;
			}
		}
	}

	public function get_confessions($accounts_id = '', $mode = '', $group = '', $limit = '')
	{
		$groups = $this->get_groups();
		$category = $this->get_categories();
		$users = $this->db->get('accounts');

		if(!$limit)
			$limit = 0;

		$a=0;
		foreach($users->result() as $user)
		{
			$userinfo['accounts_id'][$a] = $user->accounts_id;
			$userinfo['username'][$a] = $user->username;
			$userinfo['profile_picture'][$a] = $user->profile_picture;
			$a++;
		}

		$category_id = array_keys($category);

		if($mode == 1)
		{
			$key = array_search(ucwords($accounts_id), $category);
			$this->db->order_by('posts_id', 'desc');
			if(!$group)
				$query = $this->db->get_where('posts', array('category'=>$key), 10 , $limit);
			else
				$query = $this->db->get_where('posts', array('group_id'=>$group), 10, $limit);
		}
		else
		{
			$this->db->order_by('posts_id', 'desc');
			if(!$accounts_id)
				$query = $this->db->get('posts', 10, $limit);
			else
				$query = $this->db->get_where('posts', array('post_accounts_id'=>$accounts_id), 10, $limit);
		}

		if(!$query->num_rows)
			return 0;

		$confession = array();
		$x = 0;
		foreach($query->result() as $getter)
		{
			$confession['post_accounts_id'][$x] = $getter->post_accounts_id;
			$confession['posts_id'][$x] = $getter->posts_id;

			if(!$confession['post_accounts_id'][$x])
			{
				$confession['username'][$x] = 'anonymous';
				$confession['profile_picture'][$x] = 'default.jpg';
			}
			else
			{
				for($p=0; $p<count($userinfo['accounts_id']); $p++)
				{
					if($confession['post_accounts_id'][$x] == $userinfo['accounts_id'][$p])
					{
						$confession['username'][$x] = $userinfo['username'][$p];
						$confession['profile_picture'][$x] = $userinfo['profile_picture'][$p];
					}
				}
			}

			$confession['confession'][$x] = $getter->post;
			$confession['group'][$x] = $getter->group_id;
			$confession['with_picture'][$x] = $getter->with_picture;
			$confession['file_name'][$x] = $getter->file_name;

			for($y=0; $y<count($groups['group_index']); $y++)
			{
				if($confession['group'][$x] == $groups['group_index'][$y])
					$confession['group'][$x] = $groups['group_name'][$y];
			}
			
			$confession['category'][$x] = $getter->category;


			if(!$confession['category'][$x])
				$confession['category'][$x] = 'Unknown';
			else
				$confession['category'][$x] = $category[$confession['category'][$x]];

			$confession['time_stamp'][$x] = $getter->time_stamp;
			$x++;
		}
		//print_r($confession['category']);
		return $confession;
	}

	public function increment_post($username)
	{
		$query_get_id = $this->db->get_where('accounts', array('username'=>$username));

		foreach($query_get_id->result() as $getter)
		{
			$accounts_id = $getter->accounts_id;
		}

		$query_get_id->free_result();

		$query = $this->db->get_where('posts', array('post_accounts_id'=>$accounts_id));

		$total_post = $query->num_rows();

		$query->free_result();

		$this->db->where('accounts_id', $accounts_id);
		$this->db->update('accounts', array('total_post'=>$total_post));
	}

	public function view_users()
	{
		$query = $this->db->get('accounts');

		$x=0;
		foreach($query->result() as $getter)
		{
			$user[$x]['accounts_id'] = $getter->accounts_id;
			$user[$x]['username'] = $getter->username;
			$user[$x]['secret_questions_id'] = $getter->secret_questions_id;
			$user[$x]['secret_question_answer'] = $getter->secret_question_answer;
			$user[$x]['profile_picture'] = $getter->profile_picture;
			$user[$x]['account_type'] = $getter->account_type;
			$user[$x]['total_post'] = $getter->total_post;
			$user[$x]['account_status'] = $getter->account_status;

			$x++;
		}

		return $user;
	}

	public function actions($action = '', $accounts_id = '')		// check session
	{
		if($action == 1)							// edit
		{

		}
		else if($action == 2)						// delete
		{
			$this->db->delete('accounts', array('accounts_id'=>$accounts_id));
			$this->db->delete('posts', array('post_accounts_id'=>$accounts_id));
			$this->db->delete('followers', array('user_accounts_id'=>$accounts_id));
			$this->db->delete('followers', array('followers_accounts_id'=>$accounts_id));

			return 1;
		}
		else if($action == 3)						// suspend
		{
			$query = $this->db->get_where('accounts', array('accounts_id'=>$accounts_id));

			foreach($query->result() as $getter)
			{
				$account_status = $getter->account_status;
			}

			if($account_status == 1)
			{
				$this->db->where('accounts_id', $accounts_id);
				$this->db->update('accounts', array('account_status'=>2));
			}
			else
			{
				$this->db->where('accounts_id', $accounts_id);
				$this->db->update('accounts', array('account_status'=>1));
			}
		}
		else;
	}

	public function get_id($table = '', $where = '', $category_id = '')
	{
		if(!$where)
			$query = $this->db->get($table);
		else
			$query = $this->db->get_where($table, $where);

		foreach($query->result() as $get_id)
		{
			$got_id = $get_id->$category_id;
		}

		return $got_id;
	}

	public function deletepost($post_id = '')
	{
		if(!$post_id)
			return 0;
		else
		{
			$query = $this->db->get_where('posts', array('posts_id'=>$post_id));

			foreach($query->result() as $getme)
			{
				$confirm = $getme->with_picture;
				$post = $getme->file_name;
				$accounts_id = $getme->post_accounts_id;
			}

			if($confirm)
			{
				$path = set_realpath('.\uploads_posts', TRUE);
				unlink($path.$post);
			}

			$this->db->delete('posts', array('posts_id'=>$post_id));

			$query_1 = $this->db->get_where('posts', array('post_accounts_id'=>$accounts_id));

			$num_rows = $query_1->num_rows();

			$this->db->where('accounts_id', $accounts_id);
			$this->db->update('accounts', array('total_post'=>$num_rows));
		}
	}

	public function add_category($new_category = '')
	{
		if(!$new_category)
		{
			;
		}
		else
		{
			$this->db->insert('category', array('category'=>$new_category));
		}
	}

	public function update_account($username = '', $values = '', $mode = 0)
	{
		if(!$values)
			return 0;
		else
		{
			$this->db->where('username', $username);
			$this->db->update('accounts', $values);

			if($mode)
			{
				$new_username = $values['username'];
				$new_profile_picture = $values['profile_picture'];

				$sessions = $this->session->all_userdata();

				if(!$new_profile_picture)
					$sessions['username'] = $new_username;
				else
				{
					$sessions['username'] = $new_username;
					$sessions['profile_picture'] = $new_profile_picture;
				}

				$this->session->set_userdata($sessions);
			}
		}
	}

	public function get_following_info($id = '')
	{
		if(!$id)
			return 0;
		else
		{
			$this->db->order_by('followers_id', 'desc');
			//$this->db->limit(5);
			$query = $this->db->get_where('followers', array('followers_accounts_id'=>$id));

			if(!$query->num_rows())
				return 0;
			else
			{
				$x=0;
				foreach($query->result() as $account_id)
				{
					$return[$x]['accounts_id'] = $account_id->user_accounts_id;

					$query_me = $this->db->get_where('accounts', array('accounts_id'=>$return[$x]['accounts_id']));
					
					foreach($query_me->result() as $info)
					{
						$return[$x]['username'] = $info->username;
						$return[$x]['profile_picture'] = $info->profile_picture;
						$return[$x]['total_post'] = $info->total_post;
					}

					$x++;
				}
				return $return;
			}
		}
	}

	public function get_following_post($id = '', $usernames = '')
	{
		$this->db->order_by('posts_id', 'desc');
		$this->db->where_in('post_accounts_id', $id);
		$query = $this->db->get('posts');

		$groups = $this->get_groups(NULL, 1);

		$x=0;
		foreach($query->result() as $posts)
		{
			$confession[$x]['confession'] = $posts->post;
			for($y=0; $y<count($id); $y++)
			{
				if($id[$y] == $posts->post_accounts_id)
				{
					$confession[$x]['username'] = $usernames[$y];
					break;
				}
			}
			$confession[$x]['group'] = $groups['group_name'][$posts->group_id-1];
			$confession[$x]['file_name'] = $posts->file_name;
			$confession[$x]['posts_id'] = $posts->posts_id;
			$confession[$x]['category'] = $posts->category;

			$query_me = $this->db->get_where('accounts', array('username'=>$confession[$x]['username']));

			foreach($query_me->result() as $getme)
			{
				$confession[$x]['profile_picture'] = $getme->profile_picture;
			}

			$query_you = $this->db->get_where('category', array('category_id'=>$confession[$x]['category']));

			foreach($query_you->result() as $getyou)
			{
				$confession[$x]['category'] = $getyou->category;
			}

			$x++;
		}

		return $confession;
	}
}	// end class Driver

/* End of file driver.php */
/* Location: ./application/models/driver.php */