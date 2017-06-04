<div class="container-fluid" id="fluidcontainer">
	<?php echo div_open(array('class'=>'container', 'id'=>'indexcontainer')); ?>
		<h2>Sign in</h2>
		<hr>
		<?php
			echo form_open_multipart('accounts/submitlogin', 'class="form-horizontal" role="form"');
				echo div_open('form-group');
					echo form_label('Username', 'username', array('class'=>'col-sm-2 control-label'));
					echo div_open('col-sm-9');
						echo form_input(array('name'=>'in_username', 'class'=>'form-control', 'placeholder'=>'username', 'id'=>'username'));
					echo div_close(); // end .col-sm-9
				echo div_close();	// end .form-group
				echo div_open('form-group');
					echo form_label('Password', 'password', array('class'=>'col-sm-2 control-label'));
					echo div_open('col-sm-9');
						echo form_password(array('name'=>'in_password', 'class'=>'form-control', 'placeholder'=>'password', 'id'=>'password'));
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
			echo form_close();
		?>
	<?php echo div_close(); ?>
</div> <!-- end container -->

<?php
	if($notif_trigger == 1)
	{
		echo '
			<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title" id="myModalLabel">Sign up success</h4>
						</div>
						<div class="modal-body">
							'.$message.'
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>';
		
		echo '
			<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title" id="myModalLabel">Sign in error</h4>
						</div>
						<div class="modal-body">
							'.$message.'
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>';
	}
	else;
?>