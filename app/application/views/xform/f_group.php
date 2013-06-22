<script>
    $(document).ready(function(){
        $("form#f_group").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url:$(this).attr('action'),
                dataType: "json",
                data: $(this).serialize(),
                cache:false,
                success: function(data){
                    cloudfire.notification(data.message,{title:data.title,type:data.type});
                    if(data.type == 'success'){
                        $.sinhs.close_modal();
                        $("#uac-content").load("<?=base_url('control/uac/view')?>");
                    }
                }
            });
            return false;
        });
    });
</script>
<form class="ch-simple-form table" id="f_group" method="POST" action="<?php echo $grup['action'] ?>">
    <fieldset>
        <legend>Grup</legend>
        <table>
            <tr>
                <td><label>Nama Grup :</label></td>
                <td><input placeholder="nama grup" type="text" name="groupName" value="<?php echo $grup['g_name']?>" <?php if(!empty($group['g_name'])) echo 'readonly'  ?> ></td>
            </tr>
            <tr>
                <td><label>Deskripsi Grup :</label></td>
                <td><textarea placeholder="deskripsi grup" name="groupDesc"><?php echo $grup['g_desc']?></textarea></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" value="simpan" name="simpanGroup" class="btn btn-primary"></td>
            </tr>
        </table>
    </fieldset>
</form>