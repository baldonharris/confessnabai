<div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="list-group">
				<a href="#" class="list-group-item list-group-item-info" id="category"><strong>Group: </strong>Global</a>
			</div>
			<div class="list-group">
				<a href="#" class="list-group-item list-group-item-info" id="category"><strong>Category</strong></a>
				<?php
					for($x=0; $x<count($category); $x++)
						echo anchor('home/category/'.strtolower($category[$x+1]).'/1', ucwords($category[$x+1]), 'class=list-group-item');
				?>
			</div> <!-- end .list-group -->
			<div class="list-group">
				<a href="#" class="list-group-item list-group-item-info" id="category"><strong>Groups</strong></a>
				<?php
					if(!empty($group['group_name']))
					{
						for($y=0; $y<count($group['group_name']); $y++)
						{
							if($group_id != $group['group_index'][$y])
								echo anchor('home/groups/'.md5(strtolower($group['group_index'][$y])).'_'.strtolower($group['group_index'][$y]), $group['group_name'][$y], 'class="list-group-item"');
							else
								echo anchor('home/groups/'.md5(strtolower($group['group_index'][$y])).'_'.strtolower($group['group_index'][$y]), $group['group_name'][$y], 'class="list-group-item active"');
						}
					}
					if(strcmp($active, 'anon'))
						echo anchor('#group', span('glyphicon glyphicon-plus').' Add group', array('data-toggle'=>'modal', 'class'=>'list-group-item', 'role'=>'button'));
				?>
			</div> <!-- end .list-group -->
		</div> <!-- end .col-md-3 -->
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-body">
				<?php $current_url = substr(base64_encode($this->uri->uri_string()),0,-2); ?>
				<?php echo form_open_multipart('api/post_confession/'.$current_url, 'id="post_confession" role="form" name="postme"'); ?>
					<div class="input-group">
						<textarea name="in_confess" id="confess" class="form-control" rows="3" placeholder="yow, confess na!"></textarea>
						<div class="input-group-addon">
							<?php
								echo anchor('#smileys', span('glyphicon glyphicon-magnet'), array('data-toggle'=>'modal', 'class'=>'btn btn-warning btn-md', 'role'=>'button'));
							
								echo div_open('fileUpload btn btn-primary');
									echo span('glyphicon glyphicon-picture');
									echo '<input name="picme" id="uploadBtn" type="file" class="uploadpic" />';
								echo div_close();
							?>
						</div>
					</div>
					<div class="progress progress_post">
						<div class="progress_go progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<?php
						echo div_open('row');
							echo div_open('col-md-4 col-md-offset-6');
								$category[0] = 'Choose category...';
								echo form_dropdown('up_category', $category, '0', 'class = "form-control" id="category_me"');
							echo div_close();
							echo div_open('col-md-1');
								echo button(array('type'=>'submit', 'class'=>'btn btn-success btn-md'), 'Confess');
							echo div_close();
						echo div_close();
						echo '<input type="hidden" id="profpict" name="profpict" value="'.base_url().'uploads/'.(!$this->session->userdata('username') ? 'default.jpg' : $session_store['profile_picture']).'" />';
						echo '<input type="hidden" id="username" name="username" value="'.(!$this->session->userdata('username') ? 'anonymous' : $session_store['username']).'" />';
						echo '<input type="hidden" id="totalpost" name="totalpost" value="'.count($confessions['confession']).'" />';
						echo '<input type="hidden" id="groupid" name="groupid" value="'.$group_id.'"/>';
					echo form_close();
					?>
				</div>
			</div> <!-- end .panel panel-default -->
			<div id="isolate_me">
				<div id="confession_wall">
					
				</div>
				<?php
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
											<div class="col-md-1 col-md-offset-6">'.anchor('home/comment_post/'.md5($confessions['posts_id'][$x]), 'Comment', array('data-toggle'=>'modal')).'</div>
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
												    <h4 class="media-heading"><a href="#">'.$confessions['username'][$x].'</a><small> posted in '.$confessions['group'][$x].'</small></h4>
												    '.parse_smileys($confessions['confession'][$x], $smiley_location).'<br>
												    <img src="'.base_url().'uploads_posts/'.$confessions['file_name'][$x].'" width="50%" class="img-rounded"/>
												  </div>
											</div>
										</div>
										<div class="panel-footer">
											<div class="row">
												<div class="col-md-4">Category : '.anchor('home/category/'.strtolower($confessions['category'][$x].'/1'), ucwords($confessions['category'][$x])).'</div>
												<div class="col-md-1 col-md-offset-6">'.anchor('home/comment_post/'.md5($confessions['posts_id'][$x]), 'Comment', array('data-toggle'=>'modal')).'</div>
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
											<div class="col-md-1 col-md-offset-6">'.anchor('home/comment_post/'.md5($confessions['posts_id'][$x]), 'Comment', array('data-toggle'=>'modal')).'</div>
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
												    <h4 class="media-heading"><a href="'.base_url().'accounts/user/'.$confessions['username'][$x].'">'.$confessions['username'][$x].'</a><small> posted in '.$confessions['group'][$x].'</small></h4>
												    '.parse_smileys($confessions['confession'][$x], $smiley_location).'<br>
												    <img src="'.base_url().'uploads_posts/'.$confessions['file_name'][$x].'" width="50%" class="img-rounded"/>
												  </div>
											</div>
										</div>
										<div class="panel-footer">
											<div class="row">
												<div class="col-md-4">Category : '.anchor('home/category/'.strtolower($confessions['category'][$x].'/1'), ucwords($confessions['category'][$x])).'</div>
												<div class="col-md-1 col-md-offset-6">'.anchor('home/comment_post/'.md5($confessions['posts_id'][$x]), 'Comment', array('data-toggle'=>'modal')).'</div>
											</div>
										</div>
									</div>';
							}
						}
					}
				?>
			</div>
			<div id="scrolling" class="alert alert-warning" role="alert"><center><strong>That's it. Keep scrolling, human...</strong></center></div>
		</div> <!-- end .col-md-9 -->
	</div> <!-- end .row -->
</div>	<!-- end .container-fluid -->

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
	if(strcmp($active, 'anon'))
	{
		echo '
		<div class="modal fade" id="group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">Add group</h4>
					</div>
					<div class="modal-body">
						<p><strong>Reminder:</strong></p>
						<p>Automatically you will be the admin of this group. You will be responsible for the posts, and will be granted the power to delete any inappropriate posts.</p>
						<p>The <strong>super admin</strong> has the right to delete the group that is used for bashing a person or institution.</p>
						<p>If you think you are responsible enough, sige go!</p>
						<br>
						'.form_open('home/add_group', 'class="form-horizontal" role="form"')
						 	.div_open('form-group')
						 		.form_label('Group name', 'group_me', array('class'=>'col-sm-3 col-sm-offset-2 control-label'))
						 		.div_open('col-sm-4')
						 			.form_input(array('name'=>'up_group_name', 'class'=>'form-control', 'placeholder'=>'group name', 'id'=>'group_me'))
						 		.div_close()
						 	.div_close()
						 	.div_open('form-group')
						 		.form_label('Group admin', 'group_admin', array('class'=>'col-sm-3 col-sm-offset-2 control-label'))
						 		.div_open('col-sm-4')
						 			.form_input(array('name'=>'up_group_admin', 'class'=>'form-control', 'value'=>$session_store['username'], 'id'=>'group_admin', 'disabled'=>''))
						 			.form_hidden('group_admin', $session_store['username'])
						 		.div_close()
						 	.div_close().
						'
					</div>
					<div class="modal-footer">
						'.button(array('type'=>'submit', 'class'=>'btn btn-success btn-md'), 'Add group').'
					</div>
					'.form_close().'
				</div>
			</div>
		</div>';
	}
?>