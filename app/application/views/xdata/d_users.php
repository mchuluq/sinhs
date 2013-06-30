<script>
    function loadCurrentData(){
        var current_url = "<?php echo base_url($this->uri->uri_string())?>";
        $.ajax({
            url: current_url,
            success:function(data){
                $('#list_users').html(data);
            }
        });
    }
    function loadData(url){
        var cari = $("input#searchbox").val();
        var safe = cari.replace(/\s/g,"");
        var limit = $("select#limitbox").val();
            $.ajax({
            url: url+"/"+limit+"/"+ safe,
            success:function(data){
                $('#list_users').html(data);
            }
        });
    }
    function changeStatus(id){
        event.preventDefault();
        $.ajax({
            url:"<?php echo base_url('users/index/status')?>"+"/"+id,
            dataType: "json",
            success: function(data){
                //cloudfire.notification(data.message,{title:data.title,type:data.type});
                $.pnotify({
                    title: data.title,
                    text: data.message,
                    type: data.type
                });
                if(data.type == 'success'){
                    loadCurrentData();
                }
            }
        });
        return false;
    }
    function deleteUser(id){
        alertify.confirm('Apakah anda ingin menghapus user ini ?',function(r) {
            if(r){
                $.ajax({
                    url: "<?php echo base_url('users/index/delete')?>"+"/"+id,
                    dataType: "json",
                    success:function(data){
                        //cloudfire.notification(data.message,{title:data.title,type:data.type});
                        $.pnotify({
                            title: data.title,
                            text: data.message,
                            type: data.type
                        });
                        if(data.type=='success'){
                            loadCurrentData();
                        }
                    }
                });
            }else{
                return false
            };
        });
    }

    $(document).ready(function(){
        $(".ch-pagination a").click(function(e){
            e.preventDefault();
            var offset = $(this).attr('id');

            if(offset != undefined){
                var url = "<?php echo base_url('users/index/all')?>"+"/"+offset;
                loadData(url);
            }
        })
        $("#list_users table thead tr td a").click(function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            if(url != undefined){
                loadData(url);
            }
        })
        $("#formSearch").submit(function(e){
            e.preventDefault;
            loadData("<?php echo base_url('users/index/all/0');?>");
            return false;
        })

        $("table#users_data tbody tr").contextMenu({
            menu: 'menu_menu'
        }, function(action, el, pos) {
            var act = action;
            if(act=='add-user'){
                document.location = "<?php echo base_url('users/add');?>";
            }else if(act=='update-user'){
                document.location = "<?php echo base_url('users/update/default');?>"+"/"+$(el).attr('id');
            } else if(act=='change'){
                changeStatus($(el).attr('id'));
            }else if(act=='del-user'){
                deleteUser($(el).attr('id'));
            };
        });
    })
</script>
<table id="users_data"class="table table-striped table-hover table-condensed ch-table">
    <thead>
    <tr>
        <th>Nomor Induk</th>
        <th>Nama Lengkap</th>
        <th>Grup</th>
        <th>terakhir login</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(empty($users)) { echo"<tr><td colspan=\"6\"><div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button> Data Tidak Ada.</div></td></tr>";};
    foreach($users as $user): ?>
        <tr id="<?php echo $user['user_id'];?>" class="<?php $status = ($user['user_status']==1) ? "aktif" : "non-aktif"; echo $status?>">
            <td><?php echo $user['user_code'];?></td>
            <td><?php echo $user['user_full_name'];?></td>
            <td><?php echo $user['group_name'];?></td>
            <td><?php echo mysql_to_human($user['user_last_login']);?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<div class="row-fluid">
    <div class="span12" style="text-align:center;">
        <?php echo $pagination ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span9 ch-pagination-total">
        <?php echo $total ?>
    </div>
    <div class="span3 btn-group">
        <a class="btn btn-primary" href="<?php echo base_url('users/add')?>">Tambah User Baru</a>
        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('users/index/dosen')?>"><i class="icon-align-justify"></i> Data Dosen</a></li>
            <li><a href="<?php echo base_url('users/add/dosen')?>"><i class="icon-plus"></i> Tambah Dosen</a></li>
            <li><a href="<?php echo base_url('users/index/mahasiswa')?>"><i class="icon-align-justify"></i> Data Mahasiswa</a></li>
            <li><a href="<?php echo base_url('users/add/mahasiswa')?>"><i class="icon-plus"></i> Tambah Mahasiswa</a></li>
        </ul>
    </div>
</div>

<ul class="ch-contextmenu" id="menu_menu">
    <li><a href="#add-user">Tambah</a></li>
    <li><a href="#update-user">Ubah</a></li>
    <li class="separator"><a href="#change">Non Aktif / Aktif</a></li>
    <li><a href="#del-user"><i class="icn icon-trash"></i> Hapus</a></li>
</ul>