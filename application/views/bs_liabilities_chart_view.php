<div id="bs-liabilities-chart"></div>
<script>
$(function () {
    $('#bs-liabilities-chart').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Liabilities'
        },
        xAxis: {
            categories: ["<?php
                $categories = array();
                foreach($rows['accounts'] as $account_id => $money){
                    if($accounts['liabilities'][$account_id]['type']=='account')
                        $categories[] = $accounts['liabilities'][$account_id]['title'];
                }
                echo implode('","', $categories);
            ?>"],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Liabilities',
            data: [<?php echo implode(',', array_values($rows['accounts'])) ?>]
        }]
    });
});     
</script>    