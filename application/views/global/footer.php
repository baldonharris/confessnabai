	<input type="hidden" id="harris" value="<?php echo $total_rows; ?>"/>
	<input type="hidden" id="total_post" value="<?php echo $total_rows; ?>"/>
	<?php
		/* mode ipasa para delete: 0 = anon, 1 = user, 2 = group */
		$current_me = substr(base64_encode($this->uri->uri_string()),0,-2);
		//echo $current_me;
		echo '<input type="hidden" id="current_me" value="'.$current_me.'">';
		$accounts_id = $this->session->userdata('accounts_id');
		if(!strcmp($active, 'category'))
		{
			echo '<input type="hidden" id="pass" value="'.base_url().'api/get_confessions/'.$active_category.'/'.$mode.'/0/"/>';
			echo '<input type="hidden" id="delete" value="0">';
			echo '<input type="hidden" id="admin" value="0">';
		}
		else if(!strcmp($active, 'individual'))//
		{
			echo '<input type="hidden" id="pass" value="'.base_url().'api/get_confessions/'.$user_search[0]['id'].'/0/0/"/>';
			echo '<input type="hidden" id="delete" value="0">';
			echo '<input type="hidden" id="admin" value="0">';
		}
		else if(!strcmp($active, 'group'))//
		{
			$admin_id = $group_admin_id;
			echo '<input type="hidden" id="pass" value="'.base_url().'api/get_confessions/0/1/'.$group_id.'/"/>';
			echo '<input type="hidden" id="delete" value="'.(($admin_id == $accounts_id || $this->session->userdata('account_type') == 3) ? 1 : 0).'">';
			
			for($p=0; $p<count($group['group_name']); $p++)
			{
				if($group_id == $group['group_index'][$p])
				{
					$group_admin = $group['group_admin'][$p];
					break;
				}
			}

			if(!strcmp($group_admin, $this->session->userdata('username')))
				echo '<input type="hidden" id="admin" value="'.$group_admin.'">';
			else
				echo '<input type="hidden" id="admin" value="0">';		
		}
		else if(!strcmp($active, 'user'))//
		{
			echo '<input type="hidden" id="pass" value="'.base_url().'api/get_confessions/'.$this->session->userdata('accounts_id').'/0/0/"/>';
			echo '<input type="hidden" id="delete" value="1">';
			echo '<input type="hidden" id="admin" value="0">';
		}
		else//
		{
			echo '<input type="hidden" id="pass" value="'.base_url().'api/get_confessions/0/0/0/"/>';
			echo '<input type="hidden" id="delete" value="0">';
			echo '<input type="hidden" id="admin" value="0">';
		}
	?>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.form.js"></script>
    <script src="<?php echo base_url(); ?>js/api.js"></script>
  </body>
</html>