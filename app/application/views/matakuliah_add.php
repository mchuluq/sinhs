<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <script>
        function addField(){
            var field = '<tr>'+
                '<td><input class="span12" type="text" name="mk_kode[]" id="mk_kode"></td>'+
                '<td><input class="span12" type="text" name="mk_nama[]" id="mk_nama" required></td>'+
                '<td><input class="span12" type="number" name="mk_sks[]" id="mk_sks" required></td>'+
                '<td><input class="span12" type="text" name="mk_dosen[]" id="mk_dosen" data-provide="typeahead" autocomplete="off" data-items="4" data-source=\'[<?php echo implode(",",$dsnl)?>]\'></td>'+
                '<td><a class="btn del-field" onclick="javascript:$(this).parent().parent().remove()">hapus</a></td>'
                '</tr>';
            $("#mk_detail tbody").append(field);
        }
        $(document).ready(function(){
            addField();
            $.sinhs.xForm('#matkul_form');
            $('#add-field').click(function(){
                addField();
            });
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
                            <header><i class="icon-plus"></i>Tambah Matakuliah</header>
                            <div class="ch-article-content">
                                <form id="matkul_form" method="POST" action="<?php echo base_url('matakuliah/add')?>">
                                    <fieldset>
                                        <legend>Data Umum</legend>
                                        <table class="table table-condensed">
                                            <tr>
                                                <td><label for="mk_semester">Semester :</label></td>
                                                <td><input type="number" name="mk_semester" id="mk_semester" placeholder="5" class="span12" required></td>
                                                <td><label for="mk_thn_ajar">Tahun Ajaran</label></td>
                                                <td><input type="text" maxlength="9" name="mk_thn_ajar" id="mk_thn_ajar" placeholder="2013/2014" class="span12" required></td>
                                            </tr>
                                            <tr>
                                                <td><label for="mk_fak_prod">Fakultas / Prodi :</label></td>
                                                <td>
                                                    <select name="mk_fak_prod" class="span12">
                                                        <?php foreach($fpl as $fp):?>
                                                        <option value="<?php echo $fp['fp_fak_prodi']?>"><?php echo $fp['fp_fak_prodi']?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Data Matakuliah</legend>
                                        <table class="table table-condensed" id="mk_detail">
                                            <thead>
                                            <tr>
                                                <td><label for="mk_kode">Kode MK</label></td>
                                                <td><label for="mk_nama">Matakuliah</label></td>
                                                <td><label for="mk_sks">SKS</label></td>
                                                <td><label for="mk_dosen">Dosen</label></td>
                                                <td></td>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </fieldset>
                                    <div class="btn-group" style="float:right;margin:5px;">
                                        <input type="submit" class="btn"value="simpan">
                                        <input type="reset" class="btn"value="reset">
                                        <a id="add-field" accesskey="a" class="btn"><i class="icn icon-plus"></i>Tambah</a>
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
<?php echo $_bscript;?>
</body>
</html>