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
            <h3>Total Products</h3>
            <?php 
             $sql = "SELECT count(id) AS id FROM stocks ";
            $innerResult = exeSql($sql);
            $nid = perval($innerResult[0]['id']);
            $count_id =$nid;
            echo "<h4>$count_id</h4>";
            ?>
        </div>
        <div class="section">
            <!-- Button to trigger the modal -->
			<div class="d-flex">
			<div class="col-lg-10">
			<form role="form" method="POST" action="order.php" > 
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
			
                <a href="orders_list.php"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                   Goto My Orders
                </button></a>
            </div>
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
                        <th>Image</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Color</th>
                        <th>Order</th>
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
                            <td><img src="img/<?= $out['instrument_img'] ?>" style="max-width: 200px; max-height: 200px;"></td>
                            <td><?= $out['instrument_brand']; ?></td>
                            <td><?= $out['price']; ?></td>
                            <td><?= $out['color']; ?></td>
                           <td>
								<?php if ($out['qnty'] >0): ?>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#orderModal<?= $i ?>">Order Now</button>
								<?php else: ?>
									<h6 class="text-danger">Not Available</h6>
								<?php endif; ?>
							</td>
							 <!-- Modal for order -->
                            <div class="modal fade" id="orderModal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel<?= $i ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="orderModalLabel<?= $i ?>">Order Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!-- Modal Body -->
                                        <div class="modal-body">
                                            <!-- Your order form fields go here -->
                                            <form action="database_db.php" method="POST">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="stock_id" id="stock_id" value="<?= $out['id']; ?>"  >
                                                    <input type="hidden" class="form-control" name="brand" id="brand" value="<?= $out['instrument_brand']; ?>"  >
													 <input type="hidden" class="form-control" name="price" id="price" value="<?= $out['price']; ?>"  >
													 <input type="hidden" class="form-control" name="color" id="color" value="<?= $out['color']; ?>"  >

                                                </div>
                                              
                                                <div class="form-group">
                                                    <label for="name">Enter Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Enter Phone Number</label>
                                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number">
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Enter Address</label>
                                                    <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address">
                                                </div>
                                                <div class="form-group">
                                                    <label for="qnty">Item Quantity</label>
                                                    <select class="form-control" id="qnty" name="qnty">
                                                        <option value="0">Select</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <!-- Modal Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" name="order_instrument">
                                        </div>
                                        </form> <!-- Close the form here -->
                                    </div>
                                </div>
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

<!-- Bootstrap JavaScript (Popper.js and jQuery are required for Bootstrap) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
