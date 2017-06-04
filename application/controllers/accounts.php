<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('driver', 'account');
	}

	public function signup()
	{
		if($this->session->userdata('username'))
			redirect(base_url(), 'refresh');

		$return['notification'] = 0;
		$return['notif_trigger'] = 0;
		$return['session_store'] = 0;
		$return['title'] = 'Please sign up - ConfessNaBai!';
		$return['css'] = 'signup';
		$return['active'] = 'signup';
		$return['secret_questions'] = $this->account->get_secret_questions();

		$this->retriever('signup', $return);
	}

	public function register()
	{
		if($this->session->userdata('username'))
			redirect(base_url(), 'refresh');

		$return['css'] = 'signup';
		$return['active'] = 'signup';
		$return['session_store'] = 0;
		$mode = $this->input->post('mode');

		if(!$this->form_validation->run('signup'))
		{
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">','</div>');

			$return['notif_trigger'] = 2;
			$return['notification'] = '<a href="#errors" data-toggle="modal" class="btn btn-danger btn-md" role="button">Oh snap, errors!!</a>';

			$return['title'] = 'Oh snap! - ConfessNaBai!';

			if(!strcmp($mode, 'anon'))
				$this->retriever('signup', $return);
			else
				$this->view_users();
		}
		else
		{
			$smiley_location = base_url().'smileys/';

			$username = $this->input->post('up_username');
			$password = md5($this->input->post('up_password'));
			$question = $this->input->post('up_question');
			$answer = $this->input->post('up_answer');

			$data = array($username, $password, $question, $answer);

			$registered = $this->account->register($data);

			$uploaded_filename = $this->set_upload($registered['accounts_id']);

			$this->account->edit_user_extended_registration($registered['accounts_id'], $uploaded_filename);

			$return['notif_trigger'] = 1;
			$return['username'] = $registered['username'];
			$return['notification'] = '<a href="#success" data-toggle="modal" class="btn btn-success btn-md" role="button">Congratulations!</a>';

			$str = '<p><strong>Congratulations, '.$registered['username'].'!</strong></p>
					<p>Thank you for registering in ConfessNaBai!</p>
					<p>Please do not share your personal informations in this website. This website or the creator will not be held liable for any information leaks.</p>
					<p>Now go sign in and confess. Haha! Have fun! :)</p>';
			$return['message'] = parse_smileys($str, $smiley_location);

			$return['title'] = 'Success! - ConfessNaBai!';

			if(!strcmp($mode, 'anon'))
				$this->retriever('login', $return);
			else
				$this->view_users();
		}
	}

	private function set_upload($accounts_id, $file_name = '')
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['file_name'] = md5($accounts_id);
		$config['overwrite'] = TRUE;

		$this->upload->initialize($config);

		if(!$this->upload->do_upload('up_picture'))
			return 0;
		else
		{
			// if(!empty($file_name))
			// {
			// 	$path = set_realpath('./uploads', TRUE);
			// 	$path = substr($path, 0, -1);
			// 	echo $path.'\\'.$file_name;
			// 	unlink($path.'\\'.$file_name);
			// }

			$uploaded = $this->upload->data();
			return $uploaded['file_name'];
		}
	}

	private function retriever($view, $return)
	{
		if(!array_key_exists('total_rows', $return))
			$return['total_rows'] = 0;

		if(!array_key_exists('mode', $return))
			$return['mode'] = 0;

		$return['smiley_location'] = base_url().'smileys/';
		$return['secret_questions'] = $this->account->get_secret_questions();
		$return['id_number'] = $this->session->userdata('accounts_id');

		$this->load->view('global/header', $return);
		$this->load->view($view, $return);
		$this->load->view('global/footer');

		return 0;
	}

	public function login()
	{
		if($this->session->userdata('username'))
			redirect(base_url(), 'refresh');

		$return['notification'] = 0;
		$return['session_store'] = 0;
		$return['notif_trigger'] = 0;
		$return['notif'] = 2;
		$return['title'] = 'Sign in - ConfessNaBai!';
		$return['css'] = 'login';
		$return['active'] = 'login';

		$this->retriever('login', $return);
	}

	public function submitlogin()
	{
		if($this->session->userdata('username'))
			redirect(base_url(), 'refresh');

		$username = $this->input->post('in_username');
		$password = $this->input->post('in_password');

		$user = $this->account->check_login($username, $password);
		
		// $user['notif'] = 0	// username doesn't exist
		// $user['notif'] = 1	// login success
		// $user['notif'] = 2	// username exist but wrong password

		if($user['notif'] == 0)
		{
			$return['notification'] = anchor('#error', 'Oh snap, errors!!', array('data-toggle'=>'modal', 'class'=>'btn btn-danger btn-md', 'role'=>'button'));
			$return['notif_trigger'] = 1;
			$return['session_store'] = 0;
			$return['title'] = 'Oh snap! - ConfessNaBai!';
			$return['css'] = 'login';
			$return['active'] = 'login';
			$return['message'] = div_open(array('class'=>'alert alert-danger', 'role'=>'alert')).'Username or password error!'.div_close();;
			$this->retriever('login', $return);
		}
		else if($user['notif'] == 1)
		{
			$return['notification'] = 0;
			$return['session_store'] = 0;
			$return['title'] = 'Welcome '.$user['username'].'! - ConfessNaBai!';
			$return['css'] = 'user';
			$return['active'] = 'user';
			$return['user'] = $user;

			$this->session->set_userdata(array('mode'=>1, 'accounts_id'=>$user['accounts_id'], 'username'=>$user['username'], 'profile_picture'=>$user['profile_picture'], 'account_type'=>$user['account_type'], 'total_post'=>$user['total_post']));

			redirect(base_url(), 'refresh');
		}
		else if($user['notif'] == 2)
		{
			$return['notification'] = anchor('#error', 'Oh snap, errors!!', array('data-toggle'=>'modal', 'class'=>'btn btn-danger btn-md', 'role'=>'button'));
			$return['notif_trigger'] = 1;
			$return['session_store'] = 0;
			$return['title'] = 'Oh snap! - ConfessNaBai!';
			$return['css'] = 'login';
			$return['active'] = 'login';
			$return['message'] = div_open(array('class'=>'alert alert-danger', 'role'=>'alert')).'Account suspended!'.div_close();;
			$this->retriever('login', $return);
		}
	}

	public function logout()
	{
		if(!$this->session->userdata('username'))
			redirect(base_url(), 'refresh');

		$this->session->sess_destroy();

		redirect(base_url(), 'refresh');
	}

	public function user($user = '')
	{
		if(!strcmp($user, $this->session->userdata('username')))
			redirect(base_url(), 'refresh');
		else
		{
			$getter = $this->account->get_user_info(array('username'=>$user));

			//print_r($getter);

			if(!$getter)
				$this->search($user);
			else
			{
				$return['user_search'] = $getter[1];
				$return['session_store'] = $this->session->all_userdata();
				$return['get_follower'] = $this->account->get_count_follower($user);
				$return['notification'] = 0;
				$return['title'] = 'User, '.$user.' - ConfessNaBai!';
				$return['css'] = 'individual';
				$return['active'] = 'individual';
				$return['confessions'] = $this->account->get_confessions($getter[1][0]['id']);
				$return['total_rows'] = $this->account->get_row('posts', array('post_accounts_id'=>$getter[1][0]['id']), 1);

				//echo $getter[1][0]['id'];

				$this->retriever('individual', $return);
			}
		}
	}

	public function search($user = '')
	{
		if(!$user)
			$user = $this->input->post('in_search');

		if(!$user)
		{
			$return['searched'] = '';
			$return['session_store'] = $this->session->all_userdata();
			$return['notification'] = "Nothing to search.";
			$return['title'] = "Nothing to search - ConfessNaBai!";
			$return['css'] = 'search';
			$return['active'] = 'search';

			$this->retriever('search', $return);
		}
		else
		{
			$getter['user'] = $this->account->get_user_info(array('username'=>$user));
			$getter['group'] = $this->account->get_groups($user);

			if(!$getter['user'] && !$getter['group'] || !strcmp($user, 'admin'))
			{
				$return['searched'] = $user;
				$return['session_store'] = $this->session->all_userdata();
				$return['notification'] = "The search for '".$user."' is negative.";
				$return['title'] = "The search for ".$user." is negative - ConfessNaBai!";
				$return['css'] = 'search';
				$return['active'] = 'search';

				$this->retriever('search', $return);
			}
			else
			{
				$return['searched'] = $user;
				$return['session_store'] = $this->session->all_userdata();
				$return['notification'] = 0;
				$return['title'] = 'Search for '.$user.' - ConfessNaBai!';
				$return['css'] = 'search';
				$return['active'] = 'search';
				$return['result'] = $getter;

				$this->retriever('search', $return);
			}					
		}
	}

	public function follow($follower = '', $following = '')
	{
		if(strcmp($this->session->userdata('username'), $follower))	// checking session
			redirect(base_url(), 'refresh');

		if(!$follower || !$following)
			return 0;
		else
		{
			$result = $this->account->follow_user($follower, $following);

			$this->user($following);
		}
	}

	public function view_users()
	{
		if($this->session->userdata('account_type') != 3)	// checking session
			redirect(base_url(), 'refresh');

		$users = $this->account->view_users();

		$return['users'] = $users;
		$return['session_store'] = $this->session->all_userdata();
		$return['notification'] = 0;
		$return['title'] = 'ConfessNaBai!';
		$return['css'] = 'view_users';
		$return['active'] = 'admin_mode';

		//echo count($users);

		$this->retriever('view_users', $return);
	}

	public function actions($action = '', $accounts_id = '')
	{
		if($this->session->userdata('account_type') != 3)	// checking session
			redirect(base_url(), 'refresh');

		if($action == 1)							// edit
		{
			$this->update($accounts_id);
		}
		else if($action == 2)						// delete
		{
			$this->account->actions($action, $accounts_id);

			redirect('accounts/view_users', 'refresh');
		}
		else if($action == 3)						// suspend
		{
			$this->account->actions($action, $accounts_id);

			redirect('accounts/view_users', 'refresh');
		}
		else;
	}

	public function update($username = '', $return = '')
	{
		if($this->session->userdata('account_type') != 3)	// checking session
		{
			if(strcmp($this->session->userdata('username'), $username))
				redirect(base_url(), 'refresh');
		}

		if(!$return)
		{
			$user_info = $this->account->get_user_info(array('username'=>$username));

			$return['session_store'] = $this->session->all_userdata();
			$return['get_follower'] = $this->account->get_count_follower($username);
			$return['notification'] = 0;
			$return['title'] = 'Update - '.$username.'! - ConfessNaBai!';
			$return['css'] = 'user';
			$return['active'] = 'user';
			$return['group_id'] = 1;
			$return['total_rows'] = $this->account->get_row('posts', array('post_accounts_id'=>$user_info[1][0]['id']));
			$return['username'] = $username;
			$return['profile_picture'] = $user_info[1][0]['profile_picture'];
			$return['question'] = $user_info[1][0]['secret_question'];
		}
		
		//print_r($return);

		$this->retriever('update', $return);
	}

	public function submit_update($usernames = '')			// check session
	{
		if($this->session->userdata('account_type') != 3)	// checking session
		{
			if(strcmp($this->session->userdata('username'), $usernames))
				redirect(base_url(), 'refresh');
		}

		$return['session_store'] = $this->session->all_userdata();
		$return['active'] = 'user';
		$return['css'] = 'user';

		$username = $this->input->post('up_username');
		$pass = $this->input->post('up_password');
		$passcon = $this->input->post('up_confirm_password');
		$answer = $this->input->post('up_answer');

		$user_info = $this->account->get_user_info(array('username'=>$usernames));

		$un_id = $user_info[1][0]['id'];
		$un_username = $user_info[1][0]['username'];
		$un_password = $user_info[1][0]['password'];
		$un_profpict = $user_info[1][0]['profile_picture'];
		$un_question = $user_info[1][0]['secret_question'];
		$un_secret_question_answer = $user_info[1][0]['secret_question_answer'];

		if($this->account->get_row('accounts', array('username'=>$username), 1))	// if new username is existing, no reason to proceed.
		{
			$return['total_rows'] = $this->account->get_row('posts', array('post_accounts_id'=>$un_id));
			$return['question'] = $un_question;
			$return['profile_picture'] = $un_profpict;
			$return['get_follower'] = $this->account->get_count_follower($un_username);
			$return['username'] = $un_username;
			$return['notification'] = '<div class="alert alert-danger" role="alert"><center><strong>Username</strong> existing!!</center></div>';
			$this->retriever('update', $return);
			return 0;
		}

		$counter = 0;

		if(empty($username))
		{
			$username = $un_username;
			$counter++;
		}

		if(empty($pass))
		{
			$pass = $un_password;
			$passcon = $un_password;
			$counter++;
		}
		else
		{
			$pass = md5($pass);
			$passcon = md5($passcon);
		}

		//echo $un_id;
		$upload = 0;
		$upload = $this->set_upload($un_id, $un_profpict);
		//echo $upload;

		if(!$upload)	// upload the file. if function called returns 0, no file selected.
		{
			$upload = $un_profpict;
			$counter++;
		}

		//echo $username;
		//echo $counter;

		if($counter > 2)
		{
			$return['total_rows'] = $this->account->get_row('posts', array('post_accounts_id'=>$un_id));
			$return['question'] = $un_question;
			$return['profile_picture'] = $un_profpict;
			$return['get_follower'] = $this->account->get_count_follower($un_username);
			$return['username'] = $un_username;
			$return['notification'] = '<div class="alert alert-danger" role="alert"><center><strong>Fields</strong> are empty!!</center></div>';
			$this->retriever('update', $return);
		}
		else if($this->session->userdata('account_type') != 3)
		{
			$return['total_rows'] = $this->account->get_row('posts', array('post_accounts_id'=>$un_id));
			$return['question'] = $un_question;
			$return['profile_picture'] = $un_profpict;
			$return['get_follower'] = $this->account->get_count_follower($un_username);
			if(!strcmp($answer, $un_secret_question_answer))
			{
				if(!strcmp($pass, $passcon))
				{
					$this->account->update_account($un_username, array('username'=>$username, 'password'=>$pass, 'profile_picture'=>$upload), 1);
					$return['username'] = $username;
					$return['notification'] = '<div class="alert alert-success" role="alert"><center><strong>Success!!</strong> Please reload...</center></div>';
					redirect(base_url(), 'refresh');
				}
				else
				{
					$return['title'] = 'Update failed - '.$un_username;
					$return['username'] = $un_username;
					$return['notification'] = '<div class="alert alert-danger" role="alert"><center><strong>Password</strong> does not match!!</center></div>';
					$this->retriever('update', $return);
				}
			}
			else
			{
				$return['title'] = 'Update failed - '.$un_username;
				$return['username'] = $un_username;
				$return['notification'] = '<div class="alert alert-danger" role="alert"><center><strong>Answer</strong> is incorrect!!</center></div>';
				$this->retriever('update', $return);
			}
		}
		else
		{
			$return['total_rows'] = $this->account->get_row('posts', array('post_accounts_id'=>$un_id));
			$return['question'] = $un_question;
			$return['profile_picture'] = $un_profpict;
			$return['get_follower'] = $this->account->get_count_follower($un_username);

			if(!strcmp($pass, $passcon))
			{
				if(!strcmp($un_username, $this->session->userdata('username')))
				{
					$this->account->update_account($un_username, array('username'=>$username, 'password'=>$pass, 'profile_picture'=>$upload), 1);
					$return['username'] = $username;
					$return['notification'] = '<div class="alert alert-success" role="alert"><center><strong>Success!!</strong> Please reload...</center></div>';
					redirect(base_url(), 'refresh');
				}
				else
				{
					$this->account->update_account($un_username, array('username'=>$username, 'password'=>$pass, 'profile_picture'=>$upload));
					$return['username'] = $username;
					$return['notification'] = '<div class="alert alert-success" role="alert"><center><strong>Success!!</strong> Please reload...</center></div>';
					redirect(base_url(), 'refresh');
				}
			}
			else
			{
				$return['title'] = 'Update failed - '.$un_username;
				$return['username'] = $un_username;
				$return['notification'] = '<div class="alert alert-danger" role="alert"><center><strong>Password</strong> does not match!!</center></div>';
				$this->retriever('update', $return);
			}
		}
	}

	public function view_idols($md5_id = '', $num_follow = '')
	{
		if(strcmp($md5_id, md5($this->session->userdata('accounts_id'))) || !$num_follow)
			redirect(base_url(), 'refresh');

		$return['session_store'] = $this->session->all_userdata();
		$return['active'] = 'user';
		$return['css'] = 'user';
		$return['get_follower'] = $this->account->get_count_follower($this->session->userdata('username'));
		$return['total_rows'] = $this->account->get_row('posts', array('post_accounts_id'=>$this->session->userdata('accounts_id')));
		$return['title'] = 'View post of idols - '.$this->session->userdata('username');

		$return['follow_info'] = $this->account->get_following_info($this->session->userdata('accounts_id'));

		for($x=0; $x<count($return['follow_info']); $x++)
		{
			$ids[$x] = $return['follow_info'][$x]['accounts_id'];
			$usernames[$x] = $return['follow_info'][$x]['username'];
		}
		//print_r($ids);

		$posts = $this->account->get_following_post($ids, $usernames);
		$return['confessions'] = $posts;

		//print_r($posts);

		// print_r($get_following_info);

		$this->retriever('idols', $return);
	}
}
/* End of file accounts.php */
/* Location: ./application/controllers/accounts.php */