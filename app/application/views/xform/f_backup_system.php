<script>
    $(document).ready(function(){
        $.sinhs.xForm('#backup_system_form');
    })
</script>
<form id="backup_system_form" class="ch-simple-form table" action="<?php echo base_url('control/backup_system')?>" method="POST">
    <fieldset>
        <legend>Backup System</legend>
    <table>
        <tr>
            <td>
                <div class="switch candy green" style="width:230px">
                    <input id="aktif" value="app" name="backup_type" type="radio" checked>
                    <label for="aktif" onclick="">application folder</label>
                    <input id="non-aktif" value="assets" name="backup_type" type="radio">
                    <label for="non-aktif" onclick="">assets</label>
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