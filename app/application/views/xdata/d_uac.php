<script>
    //data process
    function addGroup(){
        $.sinhs.xModal("<?=base_url('control/uac/agrup')?>")
    }
    function updateGroup(id){
        $.sinhs.xModal("<?=base_url('control/uac/ugrup')?>"+"/"+id);
    }
    function deleteGroup(id){
        cloudfire.confirm('Apakah anda ingin menghapus grup '+id+' ?',function(r) {
            if(r){
                $.ajax({
                    url: "<?=base_url('control/uac/dgrup')?>"+"/"+id,
                    dataType: "json",
                    success:function(data){
                        cloudfire.notification(data.message,{title:data.title,type:data.type});
                        $("#uac-content").load("<?=base_url('control/uac/view')?>");
                    }
                });
            }else{
                return false
            };
        });
    }

    function addMenu(){
        $.sinhs.xModal("<?=base_url('control/uac/amenu')?>");
    }
    function updateMenu(id){
        $.sinhs.xModal("<?=base_url('control/uac/umenu')?>"+"/"+id);
    }
    function deleteMenu(id){
        cloudfire.confirm('Apakah anda ingin menghapus menu ini ?',function(r) {
            if(r){
                $.ajax({
                    url: "<?=base_url('control/uac/dmenu')?>"+"/"+id,
                    dataType: "json",
                    success:function(data){
                        cloudfire.notification(data.message,{title:data.title,type:data.type});
                        $("#uac-content").load("<?=base_url('control/uac/view')?>");
                    }
                });
            }else{
                return false
            };
        });
    }

    function addAccess(){
        $.sinhs.xModal("<?=base_url('control/uac/aaccess')?>");
    }
    function deleteAccess(id){
        cloudfire.confirm('Apakah anda ingin menghapus akses ini ?',function(r) {
            if(r){
                $.ajax({
                    url: "<?=base_url('control/uac/daccess')?>"+"/"+id,
                    dataType: "json",
                    success:function(data){
                        cloudfire.notification(data.message,{title:data.title,type:data.type});
                        $("#uac-content").load("<?=base_url('control/uac/view')?>");
                    }
                });
            }else{
                return false
            };
        });
    }

    $(document).ready(function(){
        $.sinhs.collapsible();
        $("a.reloader").click(function(){
            $("#uac-content").load("<?=base_url('control/uac/view')?>");
        })

        //form trigger
        $('#group_form').click(function(){
            addGroup();
        });
        $('#menu_form').click(function(){
            addMenu();
        });
        $('#access_form').click(function(){
            addAccess();
        });

        //context menu
        $(".group-name").contextMenu({
            menu: 'group_menu'
        }, function(action, el, pos) {
            var act = action;
            if(act=='add-group'){
                addGroup();
            } else if(act=='update-group'){
                updateGroup($(el).parent().parent().attr('id'));
            } else if(act=='del-group'){
                deleteGroup($(el).parent().parent().attr('id'));
            };
        });
        $("ul.group-access li").contextMenu({
            menu: 'access_menu'
        }, function(action, el, pos) {
            var act = action;
            if(act=='add-access'){
                addAccess();
            } else if(act=='del-access'){
                deleteAccess($(el).attr('id'));
            };
        });
        $("#grup_menu table tbody tr").contextMenu({
            menu: 'menu_menu'
        }, function(action, el, pos) {
            var act = action;
            if(act=='add-menu'){
                addMenu();
            } else if(act=='update-menu'){
                updateMenu($(el).attr('id'));
            }else if(act=='del-menu'){
                deleteMenu($(el).attr('id'));
            };
        });

        //ui tab
        $('#grup_tab a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        })
    })
    $(function () {
        $('#grup_tab a:first').tab('show');
    });

</script>
<ul class="nav nav-tabs" id="grup_tab">
    <li><a href="#grup_akses" data-toggle="tab">Grup dan Hak Akses</a></li>
    <li><a href="#grup_menu" data-toggle="tab">Menu</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane" id="grup_akses">
        <div id="ch-content-coll">
            <?php foreach($groups as $group) : ?>
                <div class="ch-sub-coll" id="<?php echo str_replace(' ','-',$group['group_name'])?>">
                    <div class="ch-coll-title"><?php echo $group['group_name']?></div>
                    <div class="ch-coll-content">
                        <div class="ch-coll-left group-name">
                            deskripsi : <?php echo $group['group_desc']?> <br/>
                            total user : <?php echo $group['total_users']?>
                        </div>
                        <ul class="ch-coll-list group-access">
                            <?php
                            $ata = $this->uac->groupAccess($group['group_name']);
                            foreach($ata as $row){?>
                                <li id="<?php echo $row['access_id'] ?>"><?php echo $row['menu_title'] ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="tab-pane" id="grup_menu">
        <table class="table table-striped table-hover table-condensed ch-table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Class</th>
                <th>Method</th>
                <th>Parameter</th>
                <th>Access Name</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($menus as $menu):?>
                <tr id="<?php echo $menu['menu_id']?>" class="<?php if($menu['menu_show']=='1') echo "aktif"; else echo "non-aktif"?>">
                    <td><?php echo $menu['menu_title']?></td>
                    <td><?php echo $menu['menu_class']?></td>
                    <td><?php echo $menu['menu_method']?></td>
                    <td><?php echo $menu['menu_param']?></td>
                    <td><?php echo $menu['menu_access']?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<div class="btn-group" style="float:right;margin:5px">
    <a id="group_form" class="btn btn-primary"><i class="icn icon-plus-sign icon-white"></i> Tambah Grup</a>
    <a id="access_form" class="btn"><i class="icn icon-plus-sign"></i> Tambah Hak Akses</a>
    <a id="menu_form" class="btn"><i class="icn icon-plus-sign"></i> Tambah Menu</a>
    <a class="btn reloader"><i class="icn icon-refresh"></i> Muat Ulang</a>
</div>
<ul class="ch-contextmenu" id="group_menu">
    <li><a href="#add-group">Tambah Grup</a></li>
    <li class="separator"><a href="#update-group">Ubah Grup</a></li>
    <li><a href="#del-group"><i class="icn icon-trash"></i> Hapus Grup</a></li>
</ul>
<ul class="ch-contextmenu" id="access_menu">
    <li><a href="#add-access">Tambah Hak Akses</a></li>
    <li><a href="#del-access"><i class="icn icon-trash"></i> Hapus Hak Akses</a></li>
</ul>
<ul class="ch-contextmenu" id="menu_menu">
    <li><a href="#add-menu">Tambah</a></li>
    <li class="separator"><a href="#update-menu">Ubah</a></li>
    <li><a href="#del-menu"><i class="icn icon-trash"></i> Hapus</a></li>
</ul>