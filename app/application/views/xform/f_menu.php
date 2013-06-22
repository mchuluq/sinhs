<script>
    $(document).ready(function(){
        $("form#f_menu").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
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
<form class="ch-simple-form table"id="f_menu" method="POST" action="<?php echo $menu['action'] ?>">
    <fieldset>
        <legend>Menu</legend>
        <table>
            <tr>
                <td><label>Nama Menu :</label></td>
                <td>
                    <input type="text" name="menu_title" placeholder="menu" value="<?php echo $menu['menu_title']?>"/>
                    <input type="hidden" name="menu_id" value="<?php echo $menu['menu_id']?>">
                </td>
            </tr>
            <tr>
                <td><label>Class Menu :</label></td>
                <td><input type="text" name="menu_class" placeholder="Class" value="<?php echo $menu['menu_class']?>"/></td>
            </tr>
            <tr>
                <td><label>Method Menu :</label></td>
                <td><input type="text" name="menu_method" placeholder="Method" value="<?php echo $menu['menu_method']?>"/></td>
            </tr>
            <tr>
                <td><label>Parameter Menu :</label></td>
                <td><input type="text" name="menu_param" placeholder="parameter1/parameter2" value="<?php echo $menu['menu_param']?>"/></td>
            </tr>
            <tr>
                <td><label>Nama Access :</label></td>
                <td><input type="text" name="menu_access" placeholder="class/method/parameter1/" value="<?php echo $menu['menu_access']?>"/></td>
            </tr>
            <tr>
                <td><label>tampilkan menu :</label></td>
                <td>
                    <div class="switch candy green" style="width:150px">
                        <input id="aktif" value="1" name="menu_show" type="radio" <?php if($menu['menu_show']=='1') echo "checked"?>>
                        <label for="aktif" onclick="">tampil</label>
                        <input id="non-aktif" value="0" name="menu_show" type="radio" <?php if($menu['menu_show']=='0') echo "checked"?>>
                        <label for="non-aktif" onclick="">sembunyi</label>
                        <span class="slide-button"></span>
                    </div></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="simpan" name="simpanMenu" class="btn btn-primary"></td>
            </tr>
        </table>
    </fieldset>
</form>