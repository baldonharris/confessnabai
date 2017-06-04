<div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="thumbnail" id="fixme">
				<?php echo img(array('src'=>'uploads/'.$profile_picture)); ?>
				<div class="caption">
					<table class="table table-hover">
						<tbody>
							<tr><td><strong>Username</strong></td><td><?php echo $username; ?></td></tr>
							<tr><td><strong>Total posts</strong></td><td><span id="total_post"><?php echo $total_rows-1; ?></span></td></tr>
							<tr><td><strong>Total following</strong></td><td><?php echo $get_follower['num_following']; ?></td></tr>
							<tr><td><strong>Total followers</strong></td><td><?php echo $get_follower['num_follower']; ?></td></tr>
						</tbody>
					</table>
				</div>
			</div> <!-- end .thumbnail -->
			<div class="copyright">
                &copy; ConfessNaBai 2014
            </div>
		</div> <!-- end .col-md-3 -->
		<div class="col-md-9">
			<h4>Update <?php echo $username ?>...<br></h4>
			<?php
				echo form_open_multipart('accounts/submit_update/'.$username, array('class'=>'form-horizontal'));
					echo div_open('form-group');
						echo form_label('New Username', 'username', array('class'=>'col-sm-2 control-label', 'value'=>$username));
						echo div_open('col-sm-9');
							echo form_input(array('name'=>'up_username', 'class'=>'form-control', 'placeholder'=>'username', 'id'=>'username'));
						echo div_close(); // end .col-sm-9
					echo div_close();	// end .form-group
					echo div_open('form-group');
						echo form_label('New Password', 'password', array('class'=>'col-sm-2 control-label'));
						echo div_open('col-sm-9');
							echo form_password(array('name'=>'up_password', 'class'=>'form-control', 'placeholder'=>'password', 'id'=>'password'));
						echo div_close(); // end .col-sm-9
					echo div_close();	// end .form-group
					echo div_open('form-group');
						echo form_label('New Confirm', 'confirm_password', array('class'=>'col-sm-2 control-label'));
						echo div_open('col-sm-9');
							echo form_password(array('name'=>'up_confirm_password', 'class'=>'form-control', 'placeholder'=>'confirm password', 'id'=>'confirm_password'));
						echo div_close(); // end .col-sm-9
					echo div_close();	// end .form-group
					echo div_open('form-group');
						echo form_label('New Profile picture', 'picture', array('class'=>'col-sm-2 control-label'));
						echo div_open('col-sm-9');
							echo form_upload(array('name'=>'up_picture', 'class'=>'form-control', 'id'=>'picture'));
						echo div_close(); // end .col-sm-9
					echo div_close();	// end .form-group

					if($session_store['account_type'] != 3)
					{
						echo '<br><h4>Please confirm you are '.$username.'</h4><br>';
						echo div_open('form-group');
							echo form_label('Question', 'up_question', array('class'=>'col-sm-2 control-label'));
							echo div_open('col-sm-9');
								echo $question;
							echo div_close(); // end .col-sm-9
						echo div_close();	// end .form-group
						echo div_open('form-group');
							echo form_label('Answer', 'answer', array('class'=>'col-sm-2 control-label'));
							echo div_open('col-sm-9');
								echo form_input(array('name'=>'up_answer', 'class'=>'form-control', 'placeholder'=>'answer to the question', 'id'=>'answer'));
							echo div_close(); // end .col-sm-9
						echo div_close();	// end .form-group
					}
					
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
				echo form_close();
				//print_r($session_store);
			?>
		</div> <!-- end .col-md-9 -->
	</div> <!-- end .row -->
</div>	<!-- end .container-fluid -->