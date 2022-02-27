<html>

<head>
    <title>PIE Chart</title>
    <!-- CSS only -->
  <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="col-md-12 col-sm-6 col-sm-4 col-md-6 col-sm-12">

            <h1 class="bg-dark text-white p-4 text-center">Dynamic Bar Charts | AJAX & JQuery</h1>

        </div>
        <div class="col-md-12 col-sm-6 col-sm-4 col-md-6 col-sm-12">
            <div id="piechart" style="width: 700px; height: 500px;"></div>
        </div>
    </div>
</body>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart'], 'callback': drawChart
    });

    google.charts.setOnLoadCallback(drawChart);

    function drawChart(drawChart) {
        let jsonData = drawChart;
        let data = new google.visualization.arrayToDataTable([]);
        console.log(data);
        data.addColumn('string', 'Name');
        data.addColumn('number', 'Sales');
        $.each(jsonData, (i, jsonData) => {
            let name = jsonData.name;
            let total_sales = jsonData.total_sales;
            data.addRows([
                [name, total_sales]
            ]);
        });


        var options = {
            title: 'Sales Chart'
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

    $(document).ready(function () {
        load_data();
    });

</script>

</html>
