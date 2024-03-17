<?php
session_start();

// Check if the user is logged in

// Include the header
include('header.php');
function perval($val){	
    if($val >0){		
        return $val;
    }else{
        return 0;
    }	
}
?>

<!-- Additional content specific to the index page -->
<div class="content-container">
    <div class="container-fluid">
    <div class="row">
    <div class="col-lg-4">
        <div class="section my-5 p-5 ">
            <!-- Display the count of rows -->
            <h3>Total Brand</h3>
            <?php 
                $sql = "SELECT count(id) AS id FROM instruments_type ";
                $innerResult = exeSql($sql);
                $nid = perval($innerResult[0]['id']);
                $count_id =$nid;
                echo "<h4>$count_id</h4>";
            ?>
        </div>
        </div>
		 <div class="col-lg-4">
        <div class="section my-5 p-5   ">
            <!-- Display the count of rows -->
            <h3>Total Stocks</h3>
            <?php 
                $sql = "SELECT count(id) AS id FROM stocks ";
                $innerResult = exeSql($sql);
                $nid = perval($innerResult[0]['id']);
                $count_id =$nid;
                echo "<h4>$count_id</h4>";
            ?>
        </div>
		 </div>
		 <div class="col-lg-4">
        <div class="section my-5 p-5  ">
            <!-- Display the count of rows -->
            <h3>Total Orders</h3>
            <?php 
                $sql = "SELECT count(id) AS id FROM order_list ";
                $innerResult = exeSql($sql);
                $nid = perval($innerResult[0]['id']);
                $count_id =$nid;
                echo "<h4>$count_id</h4>";
            ?>
        </div>
        </div>
        </div>
        </div>
		<?php 
// Initialize an array to store instrument counts
$instru_array = array();

// Assuming exeSql() function executes the SQL query and returns the result
$sql = "SELECT instruments_type.name AS instrument_name, COUNT(stocks.id) AS stocks_count 
        FROM instruments_type 
        LEFT JOIN stocks ON instruments_type.id = stocks.instrument_id 
        GROUP BY instruments_type.id";
$result = exeSql($sql);

// Iterate over the result and store counts in the $instru_array
foreach ($result as $row) {
    $instrument_name = $row['instrument_name'];
    $stock_count = $row['stocks_count'];
    $instru_array[$instrument_name] = $stock_count;
}

// Output the instrument counts as JSON
echo "<script>";
echo "var instrumentCounts = " . json_encode($instru_array) . ";";
echo "</script>";
?>

<!-- Add a canvas element for the chart -->
<div class="m-5" style=" width: 30%;">
<h1 class="text-center">Instruments Stocks Graph</h1>
    <canvas id="instrumentChart"></canvas>
</div>
</div>

<!-- Script for creating the chart -->
<script>
// Prepare data for the chart
var instrumentNames = Object.keys(instrumentCounts);
var instrumentData = Object.values(instrumentCounts);

// Create a bar chart
var ctx = document.getElementById('instrumentChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: instrumentNames,
        datasets: [{
            label: 'Instrument Counts',
            data: instrumentData,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                // Add more colors as needed
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                // Add more colors as needed
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>


<!-- Other content specific to the index page -->

<?php
// You can include other PHP logic or HTML content here
?>
