<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo $title; ?></title>
    <!-- Bootstrap -->
    <?php echo link_tag('css/bootstrap.css'); ?>
    <?php echo link_tag('css/global.css'); ?>
    <?php
      if($this->session->userdata('mode') && !strcmp('individual', $active))
      {
        echo link_tag('css/user.css');
      }
      else
      {
        if(!$this->session->userdata('username'))
          echo link_tag('css/'.$css.'.css');
        else
          echo link_tag('css/anon1.css');
      }
    ?> <!-- dynamic css, depending on what page you view -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php echo smiley_js(); ?>
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#loginform">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?php echo img(array('src'=>'./images/confessnabai.png', 'height'=>'40px', 'alt'=>'Brand')); ?></a>
        </div> <!-- end .navbar-header -->

        <div class="collapse navbar-collapse" id="loginform">
          <?php
            if($this->session->userdata('mode'))
            {
              if(strcmp('index', $active) == 0)
              {
                echo '<ul class="nav navbar-nav">';
                  echo '<li class="active"><a href="'.base_url().'">Home</a></li>';
                echo '</ul>';
              }
              else
              {
                echo '<ul class="nav navbar-nav">';
                  echo '<li><a href="'.base_url().'">Home</a></li>';
                echo '</ul>';
              }
            }
            else
            {
              echo '<ul class="nav navbar-nav">';
                echo '<li><a href="'.base_url().'">Home</a></li>';
              echo '</ul>';
            }
          ?>
          <?php
            if(!strcmp('admin_mode', $active))
            {
              ;
            }
            else
            {
              echo form_open('accounts/search', array('class'=>'navbar-form navbar-left', 'role'=>'search'));
                echo div_open('form-group');
                  echo div_open('input-group');
                    echo form_input(array('name'=>'in_search', 'class'=>'form-control', 'placeholder'=>'Search user'));
                    echo span('input-group-btn',
                          button(array('type'=>'submit', 'class'=>'btn btn-default'),
                            span('glyphicon glyphicon-search')));
                  echo div_close();
                echo div_close();
              echo form_close();
            }
          ?>
          <ul class="nav navbar-nav navbar-right">
            <?php
              if(!$this->session->userdata('mode'))
              {
                if(strcmp('signup', $active) == 0)
                  echo '<li class="active"><a href="'.base_url().'accounts/signup">Sign up</a></li>';
                else
                  echo '<li><a href="'.base_url().'accounts/signup">Sign up</a></li>';

                if(strcmp('login', $active) == 0)
                  echo '<li class="dropdown active">';
                else
                  echo '<li class="dropdown">';

                echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Sign in <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu" id="try"><div class="container">
                  '.form_open('accounts/submitlogin', array('class'=>'form-inline', 'role'=>'form', 'id'=>'try')).'
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                        <input type="text" class="form-control" placeholder="username" name="in_username">
                      </div>
                    </div> <!-- end .form-group -->
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                        <input type="password" class="form-control" placeholder="password" name="in_password">
                      </div>
                    </div> <!-- end .form-group -->
                    <button type="submit" class="btn btn-success btn-md">Sign in</button>
                  </form></div>
                </ul>';
              }
              else
              {
                echo '<li>'.img(array('src'=>'uploads/'.$session_store['profile_picture'], 'height'=>'50px')).'</li>';
                echo '<li class="dropdown">';
                echo anchor('#', $session_store['username'].'<span class="caret"></span>', array('class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'));
                if($this->session->userdata('account_type') == 3)
                  echo '<ul class="dropdown-menu" role="menu"><li>'.anchor('/accounts/view_users/', 'Admin Powers').'</li><li class="divider"></li><li>'.anchor('accounts/update/'.$session_store['username'], 'Update info', 'data-toggle="modal"').'</li><li>'.anchor('/accounts/logout/', 'Logout').'</li></ul>';
                else
                  echo '<ul class="dropdown-menu" role="menu"><li>'.anchor('accounts/update/'.$session_store['username'], 'Update info', 'data-toggle="modal"').'</li><li>'.anchor('/accounts/logout/', 'Logout').'</li></ul>';
              }
            ?>
            </li> <!-- end .dropdown -->
          </ul>
        </div> <!-- end .collapse navbar-collapse -->

      </div> <!-- end .container-fluid -->
    </nav> <!-- end .navbar-inverse -->