<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
<script>
    function deleteWidget(id){
        alertify.confirm('Apakah anda ingin menghapus widget ini ?',function(r) {
            if(r){
                $.ajax({
                    url: "<?php echo base_url('control/widget/drop')?>"+"/"+id,
                    dataType: "json",
                    success:function(data){
                        //cloudfire.notification(data.message,{title:data.title,type:data.type});
                        $.pnotify({
                            title: data.title,
                            text: data.message,
                            type: data.type
                        });
                    }
                });
            }else{
                return false
            };
        });
    }

    $(document).ready(function(){
        $("a.add-widget").click(function(){
            event.preventDefault();
            $.sinhs.xModal($(this).attr('href'));
        })

        $("table#widget_table tbody tr").contextMenu({
            menu: 'widget_menu'
        }, function(action, el, pos) {
            var act = action;
            if(act=='add'){
                $.sinhs.xModal("<?php echo base_url('control/widget/add')?>");
            }else if(act=='edit'){
                $.sinhs.xModal("<?php echo base_url('control/widget/edit')?>"+"/"+$(el).attr('id'));
            } else if(act=='drop'){
                deleteWidget($(el).attr('id'));
            }
        });
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
                            <header>Widget Manager</header>
                            <div class="ch-article-content">
                                <table id="widget_table" class="table table-striped table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th>File name</th>
                                        <th>Widget Title</th>
                                        <th>For</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach($widget_list as $wid): ?>
                                    <tr id="<?php echo $wid['w_id']?>">
                                        <td><?php echo $wid['w_name']?></td>
                                        <td><?php echo $wid['w_title']?></td>
                                        <td><?php echo $wid['w_for']?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="row-fluid">
                                    <div class="span9">
                                    </div>
                                    <div class="span3 btn-group">
                                        <a class="btn btn-primary add-widget" href="<?php echo base_url('control/widget/add')?>"><i class="icn icon-plus-sign icon-white"></i> Tambah Widget Baru</a>
                                    </div>
                                </div>
                                <div class="row-fluid">
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
    <!---->
</div>
<ul class="ch-contextmenu" id="widget_menu">
    <li><a href="#add">Tambah</a></li>
    <li class="separator"><a href="#edit">Ubah</a></li>
    <li><a href="#drop">Hapus</a></li>
</ul>
</body>
</html>