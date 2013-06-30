<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--<a class="brand" title="<?php echo $this->config->item('app_name')?>"><?php echo $this->config->item('app_shortname')?></a>-->
            <a class="brand-custom" href="<?php echo base_url() ?>" title="<?php echo $this->config->item('app_name')?>"><span class="logo-sinhs-full"></span></a>
            <div class="nav-collapse collapse">
                <div class="nav-collapse collapse">
                    <ul class="nav pull-right">
                        <li><a href="<?php echo base_url('dashboard')?>">dashboard</a></li>
                        <li><a href="<?php echo base_url('about')?>">tentang</a></li>
                        <li id="fat-menu" class="dropdown">
                            <a id="drop3" href="#"class="dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                            <ul class="dropdown-menu backgroundChanger">
                                <li><a href="<?php echo base_url('account/backgroundChanger/styleBlue')?>"><span class="blue"></span>Blue Opal</a></li>
                                <li><a href="<?php echo base_url('account/backgroundChanger/styleGrey')?>"><span class="grey"></span>Grey</a></li>
                                <li><a href="<?php echo base_url('account/backgroundChanger/styleGrid')?>"><span class="grid"></span>Grid</a></li>
                                <li><a href="<?php echo base_url('account/backgroundChanger/styleSilver')?>"><span class="silver"></span>Silver</a></li>
                                <li><a href="<?php echo base_url('account/backgroundChanger/styleTexture')?>"><span class="texture"></span>Texturetastic Gray</a></li>
                                <li><a href="<?php echo base_url('account/backgroundChanger/styleWhiteCarbon')?>"><span class="white"></span>White Carbon</a></li>
                                <li><a href="<?php echo base_url('account/backgroundChanger/styleWood')?>"><span class="wood"></span>Wood</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>