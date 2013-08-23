<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <script>
        function printTranskrip(){
            var head = '<html><head><title>Transkrip Matakuliah</title><link href="<?php echo site_url("assets/styles/app.print.css")?>" rel="stylesheet"><body>';
            var close = '</body></html>';
            var content = document.getElementById('transkrip_content').innerHTML;
            window.frames["transkrip_print_frame"].document.body.innerHTML = head + content + close ;
            window.frames["transkrip_print_frame"].window.focus();
            window.frames["transkrip_print_frame"].window.print();
        }
        $(document).ready(function(){
            $.pnotify({
                title: 'Saran Pencetakan',
                text: 'Untuk tampilan cetak terbaik, gunakan Google Chrome Web Browser',
                type: 'info'
            });
        });
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
                            <header>Transkrip</header>
                            <div class="ch-article-content">
                                <div id="khs_data">
                                    <div id="transkrip_content">
                                        <div class="frs_header">
                                            <img src="<?php echo site_url('assets/pictures/uyp-bw.png')?>">
                                            <h1>UNIVERSITAS YUDHARTA PASURUAN</h1>
                                            <p> Kampus : Jl. Yudharta No. 07 (Pesantren Ngalah), Purwosari-Pasuruan Telp/Fax. 0343 611186</p>
                                            <h1>Transkrip Nilai Mahasiswa</h1>
                                            <hr>
                                        </div>
                                        <table class="head-table">
                                            <tr>
                                                <td>Nama Mahasiswa</td>
                                                <td class="dotted"><?php echo $mhs['user_full_name']?></td>
                                            </tr>
                                            <tr>
                                                <td>Fakultas / Jurusan</td>
                                                <td class="dotted"><?php echo $mhs['fak_prod']?></td>
                                            </tr>
                                            <tr>
                                                <td>Nim</td>
                                                <td class="dotted"><?php echo $mhs['nim']?></td>
                                            </tr>
                                        </table>
                                    <table id="khs_detail"class="table table-condensed ch-table">
                                        <thead>
                                        <tr>
                                            <th>Kode MK</th>
                                            <th>Matakuliah</th>
                                            <th>SKS</th>
                                            <th colspan="2" style="text-align: center">Nilai</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(empty($transkrip)) { echo"<tr><td colspan=\"4\"><div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button> Data Tidak Ada.</div></td></tr>";};
                                        foreach($transkrip as $khs): ?>
                                            <tr id="<?php echo $khs['frs_id'];?>" <?php if($khs['frs_nilai_angka'] <= 69) { echo 'class="warning"';}elseif($khs['frs_nilai_angka'] >= 70 AND $khs['frs_nilai_angka'] <= 79){ echo 'class="info"';}?>>
                                                <td><?php echo $khs['mk_kode'];?></td>
                                                <td><?php echo $khs['mk_nama'];?></td>
                                                <td><?php echo $khs['mk_sks'];?></td>
                                                <td style="text-align: center"><?php echo $khs['frs_nilai_huruf'];?></td>
                                                <td style="text-align: center"><?php echo $khs['frs_nilai_angka'];?></td>
                                            </tr>
                                        <?php
                                        endforeach;
                                        $trans = countIpK($transkrip);
                                        ?>
                                        </tbody>
                                    </table>
                                    <table class="table table-condensed" style="width:50%">
                                        <tr>
                                            <th>Jumlah Matakuliah</th>
                                            <td><?php echo sizeof($transkrip)?></td>
                                        </tr>
                                        <tr>
                                            <th>Total SKS</th>
                                            <td><?php echo $trans['total_sks']?></td>
                                        </tr>
                                        <tr>
                                            <th>IPK</th>
                                            <td><?php echo $trans['ip']?></td>
                                        </tr>
                                        <tr>
                                            <th>Predikat</th>
                                            <td><?php echo predikat($trans['ip']) ?></td>
                                        </tr>
                                    </table>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span9">

                                            </div>
                                            <div class="span3 btn-group">
                                                <button class="btn" onclick="javascript:printTranskrip()"><i class="icon-print"></i> Cetak</button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </article>
                        <iframe id="printing-frame" name="transkrip_print_frame" src="about:blank" style="display:none;"></iframe>
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