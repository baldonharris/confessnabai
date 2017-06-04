<div class="container">
	<div class="row">
		<div class="col-md-10">
			<?php
				echo form_open('accounts/search', array('role'=>'search'));
					echo div_open('form-group');
						echo div_open('input-group');
							echo form_input(array('name'=>'in_search', 'class'=>'form-control', 'placeholder'=>'Search user'));
								echo span('input-group-btn',
									button(array('type'=>'submit', 'class'=>'btn btn-default'),
										span('glyphicon glyphicon-search')));
						echo div_close();
					echo div_close();
				echo form_close();
			?>
		</div>
		<div class="col-md-2">
			<?php echo anchor('#add_user', '<span class="glyphicon glyphicon-plus"></span> Add user', array('data-toggle'=>'modal', 'class'=>'btn btn-success btn-md', 'role'=>'button')); ?>			
		</div>
		<div class="col-md-10">
			<?php
				echo form_open('home/add_category');
					echo form_input(array('name'=>'add_category', 'class'=>'form-control', 'placeholder'=>'Add category'));
			?>
		</div>
		<div class="col-md-2">
			<?php echo button(array('type'=>'submit', 'class'=>'btn btn-primary'), '<span class="glyphicon glyphicon-plus"></span> Submit'); ?>
			<?php echo form_close(); ?>
		</div>
	</div>
	<table class="table table-hover">
		<thead>
			<th></th>
			<th>Accounts ID</th>
			<th>Username</th>
			<th>Account Type</th>
			<th>Total Post</th>
			<th>Account Status</th>
			<th>Power</th>
		</thead>
		<tbody>
			<?php
				for($x=0; $x<count($users); $x++)
				{
					$image_properties = array();
					$image_properties = array('height'=>'50px', 'width'=>'50px', 'src'=>'uploads/'.$users[$x]['profile_picture'], 'class'=>'img-rounded');
					echo '<tr>';
					echo '<td>'.anchor('accounts/user/'.$users[$x]['username'], img($image_properties)).'</td>';
					echo '<td>'.$users[$x]['accounts_id'].'</td>';
					echo '<td>'.$users[$x]['username'].'</td>';
					echo '<td>'.$users[$x]['account_type'].'</td>';
					echo '<td>'.$users[$x]['total_post'].'</td>';
					if($users[$x]['account_status'] == 1)
						echo '<td>Active</td>';
					else
						echo '<td>Suspended</td>';
					echo '<td>';
					echo div_open('btn-group');
						echo '<button type="button" class="btn btn-info btn-sm dropdwon-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>';
						if($users[$x]['account_status'] == 1)
						{
							echo '<ul class="dropdown-menu" role="menu">
									<li>'.anchor('accounts/actions/1/'.$users[$x]['username'], 'Edit').'</li>
									<li>'.anchor('accounts/actions/2/'.$users[$x]['accounts_id'], 'Delete').'</li>
									<li>'.anchor('accounts/actions/3/'.$users[$x]['accounts_id'], 'Suspend').'</li>
								  </ul>';
						}
						else
						{
							echo '<ul class="dropdown-menu" role="menu">
									<li>'.anchor('accounts/actions/1/'.$users[$x]['username'], 'Edit').'</li>
									<li>'.anchor('accounts/actions/2/'.$users[$x]['accounts_id'], 'Delete').'</li>
									<li>'.anchor('accounts/actions/3/'.$users[$x]['accounts_id'], 'Unsuspend').'</li>
								  </ul>';
						}
					echo div_close();
					echo '</td>';
					echo '</tr>';
				}
			?>
		</tbody>
	</table>
</div>

<?php
	echo '
		<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">Admin Power - Add user</h4>
					</div>
					<div class="modal-body">';

				echo form_open_multipart('accounts/register', 'class="form-horizontal" role="form"');
				echo div_open('form-group');
					echo form_label('Username', 'username', array('class'=>'col-sm-2 control-label'));
					echo div_open('col-sm-9');
						echo form_input(array('name'=>'up_username', 'class'=>'form-control', 'placeholder'=>'username', 'id'=>'username'));
					echo div_close(); // end .col-sm-9
				echo div_close();	// end .form-group
				echo div_open('form-group');
					echo form_label('Password', 'password', array('class'=>'col-sm-2 control-label'));
					echo div_open('col-sm-9');
						echo form_password(array('name'=>'up_password', 'class'=>'form-control', 'placeholder'=>'password', 'id'=>'password'));
					echo div_close(); // end .col-sm-9
				echo div_close();	// end .form-group
				echo div_open('form-group');
					echo form_label('Confirm', 'confirm_password', array('class'=>'col-sm-2 control-label'));
					echo div_open('col-sm-9');
						echo form_password(array('name'=>'up_confirm_password', 'class'=>'form-control', 'placeholder'=>'confirm password', 'id'=>'confirm_password'));
					echo div_close(); // end .col-sm-9
				echo div_close();	// end .form-group
				echo div_open('form-group');
					echo form_label('Question', 'up_question', array('class'=>'col-sm-2 control-label'));
					echo div_open('col-sm-9');
						$attrib = 'class = "form-control" id = "password"';
						echo form_dropdown('up_question', $secret_questions, '1', $attrib);
					echo div_close(); // end .col-sm-9
				echo div_close();	// end .form-group
				echo div_open('form-group');
					echo form_label('Answer', 'answer', array('class'=>'col-sm-2 control-label'));
					echo div_open('col-sm-9');
						echo form_input(array('name'=>'up_answer', 'class'=>'form-control', 'placeholder'=>'answer to the question', 'id'=>'answer'));
					echo div_close(); // end .col-sm-9
				echo div_close();	// end .form-group
				echo div_open('form-group');
					echo form_label('Profile picture', 'picture', array('class'=>'col-sm-2 control-label'));
					echo div_open('col-sm-9');
						echo form_upload(array('name'=>'up_picture', 'class'=>'form-control', 'id'=>'picture'));
					echo div_close(); // end .col-sm-9
				echo div_close();	// end .form-group
				echo div_open('form-group');
					echo div_open('col-md-offset-2 col-md-2');
						echo button(array('type'=>'submit', 'class'=>'btn btn-primary'), 'Submit');
						//echo '<button type="submit" class="btn btn-success">Submit</button>';
					echo div_close();
					if(!$notification)
						;
					else
					{
						echo div_open('col-md-7');
							echo $notification;
						echo div_close();
					}
				echo div_close();
				echo form_hidden('mode', 'admin');
			echo form_close();

	echo '				</div>
				</div>
			</div>
		</div>';
?>