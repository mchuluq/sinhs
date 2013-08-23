<script>
    $(document).ready(function(){
        $.sinhs.ajaxForm('#frs_step1','#frs_wizard');
    })
</script>
<?php if(validation_errors()){ ?>
    <div class="alert">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <?php echo validation_errors()?>
    </div>
<?php } ?>
<form id="frs_step1" method="POST" action="<?php echo base_url('frs/create/step2')?>">
    <fieldset>
        <legend>Masukkan data semester</legend>
        <table class="table table-condensed">
            <tr>
                <td><label for="frs_semester">Semester :</label></td>
                <td><input type="number" name="frs_semester" id="frs_semester" placeholder="5" class="span12" value="<?php echo $nSmtr['smtr']?>" required></td>
                <td><label for="frs_thn_ajar">Tahun Ajaran</label></td>
                <td><input type="text" maxlength="9" name="frs_thn_ajar" id="frs_thn_ajar" placeholder="2013/2014" class="span12" value="<?php echo $nSmtr['thn_ajar']?>" required></td>
            </tr>
        </table>
    </fieldset>
    <div class="btn-group" style="float:right;margin:5px;">
        <input type="submit" class="btn"value="Berikutnya">
        <input type="reset" class="btn"value="reset">
    </div>
</form>