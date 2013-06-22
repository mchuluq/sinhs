<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/toggle-switch.css')?>"/>
    <script>
        $(document).ready(function(){
            $.sinhs.xForm("#user_form");
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
                            <header><?php echo $user['title'] ?></header>
                            <div class="ch-article-content">
                                <form id="user_form" class="ch-form" action="<?php echo $user['action']?>" method="POST">
                                    <table>
                                        <tr>
                                            <td><label>Nomor Induk :</label></td>
                                            <td><input type="text" name="user_code" value="<?php echo $user['u_code']?>"placeholder="nomor induk"></td>
                                            <td><input type="hidden" name="user_id" value="<?php echo $user['u_id']?>"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Nama Lengkap :</label></td>
                                            <td><input type="text" name="user_full_name" value="<?php echo $user['u_f_name']?>" placeholder="nama lengkap"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Grup :</label></td>
                                            <td>
                                                <select name="group_name">
                                                <?php foreach($glist as $group):?>
                                                    <option value="<?php echo $group['group_name'];?>" <?php if($group['group_name']==$user['g_name']) echo "selected"?>><?php echo $group['group_name'];?></option>
                                                <?php endforeach;?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Status :</label></td>
                                            <td>
                                                <div class="switch candy green" style="width:150px">
                                                    <input id="aktif" value="1" name="user_status" type="radio" <?php if($user['u_stat']==1) echo "checked"?>>
                                                    <label for="aktif" onclick="">Aktif</label>
                                                    <input id="non-aktif" value="0" name="user_status" type="radio" <?php if($user['u_stat']==0) echo "checked"?>>
                                                    <label for="non-aktif" onclick="">Non Aktif</label>
                                                    <span class="slide-button"></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input type="submit" name="save_user" value="simpan" class="btn btn-primary">
                                                <input type="reset" name="reset_user" value="reset" class="btn">
                                            </td>
                                        </tr>
                                    </table>
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