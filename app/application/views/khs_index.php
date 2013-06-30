<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <script>
        function listKhs(){
            $.ajax({
                url: "<?php echo base_url('khs/index/grup/0')?>",
                success:function(data){
                    $('#khs_data').html(data);
                }
            });
        }
        $(document).ready(function(){
            listKhs();
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
                            <header>Hasil Studi</header>
                            <div class="ch-article-content">
                                <div id="khs_data">

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

</body>
</html>