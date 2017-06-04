<div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="thumbnail" id="fixme">
				<?php echo img(array('src'=>'uploads/'.$session_store['profile_picture'])); ?>
				<div class="caption">
					<table class="table table-hover">
						<tbody>
							<tr><td><strong>Username</strong></td><td><?php echo $session_store['username']; ?></td></tr>
							<tr><td><strong>Total posts</strong></td><td><span id="total_post"><?php echo $total_rows-1; ?></span></td></tr>
							<tr><td><strong>Total following</strong></td><td><?php echo $get_follower['num_following']; ?></td></tr>
							<tr><td><strong>Total followers</strong></td><td><?php echo $get_follower['num_follower']; ?></td></tr>
						</tbody>
					</table>
				</div>
			</div> <!-- end .thumbnail -->
			<div class="list-group">
			<?php
				echo anchor('#', '<strong><center>Your idols</center></strong>', array('class'=>'list-group-item list-group-item-info'));
				for($x=0; $x<count($follow_info); $x++)
					echo anchor('accounts/user/'.$follow_info[$x]['username'], span('badge', $follow_info[$x]['total_post']).$follow_info[$x]['username'], array('class'=>'list-group-item'));
			?>
			</div>
			<div class="copyright">
                &copy; ConfessNaBai 2014
            </div>
		</div> <!-- end .col-md-4 -->
		<div class="col-md-9">
			<?php
				for($x=0; $x<count($confessions); $x++)
				{
					echo '
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="media">
									  <a class="pull-left" href="#">
									    <img class="media-object img-thumbnail" height="64px" width="64px" src="'.base_url().'uploads/'.$confessions[$x]['profile_picture'].'" alt="'.$confessions[$x]['username'].'">
									  </a>
									  <div class="media-body">
									    <h4 class="media-heading"><a href="#">'.$confessions[$x]['username'].'</a><small> posted in '.$confessions[$x]['group'].'</small></h4>
									    '.parse_smileys($confessions[$x]['confession'], $smiley_location).'<br>
									    '.((!$confessions[$x]['file_name']) ? '' : '<img src="'.base_url().'uploads_posts/'.$confessions[$x]['file_name'].'" width="50%" class="img-rounded"/>').'
									  </div>
								</div>
							</div>
							<div class="panel-footer">
								<div class="row">
									<div class="col-md-4">Category : '.anchor('home/category/'.strtolower($confessions[$x]['category'].'/1'), ucwords($confessions[$x]['category'])).'</div>
									<div class="col-md-1 col-md-offset-6">'.anchor('home/comment_post/'.md5($confessions[$x]['posts_id']), 'Comment', array('data-toggle'=>'modal')).'</div>
								</div>
							</div>
						</div>';	
				}
			?>
		</div> <!-- end .col-md-9 -->
	</div> <!-- end .row -->
</div>	<!-- end .container-fluid -->