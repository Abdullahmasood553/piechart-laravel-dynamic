<html>

<head>
    <title>PIE Chart</title>

    <style>
        .container {
            padding: 0;
            margin: 0;
        }

        h1 {
            color: #fff;
            background:#333;
            padding: 8px 4px;
            text-align: center;
        }
        #chart_wrap {
            position: relative;
            padding-bottom: 100%;
            height: 0;
            overflow:hidden;
        }

        #piechart {
            position: absolute;
            top: 0;
            left: 0;
            width:50%;
            height:30%;
        }
    </style>
    <!-- CSS only -->

</head>

<body>

        <div class="container">
            <h1>Dynamic Bar Charts | AJAX & JQuery</h1>
        </div>
        <div  id="chart_wrap">
            <div id="piechart"></div>
        </div>

</body>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript">
    // google.charts.load('current', {
    //     'packages': ['corechart'], 'callback': drawChart
    // });

    google.charts.load('current', {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(function () {
        load_data();
    });


    function drawChart(drawChart) {
        let jsonData = drawChart;
    
        let data = new google.visualization.arrayToDataTable([]);
        data.addColumn({type: 'string', label: 'Name'});
         data.addColumn({type: 'number', label: 'Sales'});
     

        $.each(jsonData, (i, jsonData) => {
            let name = jsonData.name;
            let total_sales = jsonData.total_sales;
            data.addRows([
                [name, total_sales]
            ]);
        });


        var options = {
            title: 'Sales Chart',
            // width: '100%',
            // height: '100%',
          // colors: ['#D44E41'],
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }

</script>


<script>
    function load_data() {
        $.ajax({
            url: 'fetch_data',
            method: 'GET',
            data: {
                "_token": "{{ csrf_token() }}"
            },
            dataType: "JSON",
            success: function (data) {
                drawChart(data);
            }
        });
    }

</script>

</html>
