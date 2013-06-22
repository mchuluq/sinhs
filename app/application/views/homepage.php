<!DOCTYPE html>
<html>
<head>
    <title>SINHS :: welcome</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo base_url()?>assets/pictures/uyp.ico">
    <!--load jquery & jquery ui-->
    <script type="text/javascript" src="<?php echo base_url()?>assets/scripts/jquery-2.0.0.js"></script>
    <!-- load bootstrap framework -->
    <link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.js"></script
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
<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" title="<?php echo $this->config->item('app_name')?>"><?php echo $this->config->item('app_shortname')?></a>
            <div class="nav-collapse collapse">
                <form class="navbar-form pull-right form-inline" action="<?php echo base_url('sign/in')?>" method="post">
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span><input title="nama pengguna" id="user"type="text" name="user-log" autofocus required placeholder="user name" autocomplete="off"/></div>
                    <div class="input-prepend"><span class="add-on"><i class="icon-lock"></i></span><input title="password pengguna" type="password" name="user-pass" required placeholder="password"></div>
                    <button type="submit" class="btn btn-primary"><i class="icon-fire icon-white"></i> Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="hero-unit">
        <h1>Selamat Datang !</h1>
        <p>Selamat datang di Sistem Informasi Nilai Hasil Studi Fakultas Teknik Universitas Yudharta Pasuruan, di aplikasi yang diperuntukkan bagi mahasiswa Fakultas Teknik UYP ini anda dapat memantau nilai hasil studi dan memprogram FRS. </p>
        <p>login dengan tombol di bawah ini atau langsung lewat Navigation bar diatas...</p>
        <p><a class="btn btn-success" href="<?php echo base_url('sign')?>">Login</a></p>
    </div>
<div id="main-footer">
    <span id="left">&copy; 2013 <a href="<?php echo $this->config->item('author_link')?>"><?php echo $this->config->item('author')?></a></span>
    <span id="right"><a href="<?php echo $this->config->item('kampus_link')?>"><?php echo $this->config->item('app_for')?></a></span>
</div>
   <div id="warning-place" style="display:none"></div>
   <div id="error-place" style="display:none"></div>
</body>
</html>