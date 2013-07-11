<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <script>
        $(document).ready(function(){
            $('a.backToGroup').click(function(){
                history.back();
            })
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

                                <table id="mk_detail"class="table table-striped table-hover table-condensed ch-table">
                                    <thead>
                                    <tr>
                                        <th>Kode MK</th>
                                        <th>Matakuliah</th>
                                        <th>SKS</th>
                                        <th>Dosen</th>
                                        <th>Input Nilai</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(empty($mk_detail)) { echo"<tr><td colspan=\"4\"><div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button> Data Tidak Ada.</div></td></tr>";};
                                    foreach($mk_detail as $mk): ?>
                                        <tr id="<?php echo $mk['mk_id'];?>">
                                            <td><?php echo $mk['mk_kode'];?></td>
                                            <td><?php echo $mk['mk_nama'];?></td>
                                            <td><?php echo $mk['mk_sks'];?></td>
                                            <td><?php echo $mk['mk_dosen'];?></td>
                                            <td><a href="<?php echo base_url('nilai/input/'.$mk['mk_id'])?>">Input Nilai</a></td>
                                        </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                                <div class="row-fluid">
                                    <div class="span10">

                                    </div>
                                    <div class="span2">
                                        <a class="btn backToGroup"><i class="icon-chevron-left"></i>Kembali</a>
                                    </div>
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