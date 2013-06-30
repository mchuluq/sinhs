<!DOCTYPE html>
<html>
<head>
    <title>S.I.N.H.S :: <?php echo $title;?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo base_url()?>assets/pictures/uyp.ico">
    <!--load jquery-->
    <script type="text/javascript" src="<?php echo base_url()?>assets/scripts/jquery-2.0.0.js"></script>
    <!-- load bootstrap framework -->
    <link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.js"></script

    <!-- load alertify -->
    <link href="<?php echo base_url()?>assets/plugins/alertify/themes/alertify.core.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/plugins/alertify/themes/alertify.bootstrap.css" rel="stylesheet">
    <script src="<?php echo base_url()?>assets/plugins/alertify/alertify.min.js"></script>

    <!-- load pnotify -->
    <link href="<?php echo base_url()?>assets/plugins/pnotify/jquery.pnotify.default.css" rel="stylesheet">
    <script src="<?php echo base_url()?>assets/plugins/pnotify/jquery.pnotify.min.js"></script>

    <!-- load cloudfire-js -->
    <script src="<?php echo base_url()?>assets/plugins/cloudfire/js/jquery.cloudfire.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/cloudfire/css/cloudfire-js.css"/>
    <!--load custom style and script-->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/styles/app.other.css"/>
    <script type="text/javascript" src="<?php echo base_url()?>assets/scripts/app.other.js"></script>
    <script>

    </script>

</head>
<body>
   <div id="login-shield">
       <img id="logo" class="animated" src="<?php echo base_url()?>assets/pictures/uyp.png"/>
        <form id="ch-login" class="animated container-fluid" action="<?php echo base_url('sign/in')?>" method="post">
            <a href="<?php echo base_url()?>" title="home" class="back">Back</a>
            <div id="user-login"><input title="nama pengguna" id="user"type="text" value="<?php echo $this->session->flashdata('uname')?>" name="user-log" autofocus required placeholder="user name" autocomplete="off"/></div>
            <div id="user-pass"><input title="password pengguna" type="password" name="user-pass" required placeholder="password"></div>
            <div id="login-button"><input type="submit" name="submitter" value="login"></div>
        </form>
    </div>
<div id="main-footer">
    <span id="left">&copy; 2013 <a href="<?php echo $this->config->item('author_link')?>"><?php echo $this->config->item('author')?></a></span>
    <span id="right"><a href="<?php echo $this->config->item('kampus_link')?>"><?php echo $this->config->item('app_for')?></a></span>
</div>
   <div id="warning-place" style="display:none"><?php if(validation_errors()){echo validation_errors();} ?></div>
   <div id="error-place" style="display:none"><?php if($this->session->flashdata('error')){echo $this->session->flashdata('error');} ?></div>
</body>
</html>