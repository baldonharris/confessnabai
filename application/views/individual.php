<div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="thumbnail" id="fixme">
				<?php echo img(array('src'=>'uploads/'.$user_search[0]['profile_picture'])); ?>
				<div class="caption">
					<table class="table table-hover">
						<tbody>
							<tr><td><strong>Username</strong></td><td><?php echo $user_search[0]['username']; ?></td></tr>
							<tr><td><strong>Total posts</strong></td><td><?php echo $user_search[0]['total_post']; ?></td></tr>
							<tr><td><strong>Total following</strong></td><td><?php echo $get_follower['num_following']; ?></td></tr>
							<tr><td><strong>Total followers</strong></td><td><?php echo $get_follower['num_follower']; ?></td></tr>
						</tbody>
					</table>
					<?php
						if(strcmp($user_search[0]['username'], $session_store['username']))
						{
							$counter = 0;
							//print_r($get_follower['follower_id']);
							if($session_store['mode'])
							{
								//echo anchor('#error', 'Message', array('data-toggle'=>'modal', 'class'=>'btn btn-default btn-md btn-block', 'role'=>'button'));
								for($x=0; $x<count($get_follower['follower_id']); $x++)
								{
									//echo $get_follower['follower_id'][$x].br(1).$session_store['accounts_id'];

									if($get_follower['follower_id'][$x] == $session_store['accounts_id'])
										$counter++;
								}

								if(!$counter)
									echo anchor('accounts/follow/'.$session_store['username'].'/'.$user_search[0]['username'], 'Follow', array('data-toggle'=>'modal', 'class'=>'btn btn-success btn-md btn-block', 'role'=>'button'));
								else
									echo anchor('accounts/follow/'.$session_store['username'].'/'.$user_search[0]['username'], 'Follow', array('data-toggle'=>'modal', 'class'=>'btn btn-danger btn-md btn-block', 'role'=>'button', 'disabled'=>'disabled'));
							}
							else;
						}
					?>
				</div>
			</div> <!-- end .thumbnail -->
		</div>
		<div class="col-md-9">
			<div id="isolate_me">
				<?php
					//echo count($confessions['confession']);
					if(!count($confessions['confession']));
					else
					{
						for($x=0; $x<count($confessions['confession']); $x++)
						{
							$p = $x+1;
							if(!$confessions['with_picture'][$x])
							{
								echo '
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="media">
												  <a class="pull-left" href="#">
												    <img class="media-object img-thumbnail" height="64px" width="64px" src="'.base_url().'uploads/'.$user_search[0]['profile_picture'].'" alt="'.$user_search[0]['username'].'">
												  </a>
												  <div class="media-body">
												    <h4 class="media-heading"><a href="'.base_url().'accounts/user/'.$user_search[0]['username'].'">'.$user_search[0]['username'].'</a><small> posted in '.$confessions['group'][$x].'</small></h4>
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
											    <img class="media-object img-thumbnail" height="64px" width="64px" src="'.base_url().'uploads/'.$user_search[0]['profile_picture'].'" alt="'.$user_search[0]['username'].'">
											  </a>
											  <div class="media-body">
											    <h4 class="media-heading"><a href="'.base_url().'accounts/user/'.$user_search[0]['username'].'">'.$user_search[0]['username'].'</a><small> posted in '.$confessions['group'][$x].'</small></h4>
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
		</div> <!-- end .col-md-4 -->
	</div> <!-- end .row -->
</div>	<!-- end .container-fluid -->