<script>
    $(document).ready(function(){
        $("form#f_access").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url:$(this).attr('action'),
                dataType: "json",
                data: $(this).serialize(),
                cache:false,
                success: function(data){
                    //cloudfire.notification(data.message,{title:data.title,type:data.type});
                    $.pnotify({
                        title: data.title,
                        text: data.message,
                        type: data.type
                    });
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
<form class="ch-simple-form table" id="f_access" method="POST" action="<?php echo $access['action'] ?>">
    <fieldset>
        <legend>Access</legend>
        <table>
            <tr>
                <td><label>Nama Grup :</label></td>
                <td>
                    <select name="group_name">
                        <?php foreach($access['group_name'] as $group) :?>
                            <option value="<?php echo $group['group_name'] ?>"><?php echo $group['group_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Access Name</label></td>
                <td>
                    <select name="menu_access">
                        <?php foreach($access['menu_access'] as $menu) :?>
                            <option value="<?php echo $menu['menu_access'] ?>"><?php echo $menu['menu_title'] ?></option>
                        <?php endforeach ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="simpan" name="simpanAccess" class="btn btn-primary"></td>
            </tr>
        </table>
    </fieldset>
</form>