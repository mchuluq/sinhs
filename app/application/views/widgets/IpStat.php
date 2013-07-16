<article class="ch-article span6">
    <script type="text/javascript">
        $(function () {
            $(document).ready(function() {
                Highcharts.visualize = function(table, options) {
                    options.xAxis.categories = [];
                    $('tbody th', table).each( function(i) {
                        options.xAxis.categories.push(this.innerHTML);
                    });
                    options.series = [];
                    $('tr', table).each( function(i) {
                        var tr = this;
                        $('th, td', tr).each( function(j) {
                            if (j > 0) {
                                if (i == 0) {
                                    options.series[j - 1] = {
                                        name: this.innerHTML,
                                        data: []
                                    };
                                } else {
                                    options.series[j - 1].data.push(parseFloat(this.innerHTML));
                                }
                            }
                        });
                    });
                    var chart = new Highcharts.Chart(options);                }
                var table = document.getElementById('ipStatTable'),
                    options = {
                        chart: {
                            renderTo: 'ipStatChart',
                            type: 'line'
                        },
                        title: {
                            text: 'Grafik Statistik Indeks Prestasi'
                        },
                        xAxis: {
                            title: {
                                text: 'Semester'
                            }
                        },
                        yAxis: {
                            title: {
                                text: 'Indeks Prestasi'
                            }
                        },
                        tooltip: {
                            formatter: function() {
                                return ' semester:  '+ this.x.toLowerCase()+' <b>'+ this.series.name +'</b>'+
                                    this.y;
                            }
                        }
                    };
                Highcharts.visualize(table, options);
            });
        });
    </script>
    <header><i class="icon-user"></i><?php echo $title?></header>
    <div class="ch-article-content">
        <table id="ipStatTable" style="display:none">
            <thead>
            <tr>
                <th>Semester</th>
                <th>IP</th>
            </tr>
            </thead>
            <tbody>
            <?php $query =$this->db->query("SELECT DISTINCT(frs_grup), frs_semester FROM view_frs WHERE user_id = ".$this->session->userdata('user_id')."");
            foreach($query->result_array() as $frs):
                $query2 =$this->db->get_where('view_khs_detail',array('frs_grup'=>$frs['frs_grup']));
                $ip = countIpS($query2->result_array());?>
                <tr>
                    <th><?php echo $frs['frs_semester']?></th>
                    <td><?php echo $ip['ip']?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <div id="ipStatChart" style="width:auto;height:250px"></div>
    </div>
</article>