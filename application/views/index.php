<div class="container" id="fluidcontainer">
    <div class="row">
        <div class="col-md-3">
            <div class="logo">
                <?php echo img(array('src'=>'images/confessnabai.png', 'height'=>'100%')); ?>
            </div>
            <br>
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
                <li role="presentation"><a href="#signup" aria-controls="home" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Sign up</a></li>
                <li role="presentation"><a href="#anon" aria-controls="home" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span> Remain anonymous</a></li>
            </ul>
            <br>
            <div class="copyright">
                &copy; ConfessNaBai 2014
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="home">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-body share">
                                    <h3><strong>Share all your dramas here without worrying</strong></h3>
                                    <br>
                                    A place where you can post anonymously without the worry of revealing your identity. You can either login or just anyway.
                                    <br>
                                    <br>
                                    Yes, it is <b>free</b> and always will be <?php echo parse_smileys(':)', base_url().'smileys/'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <?php echo form_open('accounts/search', array('class'=>'form-horizontal', 'role'=>'search')); ?>
                                <?php
                                    echo div_open('form-group');
                                        echo div_open('input-group');
                                            echo form_input(array('name'=>'in_search', 'class'=>'form-control', 'placeholder'=>'Search user'));
                                            echo span('input-group-btn',
                                                button(array('type'=>'submit', 'class'=>'btn btn-default'),
                                                    span('glyphicon glyphicon-search')));
                                        echo div_close();
                                    echo div_close();
                                ?>
                            </form>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <?php echo form_open('accounts/submitlogin', array('class'=>'form-horizontal', 'role'=>'form')); ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" name="in_username" class="form-control" placeholder="Username">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="password" name="in_password" class="form-control" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <br>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success btn-block">Login</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="signup">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5><strong>Note: </strong>Once username is set, it cannot be changed.</h5>
                        </div>
                        <div class="panel-body">
                            <?php
                                echo form_open_multipart('accounts/register', 'class="form-horizontal signup" role="form"');
                                    echo div_open('form-group');
                                        echo form_label('Username', 'username', array('class'=>'col-sm-2 control-label'));
                                        echo div_open('col-sm-9');
                                            echo form_input(array('name'=>'up_username', 'class'=>'form-control', 'placeholder'=>'username', 'id'=>'username'));
                                        echo div_close(); // end .col-sm-9
                                    echo div_close();   // end .form-group
                                    echo div_open('form-group');
                                        echo form_label('Password', 'password', array('class'=>'col-sm-2 control-label'));
                                        echo div_open('col-sm-9');
                                            echo form_password(array('name'=>'up_password', 'class'=>'form-control', 'placeholder'=>'password', 'id'=>'password'));
                                        echo div_close(); // end .col-sm-9
                                    echo div_close();   // end .form-group
                                    echo div_open('form-group');
                                        echo form_label('Confirm', 'confirm_password', array('class'=>'col-sm-2 control-label'));
                                        echo div_open('col-sm-9');
                                            echo form_password(array('name'=>'up_confirm_password', 'class'=>'form-control', 'placeholder'=>'confirm password', 'id'=>'confirm_password'));
                                        echo div_close(); // end .col-sm-9
                                    echo div_close();   // end .form-group
                                    echo div_open('form-group');
                                        echo form_label('Question', 'up_question', array('class'=>'col-sm-2 control-label'));
                                        echo div_open('col-sm-9');
                                            $attrib = 'class = "form-control" id = "password"';
                                            echo form_dropdown('up_question', $secret_questions, '1', $attrib);
                                        echo div_close(); // end .col-sm-9
                                    echo div_close();   // end .form-group
                                    echo div_open('form-group');
                                        echo form_label('Answer', 'answer', array('class'=>'col-sm-2 control-label'));
                                        echo div_open('col-sm-9');
                                            echo form_input(array('name'=>'up_answer', 'class'=>'form-control', 'placeholder'=>'answer to the question', 'id'=>'answer'));
                                        echo div_close(); // end .col-sm-9
                                    echo div_close();   // end .form-group
                                    echo div_open('form-group');
                                        echo form_label('Profile picture', 'picture', array('class'=>'col-sm-2 control-label'));
                                        echo div_open('col-sm-9');
                                            echo form_upload(array('name'=>'up_picture', 'class'=>'form-control', 'id'=>'picture'));
                                        echo div_close(); // end .col-sm-9
                                    echo div_close();   // end .form-group
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
                                    echo form_hidden('mode', 'anon');
                                echo form_close();
                            ?>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="anon">
                    <a href="<?php echo base_url().'home/global_anon'; ?>" class="btn btn-primary btn-md btn-block" role="button"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Go to GLOBAL for moar fun!</a>
                    <br>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php echo form_open_multipart('api/post_confession', 'id="post_confession" role="form" name="postme"'); ?>
                            <div class="input-group">
                                <textarea name="in_confess" id="confess" class="form-control" rows="3" placeholder="so, what's your drama?"></textarea>
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
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                    <span class="sr-only">45% Complete</span>
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
                                echo '<input type="hidden" id="profpict" name="profpict" value="'.base_url().'uploads/default.jpg" />';
                                echo '<input type="hidden" id="username" name="username" value="anonymous" />';
                                echo '<input type="hidden" id="groupid" name="groupid" value="'.$group_id.'"/>';
                            echo form_close();
                            ?>
                        </div>
                    </div>  <!-- end panel -->
                    <div id="confession_wall">
                    
                    </div>
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