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
                var table = document.getElementById('mhsStatAngkatanTable'),
                    options = {
                        chart: {
                            renderTo: 'mhsStatAngkatanChart',
                            type: 'column'
                        },
                        title: {
                            text: 'jumlah mahasiswa per tahun'
                        },
                        xAxis: {
                        },
                        yAxis: {
                            title: {
                                text: 'Grafik Statistik Mahasiswa'
                            }
                        },
                        tooltip: {
                            formatter: function() {
                                return '<b>'+ this.x.toLowerCase() +'</b><br/>'+this.y;

                            }
                        }
                    };
                Highcharts.visualize(table, options);
            });
        });
    </script>
    <header><i class="icon-user"></i><?php echo $title?></header>
    <div class="ch-article-content">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#mhsStatAngkatan" data-toggle="tab">Statistik Angkatan</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="mhsStatAngkatan">
                <table id="mhsStatAngkatanTable" style="display:none;">
                    <thead>
                    <tr>
                        <th>Tahun Angkatan</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $query = $this->db->query("SELECT DISTINCT(a.mhs_angkatan), (SELECT COUNT(*) FROM view_user_mahasiswa WHERE mhs_angkatan = a.mhs_angkatan) AS total_mhs FROM view_user_mahasiswa a LIMIT 0, 5");
                    foreach($query->result_array() as $ang): ?>
                        <tr>
                            <th><?php echo $ang['mhs_angkatan']?></th>
                            <td><?php echo $ang['total_mhs']?></td>
                        </tr>
                    <?php endforeach;
                    //echo json_encode($query->result_array());
                    ?>

                    </tbody>
                </table>
                <div id="mhsStatAngkatanChart" style="width:auto;height:150px"></div>
            </div>
        </div>
    </div>
</article>