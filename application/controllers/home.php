<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('driver', 'account');
	}

	public function index()
	{
		if(!$this->check_session())
		{
			$this->session->set_userdata(array('mode'=>0, 'username'=>NULL, 'accounts_id'=>NULL, 'profile_picture'=>NULL));
			
			$smiley_location = base_url().'smileys/';

			$image_array = get_clickable_smileys($smiley_location, 'confess');

			$tmpl = array('table_open'=>'<table class="table">');

			$col_array = $this->table->make_columns($image_array, 8);
			$this->table->set_template($tmpl);

			$return['smiley_table'] = $this->table->generate($col_array);

			$return['session_store'] = $this->session->all_userdata();
			$return['notification'] = 0;
			$return['title'] = 'Welcome to ConfessNaBai! - Your secrets, our treasure';
			$return['css'] = 'index';
			$return['active'] = 'index';
			$return['top_users'] = $this->account->get_users_info_by('total_post');
			$return['users'] = $this->account->get_users_info_by('accounts_id');
			$return['secret_questions'] = $this->account->get_secret_questions();
			$return['category'] = $this->account->get_categories();
			$return['group_id'] = 1;

			$this->retriever('index', $return);
		}
		else
		{
			$smiley_location = base_url().'smileys/';

			$image_array = get_clickable_smileys($smiley_location, 'confess');

			$tmpl = array('table_open'=>'<table class="table">');

			$col_array = $this->table->make_columns($image_array, 8);
			$this->table->set_template($tmpl);

			$return['smiley_table'] = $this->table->generate($col_array);

			$return['session_store'] = $this->session->all_userdata();
			$return['get_follower'] = $this->account->get_count_follower($this->session->userdata('username'));
			$return['notification'] = 0;
			$return['title'] = 'Welcome, '.$return['session_store']['username'].'! - ConfessNaBai!';
			$return['css'] = 'user';
			$return['active'] = 'user';
			$return['category'] = $this->account->get_categories();
			$return['group'] = $this->account->get_groups();
			$return['confessions'] = $this->account->get_confessions($this->session->userdata('accounts_id'), 0, 0, 0);
			$return['group_id'] = 1;
			$return['total_rows'] = $this->account->get_row('posts', array('post_accounts_id'=>$this->session->userdata('accounts_id')));
			//$return['following_confessions'] = 

			//print_r($return['group']);

			$this->retriever('user', $return);
		}
	}

	public function global_anon($mode = '')
	{
		$smiley_location = base_url().'smileys/';

		$image_array = get_clickable_smileys($smiley_location, 'confess');

		$tmpl = array('table_open'=>'<table class="table">');

		$col_array = $this->table->make_columns($image_array, 8);
		$this->table->set_template($tmpl);

		$return['smiley_table'] = $this->table->generate($col_array);

		$return['notification'] = 0;
		$return['session_store'] = $this->session->all_userdata();
		$return['title'] = 'Fun starts here! - ConfessNaBai!';
		$return['css'] = 'anon';
		if($mode)
			$return['active'] = $mode;
		else
			$return['active'] = 'anon';
		$return['group_id'] = 1;
		$return['category'] = $this->account->get_categories();
		$return['group'] = $this->account->get_groups();
		$return['confessions'] = $this->account->get_confessions();
		$return['total_rows'] = $this->account->get_row('posts');

		$this->retriever('anon', $return);
	}

	public function add_group()
	{
		if(!$this->check_session())
			redirect(base_url(), 'refresh');
		else
		{
			$group_name = $this->input->post('up_group_name');
			$group_admin = $this->input->post('group_admin');

			$group = array();

			$group['group_name'] = $group_name;
			$group['group_admin'] = $group_admin;

			$group = $this->account->add_group($group);

			redirect(base_url(), 'refresh');
		}
	}

	public function category($category = '', $mode = 0)
	{
		if(!$category)
		{
			// go to global group
		}
		else
		{
			$smiley_location = base_url().'smileys/';

			$image_array = get_clickable_smileys($smiley_location, 'confess');

			$tmpl = array('table_open'=>'<table class="table">');

			$col_array = $this->table->make_columns($image_array, 8);
			$this->table->set_template($tmpl);

			$return['smiley_table'] = $this->table->generate($col_array);

			$return['notification'] = 0;
			$return['session_store'] = $this->session->all_userdata();
			$return['title'] = 'Fun starts here! - ConfessNaBai!';
			$return['css'] = 'category';
			$return['active'] = 'category';
			$return['get_follower'] = $this->account->get_count_follower($this->session->userdata('username'));
			$return['category'] = $this->account->get_categories();
			$return['category_id'] = array_search(ucwords($category), $return['category']);
			$return['group'] = $this->account->get_groups();
			$return['confessions'] = $this->account->get_confessions($category, $mode);
			$return['mode'] = $mode;
			$return['active_category'] = $category;
			$return['category_id'] = $this->account->get_id('category', array('category'=>$category), 'category_id');
			$return['total_rows'] = $this->account->get_row('posts', array('category'=>$this->account->get_id('category', array('category'=>$category), 'category_id')));

			$this->retriever('category', $return);
		}
	}

	public function groups($group_id = '', $category = 0)
	{
		$group_id = explode("_", $group_id);
		$group_id = $group_id[1];

		if($group_id == 1)
			$this->global_anon(0);
		else
		{
			$group_me = $this->account->get_groups($group_id, 1);

			$smiley_location = base_url().'smileys/';

			$image_array = get_clickable_smileys($smiley_location, 'confess');

			$tmpl = array('table_open'=>'<table class="table">');

			$col_array = $this->table->make_columns($image_array, 8);
			$this->table->set_template($tmpl);

			$return['smiley_table'] = $this->table->generate($col_array);
			$return['session_store'] = $this->session->all_userdata();

			if(!$this->session->userdata('username'))
				$return['css'] = 'anon';
			else
				$return['css'] = 'group';
			
			$return['title'] = 'Group: '.$group_me['group_name'][0];
			$return['group_name'] = $group_me['group_name'][0];
			$return['group_admin'] = $group_me['group_admin'][0];
			$return['group_admin_id'] = $group_me['group_admin_id'][0];
			$return['category'] = $this->account->get_categories();
			$return['total_rows'] = $this->account->get_row('posts', array('group_id'=>$group_id));
			$return['confessions'] = $this->account->get_confessions(0, 1, $group_id);
			$return['group'] = $this->account->get_groups();
			$return['group_id'] = $group_id;
			$return['active'] = 'group';

			$this->retriever('group', $return);
		}
	}

	public function comment_post($post_id = '', $username = '')
	{
		$smiley_location = base_url().'smileys/';

		$image_array = get_clickable_smileys($smiley_location, 'comment');

		$tmpl = array('table_open'=>'<table class="table">');

		$col_array = $this->table->make_columns($image_array, 8);
		$this->table->set_template($tmpl);

		$return['smiley_table'] = $this->table->generate($col_array);

		$return['confession'] = $this->account->get_specific_confession($post_id);
		$return['comment'] = $this->account->get_comments_of_post($post_id);
		$return['notification'] = 0;
		$return['title'] = 'Commenting '.$return['confession']['post'];
		$return['session_store'] = $this->session->all_userdata();

		if(!$this->session->userdata('username'))
		{
			$return['username'] = 'anonymous';
			$return['css'] = 'anon';
		}
		else
		{
			$return['username'] = $this->session->userdata('username');
			$return['css'] = 'group';
		}

		$return['active'] = 'comment';

		$this->retriever('comment', $return);
	}

	public function deletepost($post_id = '', $current_url = '')	// check session
	{
		if(!$current_url)
			$current_url = base_url();
		else
		{
			$current_url = base64_decode($current_url.'==');
		}
			

		$this->account->deletepost($post_id);
		redirect($current_url, 'refresh');
	}

	public function add_category()
	{
		if($this->session->userdata('account_type') != 3)	// checking session
			redirect(base_url(), 'refresh');

		$new_category = $this->input->post('add_category');
		$this->account->add_category($new_category);
		redirect('accounts/view_users/', 'refresh');
	}

	private function check_session()
	{
		if(!$this->session->userdata('mode') && !$this->session->userdata('username') && !$this->session->userdata('account_id'))
			return 0;
		else if($this->session->userdata('mode') || !$this->session->userdata('mode') && $this->session->userdata('username') && $this->session->userdata('account_id'))
			return 1;
	}

	private function retriever($view, $return)
	{
		$return['smiley_location'] = base_url().'smileys/';
		$return['id_number'] = $this->session->userdata('accounts_id');

		if(!array_key_exists('total_rows', $return))
			$return['total_rows'] = 0;

		if(!array_key_exists('mode', $return))
			$return['mode'] = 0;

		if(!strcmp($view, 'index'))
		{
			if($this->check_session())
				$this->load->view('global/header', $return);
			else
				$this->load->view('global/header_index', $return);
			$this->load->view($view, $return);
			$this->load->view('global/footer');

			return 0;
		}
		else
		{
			$this->load->view('global/header', $return);
			$this->load->view($view, $return);
			$this->load->view('global/footer');

			return 0;
		}
	}

	public function try_me()
	{
		$string = current_url();

		$string = substr(base64_encode($string), 0, -1);

		echo strlen($string).'<br>';

		echo $string;

		echo br(2);

		$string = $string.'=';

		echo base64_decode($string);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/welcome.php */