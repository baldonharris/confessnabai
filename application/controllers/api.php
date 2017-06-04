<?php
class Api extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_test', 'api');
		$this->load->model('driver', 'account');
	}

	public function submit_comment()
	{
		$smiley_location = base_url().'smileys/';

		$accounts_id = $this->session->userdata('accounts_id');

		$username = $this->input->post('username');
		$profile_picture = $this->input->post('profile_picture');
		$comment = $this->input->post('comment');
		$posts_id = $this->input->post('posts_id');

		if(empty($comment));
		else
		{
			$comment_me = $this->api->post_comment($comment, $accounts_id, $posts_id);
		
			echo '
				<div class="media">
					<a class="pull-right" href="#">
						'.img(array("src"=>"uploads/".$profile_picture, "height"=>"44px", "width"=>"44px", "class"=>"img-thumbnail")).'
					</a>
					<div class="media-body">
						<h4 class="media-heading">
							'.anchor('accounts/user/'.$username, $username).'
						</h4>
							'.parse_smileys($comment, $smiley_location).'
					</div>
				</div>
			';
		}
	}

	public function post_confession($current_url = '')
	{
		$smiley_location = base_url().'smileys/';

		$accounts_id = $this->session->userdata('accounts_id');
		$confession = $this->input->post('in_confess');
		$group_id = $this->input->post('groupid');
		$category = $this->input->post('up_category');
		$profpict = $this->input->post('profpict');
		$username = $this->input->post('username');

		$session_store = $this->session->all_userdata();

		if(!$category);
		else
		{
			$display_group = $this->get_group($group_id);
			$display_category = $this->get_category($category);

			$result_id = $this->api->create_confession($accounts_id, $confession, $group_id, $category, 0, 0);

			$config['upload_path'] = './uploads_posts/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['file_name'] = md5($result_id);
			$config['overwrite'] = TRUE;

			//echo $config['upload_path'];

			$this->upload->initialize($config);
			$uploading = $this->upload->do_upload('picme');

			if(!$uploading)
				;
			else
			{		
				$uploaded = $this->upload->data();
				$store_db = $this->api->edit_confession($result_id, $uploaded['file_name']);
				$store_db_again = $this->api->picture_post($uploaded['file_name'], $accounts_id);

				$picture_post = $uploaded['file_name'];
			}

			if(!strcmp($username, 'anonymous'))
			{
				echo '
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="media">
							  <a class="pull-left" href="#">
							    <img class="media-object img-thumbnail" height="64px" width="64px" src="'.$profpict.'" alt="'.$username.'">
							  </a>
							  <div class="media-body">
							    <h4 class="media-heading"><a href="#">'.$username.'</a> <small>posted in '.$display_group.'</small></h4>
							    '.parse_smileys($confession, $smiley_location).'';
				if(!$uploading);
				else
					echo '<br><img src="'.base_url().'uploads_posts/'.$picture_post.'" width="50%" class="img-rounded"/>';
				echo '		  </div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-4">Category : '.anchor('home/category/'.strtolower($display_category).'/1', $display_category).'</div>
							<div class="col-md-1 col-md-offset-6">'.anchor('home/comment_post/'.md5($result_id), 'Comment', array('data-toggle'=>'modal')).'</div>
						</div>
					</div>
				</div>';
			}
			else
			{
				echo '
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="media">
							  <a class="pull-left" href="#">
							    <img class="media-object img-thumbnail" height="64px" width="64px" src="'.$profpict.'" alt="'.$username.'">
							  </a>
							  <div class="media-body">
							    <h4 class="media-heading"><a href="accounts/user/'.$username.'">'.$username.'</a> <small>posted in '.$display_group.'</small></h4>
							    '.parse_smileys($confession, $smiley_location).'';
				if(!$uploading);
				else
					echo '<br><img src="'.base_url().'uploads_posts/'.$picture_post.'" width="50%" class="img-rounded"/>';
				echo '		  </div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-4">Category : '.anchor('home/category/'.strtolower($display_category).'/1', $display_category).'</div>
							<div class="col-md-1 col-md-offset-6">'.anchor('home/comment_post/'.md5($result_id), 'Comment', array('data-toggle'=>'modal')).'</div>
							<div class="col-md-1">'.anchor("home/deletepost/".$result_id.'/'.$current_url, 'Delete').'</div>
						</div>
					</div>
				</div>';
			}
			$this->increment_posts($username);
		}
	}

	public function get_group($group_id)
	{
		$groups = $this->account->get_groups();
		
		return $groups['group_name'][$group_id-1];
	}

	public function get_category($index)
	{
		$category = $this->account->get_categories();

		return $category[$index];
	}

	public function increment_posts($username)
	{
		if(!strcmp($username, 'anonymous'))
			return 0;
		else
			$this->account->increment_post($username);
	}

	public function get_confessions($category = '', $mode = '', $group = '', $limit = '', $deletemode = '', $current_url = '')
	{
		$confessions = $this->account->get_confessions($category, $mode, $group, $limit);
		//$delete = '<div class="col-md-1">'.anchor("home/deletepost/".$confessions['posts_id'][$x], 'Delete').'</div>';

		if(!$deletemode)
			$deletemode = 0;

		if(!count($confessions['confession']));
		else
		{
			$smiley_location = base_url().'smileys/';
			
			for($x=0; $x<count($confessions['confession']); $x++)
			{
				if(!strcmp($confessions['username'][$x], 'anonymous'))
				{
					if(!$confessions['with_picture'][$x])
					{
						echo '
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="media">
									  <a class="pull-left" href="#">
									    <img class="media-object img-thumbnail" height="64px" width="64px" src="'.base_url().'uploads/'.$confessions['profile_picture'][$x].'" alt="'.$confessions['username'][$x].'">
									  </a>
									  <div class="media-body">
									    <h4 class="media-heading"><a href="#">'.$confessions['username'][$x].'</a><small> posted in '.$confessions['group'][$x].'</small></h4>
									    '.parse_smileys($confessions['confession'][$x], $smiley_location).'
									  </div>
								</div>
							</div>
							<div class="panel-footer">
								<div class="row">
									<div class="col-md-4">Category : '.anchor('home/category/'.strtolower($confessions['category'][$x].'/1'), ucwords($confessions['category'][$x])).'</div>
									<div class="col-md-1 col-md-offset-6">'.anchor('#', 'Comment').'</div>
									';
										if($deletemode)
											echo '<div class="col-md-1">'.anchor("home/deletepost/".$confessions['posts_id'][$x].'/'.$current_url, 'Delete').'</div>';
										echo'
								</div>
							</div>
						</div>';
					}
					else
					{
						echo '
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="media">
										  <a class="pull-left" href="#">
										    <img class="media-object img-thumbnail" height="64px" width="64px" src="'.base_url().'uploads/'.$confessions['profile_picture'][$x].'" alt="'.$confessions['username'][$x].'">
										  </a>
										  <div class="media-body">
										    <h4 class="media-heading"><a href="accounts/user/'.$confessions['username'][$x].'">'.$confessions['username'][$x].'</a><small> posted in '.$confessions['group'][$x].'</small></h4>
										    '.parse_smileys($confessions['confession'][$x], $smiley_location).'<br>
										    <img src="'.base_url().'uploads_posts/'.$confessions['file_name'][$x].'" width="50%" class="img-rounded"/>
										  </div>
									</div>
								</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-4">Category : '.anchor('home/category/'.strtolower($confessions['category'][$x].'/1'), ucwords($confessions['category'][$x])).'</div>
										<div class="col-md-1 col-md-offset-6">'.anchor('#commentpost_'.$x, 'Comment', array('data-toggle'=>'modal')).'</div>
										';
										if($deletemode)
											echo '<div class="col-md-1">'.anchor("home/deletepost/".$confessions['posts_id'][$x].'/'.$current_url, 'Delete').'</div>';
										echo'
									</div>
								</div>
							</div>';
					}
				}
				else
				{
					if(!$confessions['with_picture'][$x])
					{
						echo '
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="media">
									  <a class="pull-left" href="#">
									    <img class="media-object img-thumbnail" height="64px" width="64px" src="'.base_url().'uploads/'.$confessions['profile_picture'][$x].'" alt="'.$confessions['username'][$x].'">
									  </a>
									  <div class="media-body">
									    <h4 class="media-heading"><a href="'.base_url().'accounts/user/'.$confessions['username'][$x].'">'.$confessions['username'][$x].'</a><small> posted in '.$confessions['group'][$x].'</small></h4>
									    '.parse_smileys($confessions['confession'][$x], $smiley_location).'
									  </div>
								</div>
							</div>
							<div class="panel-footer">
								<div class="row">
									<div class="col-md-4">Category : '.anchor('home/category/'.strtolower($confessions['category'][$x].'/1'), ucwords($confessions['category'][$x])).'</div>
									<div class="col-md-1 col-md-offset-6">'.anchor('#', 'Comment').'</div>
									';
									if($deletemode)
										echo '<div class="col-md-1">'.anchor("home/deletepost/".$confessions['posts_id'][$x].'/'.$current_url, 'Delete').'</div>';
									echo'
								</div>
							</div>
						</div>';
					}
					else
					{
						echo '
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="media">
										  <a class="pull-left" href="#">
										    <img class="media-object img-thumbnail" height="64px" width="64px" src="'.base_url().'uploads/'.$confessions['profile_picture'][$x].'" alt="'.$confessions['username'][$x].'">
										  </a>
										  <div class="media-body">
										    <h4 class="media-heading"><a href="accounts/user/'.$confessions['username'][$x].'">'.$confessions['username'][$x].'</a><small> posted in '.$confessions['group'][$x].'</small></h4>
										    '.parse_smileys($confessions['confession'][$x], $smiley_location).'<br>
										    <img src="'.base_url().'uploads_posts/'.$confessions['file_name'][$x].'" width="50%" class="img-rounded"/>
										  </div>
									</div>
								</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-4">Category : '.anchor('home/category/'.strtolower($confessions['category'][$x].'/1'), ucwords($confessions['category'][$x])).'</div>
										<div class="col-md-1 col-md-offset-6">'.anchor('#commentpost_'.$x, 'Comment', array('data-toggle'=>'modal')).'</div>
										';
										if($deletemode)
											echo '<div class="col-md-1">'.anchor("home/deletepost/".$confessions['posts_id'][$x].'/'.$current_url, 'Delete').'</div>';
										echo'
									</div>
								</div>
							</div>';
					}
				}
			}
		}
	}
}
?>