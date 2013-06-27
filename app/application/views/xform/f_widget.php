<link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap-tagmanager.css" rel="stylesheet">
<script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap-tagmanager.js"></script>
<script>
    $(document).ready(function(){
        $.sinhs.xForm("form#f_widget");
    });
</script>
<form class="ch-simple-form table" id="f_widget" method="POST" action="<?php echo $action?>">
    <fieldset>
        <legend>Widget</legend>
        <table>
            <tr>
                <td><label>File name :</label></td>
                <td>
                    <input type="text" name="w_name" placeholder="nama file" value="<?php echo $widget['w_name']?>"/>
                    <span class="help-inline">.php</span>
                    <input type="hidden" name="w_id" value="<?php echo $widget['w_id']?>">
                </td>
            </tr>
            <tr>
                <td><label>Title :</label></td>
                <td><input type="text" name="w_title" placeholder="judul" value="<?php echo $widget['w_title']?>"/></td>
            </tr>
            <tr>
                <td><label>Group :</label></td>
                <td><input class="tm-input" type="text" name="tags_for"/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="simpan" name="simpanMenu" class="btn btn-primary"></td>
            </tr>
        </table>
    </fieldset>
</form>
<script>
    $(".tm-input").tagsManager({
        prefilled: <?php echo json_encode($widget['w_for'])?>,
        typeahead: true,
        typeaheadAjaxSource: null,
        typeaheadSource: <?php echo json_encode($group)?>,
        blinkBGColor_1: '#FFFF9C',
        blinkBGColor_2: '#CDE69C',
        hiddenTagListName: 'w_for'
    });
</script>