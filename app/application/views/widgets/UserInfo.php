<article class="ch-article span6">
    <header><i class="icon-user"></i><?php echo $title?></header>
    <div class="ch-article-content">
        <table class="table table-condensed">
            <tr>
                <td>Masuk Sebagai : </td>
                <td><b><?php echo $this->session->userdata('user_name')?></b></td>
            </tr>
            <tr>
                <td>Grup : </td>
                <td><b><?php echo $this->session->userdata('group_name')?></b></td>
            </tr>
            <tr>
                <td>Browser Web : </td>
                <td><b><?php echo $this->agent->browser()?></b> versi <b><?php echo $this->agent->version()?></b> </td>
            </tr>
            <tr>
                <td>Sistem Operasi : </td>
                <td><b><?php echo $this->agent->platform()?></b></td>
            </tr>
            <tr>
                <td>No. IP : </td>
                <td><b><?php echo $this->input->ip_address()?></b></td>
            </tr>
            <tr>
                <td>Masuk sejak </td>
                <td><b><?php echo timespan($this->session->userdata('login_since'),now())?></b> yang lalu</td>
            </tr>
        </table>
    </div>
</article>