<script>
    function print(){
        var head = '<html><head><title>Data Mahasiswa</title><link href="<?php echo site_url("assets/styles/app.print.css")?>" rel="stylesheet"><body>';
        var close = '</body></html>';
        var content = document.getElementById('print_content').innerHTML;
        window.frames["print_frame"].document.body.innerHTML = head + content + close ;
        window.frames["print_frame"].window.focus();
        window.frames["print_frame"].window.print();
    }
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
                    loadCurrentData()
                }
            }
        });
        return false;
    }
    $(document).ready(function(){
        $.pnotify({
            title: 'Saran Pencetakan',
            text: 'Untuk tampilan cetak terbaik, gunakan Google Chrome Web Browser',
            type: 'info'
        });
        $(".ch-pagination a").click(function(e){
            e.preventDefault();
            var offset = $(this).attr('id');
            if(offset != undefined){
                var url = "<?php echo base_url('users/index/mahasiswa')?>"+"/"+offset;
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
            loadData("<?php echo base_url('users/index/mahasiswa/0');?>");
            return false;
        })

        $("table#users_data tbody tr").contextMenu({
            menu: 'menu_menu'
        }, function(action, el, pos) {
            var act = action;
            if(act=='add-user'){
                document.location = "<?php echo base_url('users/add/mahasiswa');?>";
            }else if(act=='update-user'){
                document.location = "<?php echo base_url('users/update/mahasiswa');?>"+"/"+$(el).attr('id');
            } else if(act=='change'){
                changeStatus($(el).attr('id'));
            }else if(act=='transkrip'){
                document.location = "<?php echo base_url('nilai/transkrip_mahasiswa');?>"+"/transkrip/"+$(el).attr('id');
            }
        });
    })
</script>
<div id="print_content">
<table id="users_data"class="table table-striped table-hover table-condensed ch-table">
    <thead>
    <tr>
        <th>Nomor Induk</th>
        <th>Nama Lengkap</th>
        <th>Fakultas /Prodi</th>
        <th>Angkatan</th>
        <th>Program</th>
        <th>No. Kontak</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(empty($users)) { echo"<tr><td colspan=\"6\"><div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button> Data Tidak Ada.</div></td></tr>";};
    foreach($users as $user):
    ?>
        <tr id="<?php echo $user['user_id'];?>" class="<?php $status = ($user['user_status']==1) ? "aktif" : "non-aktif"; echo $status?>">
            <td><?php echo $user['user_code'];?></td>
            <td><?php echo $user['user_full_name'];?></td>
            <td><?php echo $user['mhs_fak_prodi'];?></td>
            <td><?php echo $user['mhs_angkatan'];?></td>
            <td><?php echo $user['mhs_program'];?></td>
            <td><?php echo $user['user_contact'];?></td>
            <td><?php echo $user['user_email'];?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
</div>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
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
        <a class="btn btn-primary" href="<?php echo base_url('users/add/mahasiswa')?>" title="Tambah Mahasiswa"><i class="icon-plus icon-white"></i> Tambah</a>
        <button class="btn" onclick="javascript:print()" title="Cetak data diatas"><i class="icon-print"></i> Cetak</button>
    </div>
</div>
<ul class="ch-contextmenu" id="menu_menu">
    <li><a href="#add-user">Tambah</a></li>
    <li><a href="#update-user">Ubah</a></li>
    <li class="separator"><a href="#change">Non Aktif / Aktif</a></li>
    <li><a href="#transkrip">Lihat Transkrip</a></li>
</ul>