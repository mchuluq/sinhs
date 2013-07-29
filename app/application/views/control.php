<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/toggle-switch.css')?>">
    <script>
        $(document).ready(function(){
            $('.control-modal').click(function(e){
                e.preventDefault();
                $.sinhs.xModal($(this).attr('href'));
            })
        });
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
                            <header><i class="icon-fire"></i>Control Panel</header>
                            <div class="ch-article-content ch-control-panel">
                                <div class="row-fluid">
                                    <a class="span4" href="<?php echo base_url('control/explorer')?>">
                                        <i class="cp-explorer"></i>
                                        <h5>Explorer <small>Penjelajah File</small></h5>
                                    </a>
                                    <a class="span4" href="<?php echo base_url('control/uac')?>">
                                        <i class="cp-uac"></i>
                                        <h5>User Access Control <small>Pengaturan Hak Akses Grup dan Menu</small></h5>
                                    </a>
                                    <a class="span4 control-modal" href="<?php echo base_url('control/backup_db')?>">
                                        <i class="cp-backup_db"></i>
                                        <h5>Backup DB <small>Buat Cadangan DataBase</small></h5>
                                    </a>
                                </div>
                                <div class="row-fluid">
                                    <a class="span4 control-modal" href="<?php echo base_url('control/backup_system')?>">
                                        <i class="cp-backup_system"></i>
                                        <h5>Backup System <small>Buat Cadangan File System</small></h5>
                                    </a>
                                    <a class="span4" href="<?php echo base_url('control/widget')?>">
                                        <i class="cp-widget_man"></i>
                                        <h5>Widget Manager <small>Pengaturan widget</small></h5>
                                    </a>
                                </div>
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