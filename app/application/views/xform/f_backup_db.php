<script>
    $(document).ready(function(){
        $.sinhs.xForm('#backup_db_form');
    })
</script>
<form id="backup_db_form" class="ch-simple-form table" action="<?php echo base_url('control/backup_db')?>" method="POST">
    <fieldset>
        <legend>Backup Database</legend>
    <table>
        <tr>
            <td>
                <div class="switch candy green" style="width:150px">
                    <input id="aktif" value="full" name="backup_type" type="radio" checked>
                    <label for="aktif" onclick="">Full</label>
                    <input id="non-aktif" value="partial" name="backup_type" type="radio">
                    <label for="non-aktif" onclick="">Partial</label>
                    <span class="slide-button"></span>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="create" value="Backup !" class="btn btn-primary">
            </td>
        </tr>
    </table>
        </fieldset>
</form>