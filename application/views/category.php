<div class="container">
	<div class="row">
		<div class="col-md-3">
			<h1><?php echo $category[$category_id]; ?></h1><hr>
			<?php
				if(!$session_store['mode'])
				{
					echo '
						<div class="list-group">
							<a href="'.base_url().'home/global_anon" class="list-group-item list-group-item-info"><strong><span class="glyphicon glyphicon-chevron-left"></span>Back to Global</strong></a>
						</div>
					';
				}
				else
				{
					echo '
						<div class="list-group">
							<a href="'.base_url().'" class="list-group-item list-group-item-info"><strong><span class="glyphicon glyphicon-chevron-left"></span>Back to Home</strong></a>
						</div>
					';
				}
			?>	
			<div class="list-group">
				<a href="#" class="list-group-item list-group-item-info" id="category"><strong>Category</strong></a>
				<?php
					for($x=0; $x<count($category); $x++)
					{
						if(!strcmp(strtolower($category[$x+1]), strtolower($active_category)))
							echo anchor('home/category/'.strtolower($category[$x+1]).'/1', $category[$x+1], 'class="list-group-item active"');
						else
							echo anchor('home/category/'.strtolower($category[$x+1]).'/1', $category[$x+1], 'class="list-group-item"');
					}
				?>
			</div> <!-- end .list-group -->
			<div class="list-group">
				<a href="#" class="list-group-item list-group-item-info" id="category"><strong>Groups</strong></a>
				<?php
					if(!empty($group['group_name']))
					{
						for($y=0; $y<count($group['group_name']); $y++)
							echo anchor('home/groups/'.md5(strtolower($group['group_index'][$y])).'_'.strtolower($group['group_index'][$y]), $group['group_name'][$y], 'class="list-group-item"');
					}
					//echo anchor('#group', span('glyphicon glyphicon-plus').' Add group', array('data-toggle'=>'modal', 'class'=>'list-group-item', 'role'=>'button'));
				?>
			</div> <!-- end .list-group -->
			<div class="copyright">
                &copy; ConfessNaBai 2014
            </div>
		</div> <!-- end .col-md-4 -->
		<div class="col-md-9">
			<div id="isolate_me">
				<div id="confession_wall">
					
				</div>
				<?php
					//echo count($confessions['confession']);
					if(!count($confessions['confession']));
					else
					{
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
?>