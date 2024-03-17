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
	
        <div class="section my-5 p-5 w-25">
			<!-- Display the count of rows -->
			<h3>Total Orders</h3>
			<h4 id="count"><?= $i; ?></h4>
		</div>

        <div class="section">
            <!-- Button to trigger the modal -->
            <div class="pb-5 ">
                <a href="order.php"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Goto Order Products
                </button></a>
            </div>

            <!-- Modal -->
           
			<?php
// Check if the status query parameter is set and equals success
if(isset($_GET['status']) && $_GET['status'] === 'success') {
    // Display a dismissible success alert
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Your order was successfully placed!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}
?>

<table id="DataTab" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>instrument Brand</th>
                        <th>Price</th>
                        <th>Color</th>
						<th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $output = getSubject('order_list');
                    foreach ($output as $out) {
                    ?>
                        <tr>
                            <td><?= $i; ?></td>
							 <td><?= $out['name']; ?></td>
							 <td><?= $out['phone']; ?></td>
							 <td><?= $out['address']; ?></td>
                            <td><?= $out['brand']; ?></td>
                            <td><?= $out['price']; ?></td>
                            <td><?= $out['color']; ?></td>
							<td>
								<button type="button" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#deleteModal<?= $out['id']; ?>" data-id="<?= $out['id']; ?>">Delete</button>
							</td>
							    <div class="modal " id="deleteModal<?= $out['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
										   
							</div>
          		       </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
   




    </div>
</div>
<!-- jQuery JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
                delete_order: true // Add a flag to identify the delete action in your PHP script
            },
            success: function(response) {
                // Handle success response
                console.log(response); // Log the response for debugging
                alert("Entry deleted successfully!");

                // Remove the row from the table
                deleteButton.closest('tr').remove();

                // Update the count after successful deletion
                var newRowCount = $("#DataTab tbody tr").length;
                $("#count").text(newRowCount);
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
    // Wait for the document to be fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Get the total number of rows in the table
        var rowCount = document.querySelectorAll("#DataTab tbody tr").length;
        // Update the count in the HTML
        document.getElementById("count").textContent = rowCount;
    });
</script>



<!-- Bootstrap JavaScript (Popper.js and jQuery are required for Bootstrap) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
