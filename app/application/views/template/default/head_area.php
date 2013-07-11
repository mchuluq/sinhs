<div class="span9">
    <ul class="crumbs">
        <li><a href="<?php echo base_url() ?>"><i class="icon icon-home"></i></a></li>
        <li><a><?php echo $this->uri->rsegment(1)?></a></li>
        <li><a><?php echo $this->uri->rsegment(2)?></a></li>
    </ul>
</div>
<div class="span3">
    <div id="ch-user">
        <i class="avatar"></i>
        <h5><?php echo $this->session->userdata('user_full_name')?><small><?php echo $this->session->userdata('group_name')?></small></h5>
        <ul>
            <li><a href="<?php echo base_url('account')?>"><i class="icn icon-user"></i> pengaturan akun</a></li>
            <li><a href="<?php echo base_url('sign/out')?>" id="sign_out"><i class="icn icon-off"></i> keluar</a></li>
            <li class="sep">masuk sejak : <strong><?php echo timespan($this->session->userdata('login_since'),now())?></strong> yang lalu</li>
        </ul>
    </div>
</div>