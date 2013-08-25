<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/toggle-switch.css')?>"/>
    <script>
        $(document).ready(function(){
            $.sinhs.xForm("#profile_form");
            $.sinhs.xForm("#password_form");
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
                        <article class="ch-article span6">
                            <header>Pengaturan Akun Anda</header>
                            <div class="ch-article-content">
                                <form id="profile_form" class="ch-form full" action="<?php echo base_url('account/profile')?>" method="POST">
                                    <table style="width:100%">
                                        <tr>
                                            <td><label for="user_code">Nomor Induk</label></td>
                                            <td><input type="text" class="span12" name="user_code" id="user_code" value="<?php echo $user_data->user_code?>" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><label for="user_full_name">Nama Lengkap</label></td>
                                            <td><input type="text" class="span12" name="user_full_name" id="user_full_name" value="<?php echo $user_data->user_full_name?>" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><label for="user_name">User name :</label></td>
                                            <td>
                                                <input class="span12" type="text" id="user_name" name="user_name" value="<?php echo $user_data->user_name?>" placeholder="user17" required>
                                                <span class="form_hint">nama pengguna untuk login aplikasi</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="user_contact">No. Kontak :</label></td>
                                            <td>
                                                <input class="span12" type="text" id="user_contact" name="user_contact" value="<?php echo $user_data->user_contact?>" placeholder="085*******">
                                                <span class="form_hint">nomor telepon yang dapat dihubungi</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="user_email">Alamat Email :</label></td>
                                            <td>
                                                <input class="span12" type="email" id="user_email" name="user_email" value="<?php echo $user_data->user_email?>" placeholder="jokoSama37@example.com">
                                                <span class="form_hint">alamat email yang dapat dihubungi</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input type="submit" name="save_user" value="perbarui" class="btn btn-success">
                                                <input type="reset" name="reset_user" value="batal" class="btn">
                                             </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </article>
                        <article class="ch-article span6">
                            <header>Pengaturan Password Anda</header>
                            <div class="ch-article-content">
                                <form id="password_form" class="ch-form full" action="<?php echo base_url('account/password')?>" method="POST">
                                    <table style="width:100%">
                                        <tr>
                                            <td><label for="pass_old">Password Lama Anda</label></td>
                                            <td><input class="span12" type="password" id="pass_old" name="pass_old" required></td>
                                        </tr>
                                        <tr>
                                            <td><label for="pass_new1">Password Baru</label></td>
                                            <td>
                                                <input class="span12" type="password" id="pass_new1" name="pass_new1" required>
                                                <span class="form_hint">minimal 6 karakter, maksimal 20 karakter</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="pass_new2">Ulangi Password Baru</label></td>
                                            <td><input class="span12" type="password" id="pass_new2" name="pass_new2" required></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input type="submit" name="save_user" value="perbarui" class="btn btn-success">
                                                <input type="reset" name="reset_user" value="batal" class="btn">
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
<?php echo $_bscript;?>
</body>
</html>