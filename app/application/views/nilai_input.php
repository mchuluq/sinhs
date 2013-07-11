<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <script>
        $(document).ready(function(){
            $.sinhs.xForm('#input_nilai');
            $(".nilaiAngka").keyup(function(){
                var value = $(this).val();
                $(this).parent().parent().find('.nilaiHuruf').text($.sinhs.nilaiHuruf(value));
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
                            <header><i class="icon-plus"></i>Input Nilai</header>
                            <div class="ch-article-content">
                                <table class="table table-condensed table-bordered">
                                    <tr>
                                        <td>Semester :</td>
                                        <td><?php echo $mk['mk_semester']?></td>
                                        <td>Tahun Ajaran :</td>
                                        <td><?php echo $mk['mk_thn_ajar']?></td>
                                    </tr>
                                    <tr>
                                        <td>Matakuliah :</td>
                                        <td><?php echo $mk['mk_nama']?></td>
                                        <td>Dosen :</td>
                                        <td><?php echo $mk['mk_dosen']?></td>
                                    </tr>
                                    <tr>
                                        <td>SKS :</td>
                                        <td><?php echo $mk['mk_sks']?></td>
                                        <td>Kode MK :</td>
                                        <td><?php echo $mk['mk_kode']?></td>
                                    </tr>
                                    <tr>
                                        <td>Fakultas Prodi :</td>
                                        <td><?php echo $mk['mk_fak_prod']?></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                                <form id="input_nilai" method="POST" action="<?php echo base_url('nilai/input/'.$mk['mk_id'])?>">
                                <table class="table table-condensed ch-auto-submit" id="list_mhs">
                                    <thead>
                                    <tr>
                                        <td>NIM</td>
                                        <td>Mahasiswa</td>
                                        <td>Nilai Angka</td>
                                        <td>Nilai Huruf</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(empty($list)) echo '<tr><td colspan="5"><div class="alert"><button type="button" class="close backToStep1" data-dismiss="alert">&times;</button> Data tidak ada.</div></td></tr>';?>
                                    <?php foreach($list as $mhs):?>
                                        <tr>
                                            <td><?php echo $mhs['user_code'] ?></td>
                                            <td><?php echo $mhs['user_full_name'] ?><input type="hidden" name="frs_id[]" value="<?php echo $mhs['frs_id'] ?>"/></td>
                                            <td class="ch-tbl-editable">
                                                <span><?php echo $mhs['frs_nilai_angka'] ?></span>
                                                <input class="span12 nilaiAngka" type="text" name="frs_nilai_angka[]" value="<?php echo $mhs['frs_nilai_angka'] ?>">
                                            </td>
                                            <td class="nilaiHuruf"><?php echo $mhs['frs_nilai_huruf'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                                    <div class="btn-group" style="float:right;margin:5px;">
                                        <button type="submit" class="btn btn-primary"><i class="icn icon-ok-circle icon-white"></i> simpan</button>
                                    </div>
                                </form>
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