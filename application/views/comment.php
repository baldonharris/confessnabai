<div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="list-group">
				<a href="<?php echo base_url(); ?>" class="list-group-item list-group-item-info"><strong><center>Back to Home</center></strong></a>
			</div>
		</div>
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="media">
						<a class="pull-left" href="#">
							<?php echo img(array('src'=>'uploads/'.$confession['profile_picture'], 'height'=>'64px', 'width'=>'64px', 'class'=>'img-thumbnail')); ?>
						</a>
						<div class="media-body">
							<h4 class="media-heading"><?php echo anchor('accounts/user/'.$confession['username'], $confession['username']); ?> <small>posted in <?php echo $confession['group_name']; ?></small></h4>
							<?php
								echo parse_smileys($confession['post'], $smiley_location);

								if($confession['with_picture'])
									echo '<br>'.img(array('src'=>'uploads_posts/'.$confession['file_name'], 'class'=>'img-rounded', 'width'=>'50%'));
								else
									echo br(3);

								for($x=0; $x<count($comment['comment']); $x++)
								{
									echo '
										<div class="media">
											<a class="pull-right" href="#">
												'.img(array('src'=>'uploads/'.$comment['profile_picture'][$x], 'height'=>'44px', 'width'=>'44px', 'class'=>'img-thumbnail')).'
											</a>
											<div class="media-body">
												<h4 class="media-heading">'.anchor('accounts/user/'.$comment['username'][$x], $comment['username'][$x]).'</h4>
													'.parse_smileys($comment['comment'][$x], $smiley_location).' 
											</div>
										</div>
									';

								}
							?>
							<br/>
							<div id="throwcomment">
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<?php echo form_open_multipart('api/submit_comment', 'id="submit_comment" role="form" name="postme"'); ?>
						<div class="row">
							<div class="col-md-11">
								<input type="text" name="comment" id="comment" class="form-control" placeholder="commenting as <?php echo $username; ?>...">
							</div>
							<div class="col-md-1">
								<?php echo anchor('#smileys', span('glyphicon glyphicon-magnet'), array('data-toggle'=>'modal', 'class'=>'btn btn-warning btn-md', 'role'=>'button')); ?>
							</div>
						</div>
						<input name="posts_id" type="hidden" value="<?php echo $confession['posts_id']; ?>">
						<input name="username" type="hidden" value="<?php echo (!$this->session->userdata('username') ? 'anonymous' : $this->session->userdata('username')); ?>">
						<input name="profile_picture" type="hidden" value="<?php echo (!$this->session->userdata('profile_picture') ? 'default.jpg' : $this->session->userdata('profile_picture')); ?>">
						<div class="hide">
							<input name="submit" type="submit"/>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	echo '
	<div class="modal fade" id="smileys" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Insert smiley</h4>
				</div>
				<div class="modal-body">
					'.$smiley_table.'
				</div>
			</div>
		</div>
	</div>';
?>