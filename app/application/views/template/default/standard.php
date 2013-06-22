<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
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
                        <!-- content letakkan disini :: seperti di bawah ini-->
                        <article class="ch-article span9">
                            <header><i class="icon-tag"></i>ip anda</header>
                            <div class="ch-article-content">

                            </div>
                        </article><!-- /ontent -->
                    </div><!--/row-->
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

</body>
</html>