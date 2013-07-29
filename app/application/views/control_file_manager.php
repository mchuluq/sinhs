<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>

    <!-- load jquery UI -->
    <link href="<?php echo base_url()?>assets/styles/jquery-ui-themes/smoothness/jquery-ui-1.10.2.custom.css" rel="stylesheet">
    <script src="<?php echo base_url()?>assets/scripts/jquery-ui-1.10.2.custom.js"></script>

    <?php echo $init ?>

</head>
<body>
<?php echo $_header;?>

<div class="container-fluid">
    <div class="row-fluid" id="header-area">
        <?php echo $_head_area;?>
    </div>
    <div class="row-fluid" id="content-area">
        <section class="span9" id="ch-main-content">
            <div class="row-fluid">
                <div class="span12">
                    <div class="row-fluid">
                        <article class="ch-article span12">
                            <header><i class="icon-file"></i>elFinder File Manager</header>
                            <div class="ch-article-content">
                                <div id="tempatnya-elfinder" style="max-width:100%;min-width:100%;max-height:600px">

                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
        <aside class="span3" id="ch-sidebar">
            <?php echo $_sidebar;?>
        </aside>
    </div>
    <div class="row-fluid" id="footer-area">
        <?php echo $_footer; ?>
    </div>
</div>
<?php echo $_bscript;?>
</body>
</html>