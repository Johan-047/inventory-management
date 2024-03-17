<?php
session_start();
extract($_REQUEST); 
include("afunctions.php");

if(isset($Add_instrument)){		
    $valArry['name'] = $instrument_type; 
    $valArry['status'] = $status; 

    $result = $dbObj->insertData('instruments_type', $valArry);
    if($result){
        echo "Success";
        // Redirect to brands.php
        header("Location: brands.php");
        exit(); // Ensure no further code execution after redirection
    }
}
elseif(isset($change_instrument_details)){
    $whereAr['id'] = $id;
    $valArry['name'] = $instrument_type; 
    $valArry['status'] = $status; 

    $result = $dbObj->updateData('instruments_type', $valArry, $whereAr);
    if($result){
        echo "Success";
        // Redirect to brands.php
        header("Location: brands.php");
        exit(); // Ensure no further code execution after redirection
    }
}
elseif(isset($change_user_details)){
    $whereAr['id'] = $id;
    $valArry['user_name'] = $user_name; 
    $valArry['password'] = $password; 

    $result = $dbObj->updateData('admin', $valArry, $whereAr);
    if($result){
        echo "Success";
        // Redirect to brands.php
        header("Location: users.php");
        exit(); // Ensure no further code execution after redirection
    }
}
elseif(isset($delete_entry)){
    $whereAr['id'] = "id =$id";
    
    $result = $dbObj->deleteData('instruments_type', $whereAr);
    if($result){
        echo "Success";
        // Redirect to brands.php
        header("Location: brands.php");
        exit(); // Ensure no further code execution after redirection
    }
}
elseif(isset($delete_user)){
    $whereAr['id'] = "id =$id";
    
    $result = $dbObj->deleteData('admin', $whereAr);
    if($result){
        echo "Success";
        // Redirect to brands.php
        header("Location: brands.php");
        exit(); // Ensure no further code execution after redirection
    }
}
elseif(isset($Add_stock)){		
    $valArry['instrument_id'] = $instrument_id; 
    $valArry['instrument_brand'] = $instrument_brand; 
    $valArry['instrument_img'] = $instrument_img; 
    $valArry['price'] = $price; 
    $valArry['color'] = $color; 
    $valArry['qnty'] = $qnty; 

    $result = $dbObj->insertData('stocks', $valArry);
    if($result){
        echo "Success";
        // Redirect to brands.php
        header("Location: stock.php");
        exit(); // Ensure no further code execution after redirection
    }
}
elseif(isset($Add_User)){		
    $valArry['user_name'] = $user_name; 
    $valArry['password'] = $password;

    $result = $dbObj->insertData('admin', $valArry);
    if($result){
        echo "Success";
        // Redirect to brands.php
        header("Location: users.php");
        exit(); // Ensure no further code execution after redirection
    }
}
elseif(isset($order_instrument)){		
    $valArry['name'] = $name; 
    $valArry['phone'] = $phone; 
    $valArry['address'] = $address; 
    $valArry['qnty'] = $qnty; 
    $valArry['stock_id'] = $stock_id; 
    $valArry['brand'] = $brand; 
    $valArry['price'] = $price; 
    $valArry['color'] = $color; 

    $result = $dbObj->insertData('order_list', $valArry);
    if($result){
        // Redirect to order.php with success status
		$dcon ="id='$stock_id'";
		$qnty_value =0;
		$get_qnty_count=getSubject('stocks',$dcon);
		foreach($get_qnty_count as $qnty_count){
			$qnty_value +=$qnty_count['qnty'];
		} 
		$whereAr['id'] =$stock_id;
    $valArr['qnty'] = $qnty_value - $qnty; 

    $result = $dbObj->updateData('stocks', $valArr, $whereAr);
        header("Location: order.php?status=success");
        exit(); // Ensure no further code execution after redirection
    }
}
elseif(isset($delete_order)){
    $whereAr['id'] = "id =$id";
    
    $result = $dbObj->deleteData('order_list', $whereAr);
    if($result){
        echo "Success";
        // Redirect to brands.php
        header("Location: orders_list.php");
        exit(); // Ensure no further code execution after redirection
    }
}

?>
