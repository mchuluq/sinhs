<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title;?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo base_url()?>assets/pictures/uyp.ico">
    <!--load jquery & jquery ui-->
    <script type="text/javascript" src="<?php echo base_url()?>assets/scripts/jquery-2.0.0.js"></script>
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
<div id="error-container" class="animated bounceInDown">
    <h1 class="icon">!</h1>
    <h2 class="title">Error : <?php echo $error_type;?></h2>
    <div class="error-detail">
        <p><?php echo $message;?></p>
        <p>Klik area ini untuk kembali.</p>
    </div>
</div>
<div id="main-footer">
    <span id="left">&copy; 2013 mochammad c. chuluq</span>
    <span id="right">Fakultas Teknik <a href="#">Universitas Yudharta Pasuruan</a></span>
</div>
<div id="warning-place" style="display:none"></div>
<div id="error-place" style="display:none"></div>
</body>
</html>