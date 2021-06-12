<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php 
	// checking if a user is logged in
	if (!isset($_SESSION['user_id'])) {//if somebody is accessing to internal pages of the web page without logging redirect to the logging page
		header('Location: index.php');//redirect to logging page
	}

	$suppliers_list = '';

	// getting the list of users
	$query = "SELECT * FROM supplier GROUP BY supplier.S_ID";
	$suppliers = mysqli_query($connection, $query);//pass the query

	verify_query($suppliers);

	while ($supplier = mysqli_fetch_assoc($suppliers)) {//fetch data row by row to associative array
		$suppliers_list .= "<tr>";
		$suppliers_list .= "<td>{$supplier['S_ID']}</td>";
		$suppliers_list .= "<td>{$supplier['Name']}</td>";
		$suppliers_list .= "<td><a href=\"modify-suppliers.php?supplier_no={$supplier['S_ID']}\">Edit</a></td>";
		//user_id={$user['id']}--->this provides the related id for the page making global variable to access from any where using _GET
		$suppliers_list .= "<td><a href=\"delete-suppliers.php?supplier_no={$supplier['S_ID']}\"
						onclick=\"return confirm('Are you sure?');\">Delete</a></td>";  //displaying a confirm box
		$suppliers_list .= "</tr>";
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>suppliers</title>
	<link rel="stylesheet" href="css/main.css"><!-- import the css file -->
</head>
<body>
	<div class="wrapper">
  		<header>
		<div class="appname">Restaurant Management System</div>
		<div class="loggedin">Welcome <?php echo $_SESSION['first_name']; ?>! <a href="logout.php">Log Out</a></div>
	</header>
	<div class="navbar">
		  <a href="users.php">Management</a>	
		  <div class="dropdown">
		    <button class="dropbtn">Food & Beverages</button>
		    <div class="dropdown-content">
		      <a href="foods.php">Show Room</a>
		      <a href="prepare.php">Kitchen</a>
		    </div>
		  </div> 
		  <div class="dropdown">
		    <button class="dropbtn">Employees</button>
		    <div class="dropdown-content">
		      <a href="cooking-staff.php">Cooking Staff</a>
		      <a href="waiters.php">Waiters</a>
		      <a href="delivery-boys.php">Delivering Staff</a>
		    </div>
		  </div> 
		  <a href="final-bill.php">Customers Bill</a>
		  <div class="dropdown">
		    <button class="dropbtn">Customers Services</button>
		    <div class="dropdown-content">
		      <a href="delivery.php">Deliver</a>
		      <a href="dine_in.php">Dine In</a>
		      <a href="take_away.php">Take Away</a>
		    </div>
		  </div>
		  <a href="stock.php">Stock</a>
		  <div class="dropdown">
		    <button class="dropbtn">Suppliers</button>
		    <div class="dropdown-content">
		      <a href="suppliers.php">Personal Details</a>
		      <a href="supply.php">Exchanges</a>
		    </div>
		  </div>
		</div>
	<main>
		<h1>Suppliers &nbsp;&nbsp;<span><a href="add-supplier.php">+ Add New</a></span></h1>

		<table class="masterlist">
			<tr>
				<th>Supplier Id</th>
				<th>Supplier Name</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>

			<?php echo $suppliers_list; ?>

		</table>
	</main>
	</div>
	<div class="footer">
  		<p class="foot">This website is optimized for managing the system. While using this site, you agree to have read and accepted our terms of use, cookie and privacy policy.Copyright 2005-2020.</p> 
  		<p class="foot">Powered by CD Team. Contact us.0123456789</p>
  		<p class="foot">All Rights Reserved.</p>
	</div>
</body>
</html>