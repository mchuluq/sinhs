<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <script>
        function listfrsg(){
            $.ajax({
                url: "<?php echo base_url('frs/mahasiswa/grup/0')?>",
                success:function(data){
                    $('#frs_data').html(data);
                }
            });
        }
        $(document).ready(function(){
            listfrsg();
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
                            <header>Data FRS</header>
                            <div class="ch-article-content">
                                <div id="frs_data">

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