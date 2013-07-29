<!DOCTYPE html>
<html>
<head>
    <title>SINHS :: welcome</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo base_url()?>assets/pictures/uyp.ico">
    <!--load jquery & jquery ui-->
    <script type="text/javascript" src="<?php echo base_url()?>assets/scripts/jquery-2.0.0.min.js"></script>
    <!-- load bootstrap framework -->
    <link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js"></script
    <!-- load cloudfire-js -->
    <script src="<?php echo base_url()?>assets/plugins/cloudfire/js/jquery.cloudfire.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/cloudfire/css/cloudfire-js.css"/>
    <!--load custom style and script-->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/styles/app.other.min.prefixr.css"/>
    <script type="text/javascript" src="<?php echo base_url()?>assets/scripts/app.other.min.js"></script>
    <script>

    </script>

</head>
<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand-custom" href="<?php echo base_url() ?>" title="<?php echo $this->config->item('app_name')?>"><span class="logo-sinhs-full"></span></a>
            <div class="nav-collapse collapse">
                <?php
                if($this->session->userdata('log_status')){ ?>
                    <ul class="nav pull-right">
                        <li id="fat-menu" class="dropdown">
                            <a id="drop3" href="#"class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('user_full_name')?> <span class="caret"></span></a>
                            <ul class="dropdown-menu backgroundChanger">
                                <li><a href="<?php echo base_url('dashboard')?>">dashboard</a></li>
                                <li><a href="<?php echo base_url('sign/out')?>">sign out</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php }else{ ?>
                    <a accesskey="l" href="<?php echo base_url('sign')?>" class="btn btn-success pull-right"><i class="icon-lock"></i> Sign In</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="hero-unit">
        <h1>Selamat Datang !</h1>
        <p>Selamat datang di Sistem Informasi Nilai Hasil Studi Fakultas Teknik Universitas Yudharta Pasuruan, di aplikasi yang diperuntukkan bagi mahasiswa Fakultas Teknik UYP ini anda dapat memantau nilai hasil studi dan memprogram FRS. </p>
    </div>
<div id="main-footer">
    <span id="left">&copy; 2013 <a href="<?php echo $this->config->item('author_link')?>"><?php echo $this->config->item('author')?></a></span>
    <span id="right"><a href="<?php echo $this->config->item('kampus_link')?>"><?php echo $this->config->item('app_for')?></a></span>
</div>
   <div id="warning-place" style="display:none"></div>
   <div id="error-place" style="display:none"></div>
</body>
</html>