<?php
require('afunctions.php');
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topbar and Sidebar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>




    <style>
        /* Your custom CSS styles here */
        body {
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
			margin-left:270px;
            width: 100%; /* Full width */
            position: fixed; /* Make the header fixed */
            top: 0; /* Align the header to the top */
            z-index: 1000; /* Ensure the header is above other content */
        }
        aside {
            width: 270px;
            background-color: #f4f4f4;
            padding: 10px;
            box-sizing: border-box;
            position: fixed; /* Make the sidebar fixed */
            left: 0; /* Align the sidebar to the left */
            top: 0px; /* Align the sidebar to the top (below the header) */
            height: calc(100vh - 30px); /* Take up the remaining height of the viewport */
            overflow-y: auto; /* Enable vertical scrolling if needed */
        }
        .content-container {
            margin-top: 60px; /* Adjust for the height of the header */
            margin-left: 250px; /* Adjust for the width of the sidebar */
            padding: 20px;
            box-sizing: border-box;
			
        }
        aside h2 {
            margin-top: 0;
        }
        aside ul {
            list-style-type: none;
            padding: 0;
        }
        aside li {
            margin-bottom: 5px;
        }
        aside a {
            color: #333;
            text-decoration: none;
        }
        aside a:hover {
            color: #000;
        }
        .content {
            padding: 20px;
            overflow: hidden;
            margin-left: 220px; /* Adjust for the width of the sidebar */
            margin-top: 60px; /* Adjust for the height of the fixed header */
            box-sizing: border-box;
        }
        .double {
            display: flex;
        }
        .double .content {
            flex-grow: 1;
        }
        .submenu {
            display: none;
            padding-left: 20px; /* Indent the submenu */
        }
        .submenu li {
            list-style-type: none; /* Remove bullet points */
        }
       .heading {
    height: 60px;
    font-size: 25px;
    background-color: #000;
    color: #fff;
    cursor: pointer; /* Add cursor pointer for better UX */
    margin-bottom: 100px; /* Add margin bottom for spacing */
}

		 
        .container {
    display: flex;
    justify-content: center;
    align-items: center;
	margin:0px;
    /* Ensure the container takes up the full height of the viewport */
}

.section {
    width: 100%;
    padding: 20px;
    margin-top: 50px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #f9f9f9;
}

.sub-container{
	padding-top:100px;
}
.bg{
	height:150px;
	padding:5px;
	margin-bottom:50px;
	 background-image: url('img/bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
}
.bg1{
	height:100vh;
	 background-image: url('img/bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
}

    </style>
</head>
<body>
<section class="double">
    <header>
        <!-- Your top bar content -->
        <h1>Welcome To Our Music Store</h1>
    </header>
    
    <!-- Sidebar -->
   <aside>
   <div class=" ">
   <div class="bg">
   
    <a href="index.php" class="toggle-submenu"> <h2 class="pb-5">Dash Board</h2></div>
    <ul >
    <li>
        <a href="brands.php" class="toggle-submenu"><h1 class="heading d-flex justify-content-center align-items-center p-1">Add Instruments</h1></a>
        
    </li>
</ul>
<ul>
    <li>
        <a href="order.php" class="toggle-submenu"><h1 class="heading text-center d-flex justify-content-center align-items-center  p-1">Products</h1></a>
           </li>
</ul>
 <ul>
    <li>
        <a href="stock.php" class="toggle-submenu"><h1 class="heading text-center d-flex justify-content-center align-items-center  p-1">Stock</h1></a>
        
    </li>
</ul>
 <ul>
    <li>
        <a href="orders_list.php" class="toggle-submenu"><h1 class="heading text-center d-flex justify-content-center align-items-center  p-1">Order List</h1></a>
        
    </li>
</ul>
 <ul>
    <li>
        <a href="users.php" class="toggle-submenu"><h1 class="heading text-center d-flex justify-content-center align-items-center  p-1">Users</h1></a>
        
    </li>
</ul>
</div>
</aside>


</section>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var toggleSubmenus = document.querySelectorAll('.toggle-submenu');

    toggleSubmenus.forEach(function(toggle) {
        toggle.addEventListener('click', function(event) {
            // event.preventDefault(); // Comment out or remove this line
            var submenu = this.nextElementSibling; // Get the next sibling element, which is the submenu
            submenu.style.display = submenu.style.display === 'none' ? 'block' : 'none';
        });
    });
});

</script>

</body>
</html>
