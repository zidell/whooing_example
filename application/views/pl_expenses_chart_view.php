<div id="pl-expenses-chart"></div>
<script>
$(function () {
    $('#pl-expenses-chart').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Expenses'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Money',
            data: [
            <?php 
                $arr = array();
                foreach($rows['accounts'] as $account_id => $money){
                    $arr[] = '[\''.$accounts['expenses'][$account_id]['title'].'\', ' . $money . ']';
                }
                echo implode(',', $arr);
            ?>
            ]
        }]
    });
});     
</script>    