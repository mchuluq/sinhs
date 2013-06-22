<article class="ch-article span6">
    <header><i class="icon-user"></i><?php echo $title?></header>
    <div class="ch-article-content AksesCepat">
        <?php
        $query = $this->db->query("SELECT a.menu_access, b.menu_title FROM user_access a, user_menu b WHERE a.group_name = '".$this->session->userdata('group_name')."' AND a.menu_access = b.menu_access AND b.menu_show = 1");
        $row_a = 0;$max_a = sizeof($query->result_array()) - 1;
        foreach($query->result_array() as $menu):
            if($row_a % 2 == 0){echo '<div class="row_fluid">';}?>
            <a href="<?php echo base_url($menu['menu_access'])?>" class="span6"><i></i><span><?php echo $menu['menu_title']?></span></a>
            <?php if($row_a % 2 != 0 or $row_a == $max_a){echo '</div>';};
            $row_a++ ;
        endforeach;
        ?>
    </div>
</article>