<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <script>
        function listNilai(){
            var cari = $("input#searchbox").val();
            var safe = cari.replace(/\s/g,"");
            var limit = $("select#limitbox").val();
            $.ajax({
                url: "<?=base_url('nilai/dosen/list/0')?>"+"/"+limit+"/"+ safe,
                success:function(data){
                    $('#nilai_data').html(data);
                }
            });
        }
        $(document).ready(function(){
            listNilai();
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
                            <header>Pilih Daftar Matakuliah</header>
                            <div class="ch-article-content">
                                <form id="formSearch" class="row-fluid">
                                    <div class="span9">
                                        <select onchange="javascript:listNilai()" id="limitbox" name="limitbox" class="span3">
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="30">30</option>
                                            <option value="40">40</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                    <div class="span3 input-append">
                                        <input type="text" class="span10" name="searchbox" id="searchbox" placeholder="cari...">
                                        <button class="btn" type="submit"><i class="icn icon-search"></i></button>
                                    </div>
                                </form>
                                <div id="nilai_data">

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