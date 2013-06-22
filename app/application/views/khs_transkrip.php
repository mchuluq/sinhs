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
                        <article class="ch-article span12">
                            <header>Transkrip</header>
                            <div class="ch-article-content">
                                <div id="khs_data">
                                    <table id="khs_detail"class="table table-striped table-condensed ch-table">
                                        <thead>
                                        <tr>
                                            <th>Kode MK</th>
                                            <th>Matakuliah</th>
                                            <th>SKS</th>
                                            <th>Nilai</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(empty($transkrip)) { echo"<tr><td colspan=\"4\"><div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button> Data Tidak Ada.</div></td></tr>";};
                                        foreach($transkrip as $khs): ?>
                                            <tr id="<?php echo $khs['frs_id'];?>">
                                                <td><?php echo $khs['mk_kode'];?></td>
                                                <td><?php echo $khs['mk_nama'];?></td>
                                                <td><?php echo $khs['mk_sks'];?></td>
                                                <td><?php echo $khs['frs_nilai_huruf'];?></td>
                                                <td><?php echo $khs['frs_nilai_angka'];?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4">Jumlah Mata kuliah :</th>
                                                <th><?php echo sizeof($transkrip)?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
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