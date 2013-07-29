<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <script>
        $(document).ready(function(){
            $('a.backToGroup').click(function(){
                history.back();
            })
            $.pnotify({
                title: 'Saran Pencetakan',
                text: 'Untuk tampilan cetak terbaik, gunakan Google Chrome Web Browser',
                type: 'info'
            });
        })
        function printKhs(){
            var head = '<html><head><title>KHS</title><link href="<?php echo site_url("assets/styles/app.print.css")?>" rel="stylesheet"><body>';
            var close = '</body></html>';
            var content = document.getElementById('khs_content').innerHTML;
            window.frames["khs_print_frame"].document.body.innerHTML = head + content + close ;
            window.frames["khs_print_frame"].window.focus();
            window.frames["khs_print_frame"].window.print();
        }
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
                                <div id="khs_content">
                                <div class="khs_header">
                                    <img src="<?php echo site_url('assets/pictures/uyp-bw.png')?>">
                                    <div style="display:block;height:auto;width:auto">
                                    <h1>UNIVERSITAS YUDHARTA PASURUAN</h1>
                                    <h1>FAKULTAS TEKNIK</h1>
                                    <h1>KARTU HASIL STUDI (KHS) MAHASISWA</h1>
                                    <h1>Semester <?php if($khs['frs_semester'] % 2){ echo "GENAP ";}else{echo "GASAL ";}; echo $khs['frs_thn_ajar'] ?></h1>
                                    </div>
                                </div>
                                    <hr>
                                <table class="khs_for">
                                    <tr>
                                        <td>Nama </td>
                                        <td>: <?php echo $khs['user_full_name']?></td>
                                        <td>Fakultas </td>
                                        <td>: Teknik</td>
                                    </tr>
                                    <tr>
                                        <td>NIM </td>
                                        <td>: <?php echo $khs['user_code']?></td>
                                        <td>PRODI</td>
                                        <td>: <?php echo $khs['frs_fak_prod']?></td>
                                    </tr>
                                    <tr>
                                        <td>Semester</td>
                                        <td>: <?php echo $khs['frs_semester']?></td>
                                        <td>T.A </td>
                                        <td>: <?php echo $khs['frs_thn_ajar']?></td>
                                    </tr>
                                </table>
                                    <hr>
                                <table id="khs_detail"class="table table-striped table-condensed ch-table">
                                    <thead>
                                    <tr>
                                        <th>Kode MK</th>
                                        <th>Matakuliah</th>
                                        <th>SKS</th>
                                        <th>Nilai</th>
                                        <th>SKSN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(empty($khs_detail)) { echo"<tr><td colspan=\"4\"><div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button> Data Tidak Ada.</div></td></tr>";};
                                    $ips = countIpS($khs_detail);
                                    $ipk = countIpK($transkrip);
                                    foreach($khs_detail as $khs):
                                        ?>
                                        <tr id="<?php echo $khs['frs_id'];?>">
                                            <td><?php echo $khs['mk_kode'];?></td>
                                            <td><?php echo $khs['mk_nama'];?></td>
                                            <td><?php echo $khs['mk_sks'];?></td>
                                            <td><?php echo $khs['frs_nilai_huruf'];?></td>
                                            <td><?php echo nilaiSksn($khs['frs_nilai_huruf'],$khs['mk_sks']);?></td>
                                        </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="2"><b>Total</b></th>
                                        <th><?php echo $ips['total_sks']?></th>
                                        <th>&nbsp;</th>
                                        <th><?php echo $ips['total_sksn']?></th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <table class="ip-stat" style="width:30%">
                                    <tr>
                                        <td>Indeks Prestasi</td>
                                        <td><?php echo $ips['ip']?></td>
                                    </tr>
                                    <tr>
                                        <td>IPK</td>
                                        <td><?php echo $ipk['ip']?></td>
                                    </tr>
                                </table>
                                </div>
                                <iframe id="printing-frame" name="khs_print_frame" src="about:blank" style="display:none;"></iframe>
                                <div class="row-fluid">
                                    <div class="span9">

                                    </div>
                                    <div class="span3 btn-group">
                                        <a class="btn backToGroup"><i class="icon-chevron-left"></i> Kembali</a>
                                        <a class="btn" onclick="javascript:printKhs()"><i class="icon-print"></i> Cetak</a>
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
<?php echo $_bscript;?>
</body>
</html>