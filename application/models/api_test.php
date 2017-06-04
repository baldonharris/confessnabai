<?php
class Api_test extends CI_Model
{
	public function create_confession($accounts_id, $confession, $group_id, $category, $with_picture, $file_name)
	{
		$time_stamp = now();

		$this->db->insert('posts', array('post'=>$confession, 'post_accounts_id'=>$accounts_id, 'group_id'=>$group_id, 'category'=>$category, 'time_stamp'=>$time_stamp, 'with_picture'=>$with_picture, 'file_name'=>$file_name));
		$posts_id = $this->db->insert_id();

		return $posts_id;
	}

	public function edit_confession($posts_id, $picture_filename)
	{
		$this->db->where('posts_id', $posts_id);
		$this->db->update('posts', array('with_picture'=>1, 'file_name'=>$picture_filename));
	}

	public function picture_post($file_name, $accounts_id)
	{
		$this->db->insert('picture_post', array('picture_post_filename'=>$file_name, 'accounts_id'=>$accounts_id));
	}

	public function post_comment($comment, $accounts_id, $posts_id)
	{
		$time_stamp = now();

		$this->db->insert('comments', array('comment'=>$comment, 'user_accounts_id'=>$accounts_id, 'posts_id'=>$posts_id, 'time_stamp'=>$time_stamp));

		return $this->db->insert_id();
	}
}
?>