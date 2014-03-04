<div id="bs-assets-chart"></div>
<script>
$(function () {
    $('#bs-assets-chart').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Assets'
        },
        xAxis: {
            categories: ["<?php
                $categories = array();
                foreach($rows['accounts'] as $account_id => $money){
                    if($accounts['assets'][$account_id]['type']=='account')
                        $categories[] = $accounts['assets'][$account_id]['title'];
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
            name: 'Assets',
            data: [<?php echo implode(',', array_values($rows['accounts'])) ?>],
            color : '#c36fbc'
        }]
    });
});     
</script>    