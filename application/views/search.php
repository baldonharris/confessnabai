<div class="container-fluid" id="fluidcontainer">
	<?php echo div_open(array('class'=>'container', 'id'=>'indexcontainer')); ?>
		<h2>Search results</h2>
		<hr>
		<?php
			if(!empty($result['user'][1]))
			{
				echo '<h3>Users</h3>';
				echo '<hr>';
				echo div_open('list-group');
					for($x=0; $x<count($result['user'][1]); $x++)
					{
						if($result['user'][1][$x]['account_status'] == 1)
							echo anchor('accounts/user/'.$result['user'][1][$x]['username'], '<h4 class="list-group-item-heading">'.$result['user'][1][$x]['username'].'</h4><p class="list-group-item-text"><strong>Account Status:</strong> Active</p>', array('class'=>'list-group-item'));
						else
							echo anchor('accounts/user/'.$result['user'][1][$x]['username'], '<h4 class="list-group-item-heading">'.$result['user'][1][$x]['username'].'</h4><p class="list-group-item-text"><strong>Account Status:</strong> Suspended</p>', array('class'=>'list-group-item list-group-item-warning'));
					}
				echo div_close();
			}

			if(!empty($result['group']['group_name']))
			{
				echo '<h3>Groups</h3>';
				echo '<hr>';
				echo div_open('list-group');
					for($x=0; $x<count($result['group']['group_name']); $x++)
						echo anchor('home/groups/'.md5($result['group']['group_index'][$x]).'_'.$result['group']['group_index'][$x], '<h4 class="list-group-item-heading">'.$result['group']['group_name'][$x].'</h4><p class="list-group-item-text"><strong>Admin:</strong> '.$result['group']['group_admin'][$x].'</p>', array('class'=>'list-group-item'));
				echo div_close();
			}
		?>
		<?php
			if(!$notification);
			else
				echo $notification;
		?>
	<?php echo div_close(); ?>
</div> <!-- end container -->