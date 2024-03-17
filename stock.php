<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

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

    <!-- Example: Welcome message for logged-in user -->
    <div class="container-fluid">
	<div class="section my-5 p-5  w-25  ">
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
        <div class="section">
		<div class="d-flex">
			<div class="col-lg-10">
			<form role="form" method="POST" action="stock.php" > 
		  <div class="row">                  	  
                  
                   <div class="col-md-2">
					    <div class="form-group"> 
						<select name="inst" id="inst" class="form-control"> 
						<option value="">Select Instruments</option>	
							
						<?php
						$ctype=getSubject('instruments_type');
						foreach($ctype  as $row){								  
							echo '<option value="'.$row['id'].'"'.$s.'>'.$row['name'].'</option>';
						}  
						?>
						<option value="">All</option>
						</select>
						
						</div>
                    </div>
                   <div class="col-md-2">
					    <div class="form-group"> 
						<select name="price" id="price" class="form-control"> 
						<option value="">Select Price</option>	
						<option value="10000">10000 below</option>	
						<option value="15000">15000 below</option>	
						<option value="20000">20000 Above</option>	
						<option value="">All</option>
						</select>
						
						</div>
                    </div>					
					                    
					<div class="col-md-2">
					    <div class="form-group"> 
						<input name="Search" value="Search" class="btn btn-success btn-md btn-block" type="submit">
						</div>
                    </div>
            </div> 
				 <?php
				    $dcon = 1;
				    if(isset($_POST['Search'])){
						  $inst = $_POST['inst'];
						  $price = $_POST['price'];
						  if(!empty($inst) ){
						$dcon .=" and instrument_id = '$inst' ";
					  }if(!empty($price)){
                         if( $price <20000){
						$dcon .=" and price <=$price ";
					  }else{
						  $dcon .=" and price >=$price ";
					  }
					  }
					} 
				  ?>
          </form>
		  </div>
            <div class="col-lg-2 pb-5 ">
			
             	<div class="pb-5 ">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Add Stock to Shop
    </button>
</div>

            </div>
            </div>
            <!-- Button to trigger the modal -->
		


 

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Your form fields go here -->
                <form action="database_db.php" method="POST">
                    <div class="form-group">
                        <label for="instrument_id">Select Instrument</label>
                      <select class="form-control" id="instrument_id" name="instrument_id">
                            <option >Select</option>
							<?php 
							$result =getSubject('instruments_type');
							foreach($result as $res){?>
							 <option value="<?=$res['id'];?>"><?=$res['name'];?></option>
							<?php 	
							}
							?>
													</select>
						</div>
                    <div class="form-group">
                        <label for="instrument_brand">Brand Name</label>
                     <input type="text" class="form-control" name="instrument_brand" id="instrument_brand" placeholder="Enter Instrument Brand">
                   
                    </div>
					 <div class="form-group">
                        <label for="instrument_img">Instrument Image</label>
                     <input type="file" class="form-control" name="instrument_img" id="instrument_img">
                   
                    </div>
					<div class="form-group row">
					<div class="col-lg-6">
                        <label for="price">Price</label>
                     <input type="text" class="form-control" name="price" id="price" placeholder="Enter Instrument Price">
                       </div>
					   <div class="col-lg-6">
					   <label for="color">Color</label>
                    <select class="form-control" id="color" name="color">
                            <option value="0">Select</option>
                            <option value="red">Red</option>
                            <option value="blue">Blue</option>
                            <option value="white">White</option>
                            <option value="black">Black</option>
                            <option value="wooden">Wooden</option>
                        </select>
                    </div>
                    </div>
					<div class="col-lg-12">
                        <label for="price">Quantity</label>
                     <input type="text" class="form-control" name="qnty" id="qnty" placeholder="Enter Instrument Price">
                       </div>
					
                
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="Add_stock">
            </div>
            </form> <!-- Close the form here -->
        </div>
    </div>
</div>

<table id="DataTab" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Image</th>
            <th>Instrument Type</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Color</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $output = getSubject('stocks',$dcon);
        foreach ($output as $out) {
        ?>
            <tr>
                <td><?= $i; ?></td>
				<td><img src="img/<?=$out['instrument_img']?>"  style="max-width: 200px; max-height: 200px;"></td>
                <td><?= getValue('instruments_type',$out['instrument_id']) ?></td>
                <td><?= $out['instrument_brand']; ?></td>
                <td><?= $out['price']; ?></td>
                <td><?= $out['color']; ?></td>

        <?php
            $i++;
        }
        ?>
    </tbody>
</table>


        </div>
		 <?php
    // Assuming you have retrieved instrument counts from your database
    $instrumentCounts = [
        'Piano' => 3,
        'Guitar' => 5,
        // Add more instrument counts as needed
    ];
    ?>

    <script>
    // Prepare data for the chart
    var instrumentNames = <?php echo json_encode(array_keys($instrumentCounts)); ?>;
    var instrumentCounts = <?php echo json_encode(array_values($instrumentCounts)); ?>;

    // Create a bar chart
    var ctx = document.getElementById('instrumentChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: instrumentNames,
            datasets: [{
                label: 'Instrument Counts',
                data: instrumentCounts,
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
    </div>
</div>
<!-- jQuery JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Bootstrap JavaScript (Popper.js and jQuery are required for Bootstrap) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Your custom JavaScript -->
<script>
    $(document).ready(function() {
    // Add click event listener to delete button
    $('.delete-btn').click(function() {
        // Get the ID of the item to be deleted
        var itemId = $(this).data('id');

        // Store the reference to the current button element
        var deleteButton = $(this);

        // Send AJAX request to delete the item
        $.ajax({
            type: 'POST',
            url: 'database_db.php',
            data: {
                id: itemId,
                delete_entry: true // Add a flag to identify the delete action in your PHP script
            },
            success: function(response) {
                // Handle success response
                console.log(response); // Log the response for debugging
                alert("Entry deleted successfully!");

                // Remove the row from the table
                deleteButton.closest('tr').remove();
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(error); // Log the error for debugging
                alert("Failed to delete entry!");
            }
        });
    });
});

</script>


<script>
    $(document).ready(function() {
        $('#exampleModal').modal('hide'); // Optional: Hide the modal by default
    });
</script>


<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JavaScript (Popper.js and jQuery are required for Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<!-- Other content specific to the index page -->

<?php
// You can include other PHP logic or HTML content here
?>
