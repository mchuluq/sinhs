<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <script>
        $(document).ready(function(){
            $.sinhs.ajaxForm('#formSearch','#data-mhs')
        })
    </script>
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
                            <header>Cari Mahasiswa</header>
                            <div class="ch-article-content">
                                <form id="formSearch" class="row-fluid" method="post" action="<?php echo base_url('nilai/transkrip_mahasiswa/search')?>">
                                    <div class="span3 input-append">
                                        <input type="text" class="span10" name="searchbox" id="searchbox" placeholder="cari...">
                                        <button class="btn" type="submit"><i class="icn icon-search"></i></button>
                                    </div>
                                </form>
                                <div id="data-mhs">

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