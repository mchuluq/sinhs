<script>
    function browseMk(){
        var fak_prod = "<?php echo $fak_prod ?>",
            semester = $('#frs_semester').val(),
            thn_ajar = $('#frs_thn_ajar').val();
        $.sinhs.xModal("<?php echo base_url('frs/create/browseMk')?>"+'/'+semester+'/'+thn_ajar+'/'+fak_prod);
    }
   $(document).ready(function(){
       $('#add-mk').click(function(e){
           e.preventDefault();
           browseMk();
       });
       $('.backToStep1').click(function(e){
           e.preventDefault();
           $("#frs_wizard").load("<?=base_url('frs/create/step1')?>");
       });
       $.sinhs.xForm('#frs_step2');
   });
</script>
<form id="frs_step2" method="POST" action="<?php echo base_url('frs/create/step3')?>">
        <table class="table table-condensed">
            <tr>
                <td><label for="frs_semester">Semester :</label></td>
                <td><input type="number" name="frs_semester" id="frs_semester" placeholder="5" class="span12" value="<?php echo $semester; ?>" required readonly></td>
                <td><label for="frs_thn_ajar">Tahun Ajaran</label></td>
                <td><input type="text" maxlength="9" name="frs_thn_ajar" id="frs_thn_ajar" placeholder="2013/2014" class="span12" value="<?php echo $thn_ajar; ?>" required readonly></td>
            </tr>
        </table>
        <table class="table table-condensed" id="mk_detail">
            <thead>
            <tr>
                <td></td>
                <td>Kode MK</td>
                <td>Matakuliah</td>
                <td>SKS</td>
                <td>Dosen</td>
                <td><label for="frs_keterangan">Keterangan</label></td>
            </tr>
            </thead>
            <tbody>
            <?php if(empty($mkl)) echo '<tr><td colspan="5"><div class="alert"><button type="button" class="close backToStep1" data-dismiss="alert">&times;</button> Data Untuk Tahun Ajaran '.$thn_ajar.' semester '.$semester.' Jurusan '.$fak_prod.' tidak tersedia.</div></td></tr>';?>
            <?php foreach($mkl as $mk):?>
            <tr>
                <td><input type="checkbox" name="mkt[]" value="TRUE" checked></td>
                <td>
                    <span><?php echo $mk['mk_kode'] ?></span>
                    <input type="hidden" name="mk_id[]" value="<?php echo $mk['mk_id'] ?>">
                </td>
                <td><?php echo $mk['mk_nama'] ?></td>
                <td>
                    <span><?php echo $mk['mk_sks'] ?></span>
                    <input type="hidden" name="sks[]" value="<?php echo $mk['mk_sks'] ?>">
                </td>
                <td><?php echo $mk['mk_dosen'] ?></td>
                <td><input type="text" id="frs_keterangan" name="frs_keterangan[]" class="span12"></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <div class="btn-group" style="float:right;margin:5px;">
        <input type="submit" class="btn"value="simpan">
        <input type="reset" class="btn"value="reset">
        <a id="add-mk" accesskey="a" class="btn"><i class="icn icon-plus"></i>Tambah</a>
        <a class="btn backToStep1"><i class="icn icon-circle-arrow-left"></i>Kembali</a>
    </div>
</form>