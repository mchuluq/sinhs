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
                var table = document.getElementById('userStatTable'),
                    options = {
                        chart: {
                            renderTo: 'userStatChart',
                            type: 'column'
                        },
                        title: {
                            text: 'total users'
                        },
                        xAxis: {
                        },
                        yAxis: {
                            title: {
                                text: 'Grafik Statistik User'
                            }
                        },
                        tooltip: {
                            formatter: function() {
                                return '<b>'+ this.series.name +'</b><br/>'+
                                    this.y +' '+ this.x.toLowerCase();
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
            <li><a href="#userStatTableContainer" data-toggle="tab">Tabel</a></li>
            <li class="active"><a href="#userStatChartContainer" data-toggle="tab">Grafik</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" id="userStatTableContainer">
                <table id="userStatTable"class="table table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>Grup</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $query = $this->db->query("SELECT DISTINCT(a.group_name), (SELECT COUNT(*) FROM user_member WHERE group_name = a.group_name) AS total_users FROM user_member a");
                    foreach($query->result_array() as $user): ?>
                        <tr>
                            <th><?php echo $user['group_name']?></th>
                            <td><?php echo $user['total_users']?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane active" id="userStatChartContainer">
                <div id="userStatChart" style="width:auto;height:150px"></div>
            </div>
        </div>
    </div>
</article>