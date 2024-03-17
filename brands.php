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
			<h3>Total Brands</h3>
			<h4 id="count"><?= $i; ?></h4>
		</div>

        <div class="section">
            <!-- Button to trigger the modal -->
		<div class="pb-5 ">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Add Instrument
    </button>
</div>


 

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
                        <label for="series_id">Enter Instrument</label>
                       <input type="text" class="form-control" name="instrument_type" id="instrument_type" placeholder="Enter Instrument">
                    </div>
                    <div class="form-group">
                        <label for="series_id">Instrument Status</label>
                      <select class="form-control" id="status" name="status">
                            <option value="0">Select</option>
                            <option value="Available">Available</option>
                            <option value="Not vailable">Not Available</option>
                        </select>
                    </div>
                
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="Add_instrument">
            </div>
            </form> <!-- Close the form here -->
        </div>
    </div>
</div>

<table id="DataTab" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th >S.No</th>
            <th>Instrument Type</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $output = getSubject('instruments_type');
        foreach ($output as $out) {
        ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $out['name']; ?></td>
                <td><?= $out['status']; ?></td>
               <!-- Inside your foreach loop -->
<td>
    <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target="#editModal<?= $out['id']; ?>" data-id="<?= $out['id']; ?>">Edit</button>
</td>

<!-- Edit Modal -->
<div class="modal " id="editModal<?= $out['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <!-- Your edit modal content goes here -->
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <!-- Your form fields go here -->
            <form action="database_db.php" method="POST" id="editForm<?= $out['id']; ?>">
                <input type="hidden" name="id" value="<?= $out['id']; ?>">
                <div class="form-group">
                    <label for="edit_instrument_type<?= $out['id']; ?>">Instrument Type</label>
                    <input type="text" class="form-control" name="instrument_type" id="edit_instrument_type<?= $out['id']; ?>" value="<?= $out['name']; ?>">
                </div>
                <div class="form-group">
                    <label for="edit_status<?= $out['id']; ?>">Instrument Status</label>
                    <select class="form-control" id="edit_status<?= $out['id']; ?>" name="status">
                        <option value="Available" <?= ($out['status'] == 'Available') ? 'selected' : ''; ?>>Available</option>
                        <option value="Not Available" <?= ($out['status'] == 'Not Available') ? 'selected' : ''; ?>>Not Available</option>
                    </select>
                </div>
            </form>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" form="editForm<?= $out['id']; ?>" name="change_instrument_details">Save Changes</button>
        </div>
    </div>
</div>

</div>

               <td>
    <button type="button" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#deleteModal<?= $out['id']; ?>" data-id="<?= $out['id']; ?>" data-id="<?= $out['id']; ?>">Delete</button>
</td>

            </tr>

            <!-- Edit Modal -->
            <div class="modal " id="editModal<?= $out['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <!-- Your edit modal content goes here -->
            </div>

            <!-- Delete Modal -->
            <div class="modal " id="deleteModal<?= $out['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <!-- Your delete modal content goes here -->
            </div>
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

    // Get the total number of rows in the table
    var rowCount = $("#DataTab tbody tr").length;
    // Update the count in the HTML
    $("#count").text(rowCount);
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
