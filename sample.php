<?php include("header.php");
   extract($_REQUEST);
error_reporting(0);
   ?>
   <style>
    .pritable>tbody>tr>td, .pritable>tbody>tr>th, .pritable>tfoot>tr>td, .pritable>tfoot>tr>th, .pritable>thead>tr>td, .pritable>thead>tr>th { padding: 2px!important; font-size: 12px;
 }
    .pritable { margin-bottom: 5px!important;}
    .modal.in .modal-dialog, .modal-content{width: 300px;border: none; padding: 0px;}
    .modal-body,.modal-header{padding: 10px;}
    .details{  color: #149a14; }
    h3, h4{margin: 0px;}
    .modal-body .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td, .table>tbody>tr.active>th{border: none; background: none;}
    .fa-print{ font-size: 30px; }
     @media print
    {
       /*.modal.in .modal-dialog, .modal-content{width: 260px!important;border: none!important;padding: 0px!important;} */
        h4{font-family: inherit;}
       .modal-body{padding: 0px;padding-left: -5px;}
       .orderlist1, .content-header, .main-header .logo .logo-lg, .main-footer, #toTop,.back-top, .main-header, .printbtn,  .main-sidebar,  #cntfop .modal-header{display: none;}
       @page { margin: 0; margin-left:5px;}
        *{font-size: 12px!important; font-weight: bold!important; }
        .fa{ font-weight: normal!important;}
       h3{font-size: 20px!important;} 
        .kot{ min-height: 100px; }
        #cntfop, #btnclose {display: none;}
   }
</style>
<section class="content-header">
    <div class="header-icon">
        <i class="fa fa-tag"></i>
    </div>
    <div class="header-title">
        <h1>Orders List Month Wise</h1>
        <small>Items are Presented in this website </small>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active">Orders List Month Wise</li>
        </ol>
    </div>
</section>
<!-- Main content -->
<section class="content" id="cntfop">
   <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="panel panel-success">
            <div class="panel-heading">
               <div class="panel-title">
                  <h4><i class="fa fa-calendar" aria-hidden="true"></i> Selecte Dates</h4>
               </div>
            </div>
            <div class="panel-body">
               <div class="row">
                  <br>
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"  method="post" action="memberiwse.php" enctype="multipart/form-data">
                     <div class="col-md-3">
                        <div class="form-group">
                           <div class="col-md-12">
                              <div class='input-group date'>
                                 <input type="date" id="cidate" name="cidate" class="form-control example1" required>
                                 <span class="input-group-addon">
                                 <i class="fa fa-calendar"></i>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <div class="col-md-12">
                              <div class='input-group date'>
                                 <input type="date" id="codate" name="codate" class="form-control example1" required>
                                 <span class="input-group-addon">
                                 <i class="fa fa-calendar"></i>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                         <div class="form-group">
                           <div class="col-md-12">
                                 <select class="form-control" name="type" class="w-100">
                                    <option value="">
                                       Select Item Type
                                    </option>
                                    <option value="">
                                       All Payments
                                    </option>
                                    <option value="Wallet">
                                       Wallet
                                    </option>
                                    <option value="Swiping">
                                       Swiping
                                    </option>
                                    <option value="Cash">
                                       Cash
                                    </option>
                                    <option value="UPI">
                                       UPI
                                    </option>
                                 </select>
                            </div>
                            </div>
                         </div>
                    <div class="col-md-3">                       
                        <div class="form-group">
                           <div class="col-md-12">
                              <input type="submit" class="btn btn-success " style="padding:8px 30px;" value="Submit" name="search">
                           </div>
                        </div>
                    </div>
                     
                  </form>
                   <br>
                    <?php
                         if(isset($search)) { ?>
                             <p style="margin-left:20px;">You Seleted <?=$cidate;?> - <?=$codate;?></p>
                    <?php } ?>
               </div>
            </div>
         </div>
      </div>
       <?php
            if(isset($search)) { ?>
         <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="panel panel-success">
            <div class="panel-heading">
               <div class="panel-title">
                  <h4> <i class="pe-7s-list"></i> Orders List Month Wise</h4>
               </div>
            </div>
            <div class="panel-body">
                  <div class="table-responsive">
                  <table id="dataTableExample2" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th>Order No</th>
                           <th>LM Mumber</th>
                           <th>Table</th>
                           <th class="hidden-xs">Items </th>
                           <th>Amount</th>
                           <th class="hidden-xs">Time</th>
                           <th>Boy</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php include("../dbconfig.php");
                   // Check if both cidate and codate are set and not empty
                   if (isset($cidate) && isset($codate) && $cidate != "" && $codate != "") {
                       // Prepare SQL query to fetch orders within the specified date range
                       $sql2 = "SELECT * FROM bar_food_order WHERE order_status = '2' AND (STR_TO_DATE(order_date, '%Y-%m-%d') BETWEEN STR_TO_DATE('$cidate', '%Y-%m-%d') AND STR_TO_DATE('$codate', '%Y-%m-%d')) ORDER BY `order_id` DESC";
                       
                       $result2 = $conn->query($sql2);
                       $order_total = 0; // Initialize total order amount
                       $aggregatedData = []; // Initialize array to hold aggregated data
                   
                       // Process each order fetched from the database
                       while ($row = $result2->fetch_assoc()) {
                           $uniqueIdentifier = $row['order_uid']; // Use order_uid as the unique identifier
                           $orderTotal = $row['order_total'];
                           $orderItems = explode(",", $row['order_items']); // Assuming order_items is a comma-separated string
                   
                           // Aggregate data based on uniqueIdentifier
                           if (!isset($aggregatedData[$uniqueIdentifier])) {
                               $aggregatedData[$uniqueIdentifier] = [
                                   'order_total' => 0,
                                   'order_items' => [],
                                   'user_name' => '',
                                   'membership_card' => ''
                               ];
                           }
                           $aggregatedData[$uniqueIdentifier]['order_total'] += $orderTotal;
                           $aggregatedData[$uniqueIdentifier]['order_items'] = array_merge($aggregatedData[$uniqueIdentifier]['order_items'], $orderItems);
                   
                           // Fetch additional user info based on order_uid, if not already fetched
                           if ($aggregatedData[$uniqueIdentifier]['user_name'] == '') {
                               // Assume user_name and membership_card are fetched here and set accordingly
                               // This is a placeholder for fetching logic
                               $aggregatedData[$uniqueIdentifier]['user_name'] = 'Example Name'; // Placeholder
                               $aggregatedData[$uniqueIdentifier]['membership_card'] = 'Example Card'; // Placeholder
                           }
                       }
                   
                       // Display the aggregated data
                       foreach ($aggregatedData as $identifier => $data) {
                           echo "<tr>";
                           echo "<td>" . htmlspecialchars($identifier) . "</td>";
                           echo "<td>" . htmlspecialchars(implode(", ", $data['order_items'])) . "</td>";
                           echo "<td>" . htmlspecialchars($data['order_total']) . "</td>";
                           echo "<td>" . htmlspecialchars($data['user_name']) . "</td>";
                           echo "<td>" . htmlspecialchars($data['membership_card']) . "</td>";
                           echo "</tr>";
                       }
                   }
                   ?>
                   >
                    </table>
                </div>
               </div>
            </div>
         </div>
       <?php } ?>
      </div>
   </section>
   <?php 
   $sql3 ="SELECT * from bar_food_order INNER JOIN users ON (bar_food_order.order_uid = users.user_id) JOIN bar_location ON (bar_location.bar_location_id = bar_food_order.order_location) WHERE order_status = '2'  ORDER BY `order_id` DESC";
    $result3 = $conn->query($sql3);
    $x=1;
    while($row3 = $result3->fetch_assoc())
    { 
        $order_items3 =explode(",",$row3['order_items']);
        $order_qty3 =explode(",",$row3['order_qty']);
        $order_price3 =explode(",",$row3['order_price']);  
        $count3 = sizeof($order_items3);
        
        $order_adminid = $row3['order_adminid'];
        $order_boy_id = $row3['order_boy_id'];
        $order_member_type=$row3['order_member_type'];
        $order_uid=$row3['order_uid'];
    ?>
     <div id="invoice<?=$row3['order_id'];?>"  class="modal fade" role="dialog">
            <div class="modal-dialog modal-danger">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close"  id="btnclose"  data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">BillNo : LVRBAR<?=$row3['order_id'];?></h4>
                  </div>
                  <div class="modal-body">
                 <div style="width:100%; padding:0px 0px;float:left;">
                     <?php print_r($c); ?>
                        <center><img src="images/lvrlogo.jpg" width="50px;"><br><b>
                        <?php  echo "LVR & Sons Club & Reading Room<br> <span style='font-size:12px;'>Opp:Harihar Cinemas, Koritepadu Guntur</span>"; ?> </b></center>
                        <div style="width:55%; float:left;padding:0px;">
                            <span style="font-size:14px;float:left; width:100%;">
                            <span>Steward : <?php include("../dbconfig.php"); 
                                 $sqlaid ="SELECT * from admin where admin_id ='$order_adminid'";
                                 $resultaid = $conn->query($sqlaid);
                                 while($rowaid = $resultaid->fetch_assoc())
                                  { 
                                     echo $rowaid['admin_username'];
                                 } ?>
                           </span> <br>
                           <span>Boy : <?php include("../dbconfig.php"); 
                                 $sqlbid ="SELECT * from bar_boys where bar_boys_id ='$order_boy_id'";
                                 $resultbid = $conn->query($sqlbid);
                                 while($rowbid = $resultbid->fetch_assoc())
                                  { 
                                     echo $rowbid['bar_boys_name'];
                                 } ?>
                            </span>
                           </span>
                            <span>
                                <?php if ($order_member_type=='LVRMEM'  || $order_member_type=='TMEM'){
                                
                                  $sql6 ="SELECT * from users where user_id='$order_uid'";
                                 $result6 = $conn->query($sql6);
                                 while($row6 = $result6->fetch_assoc())
                                  { 
                                      echo $membership_card = $row6['membership_card']; echo'<br>';
                                      echo $user_name = $row6['user_name'];
                                  ?>
                               <?php } } else {  
                                 $sqlgt ="SELECT * from geast_members where geast_member_id ='$order_uid'";
                                $resultgt = $conn->query($sqlgt);
                                while($rowgt = $resultgt->fetch_assoc())
                                  { 
                                     echo $geast_member_cardnumber = $rowgt['geast_member_cardnumber']; echo'<br>';
                                     echo $geast_member_name = $rowgt['geast_member_name'];
                                  ?>
                            <?php } } ?>
                            </span>
                           <span style="font-size:14px;float:left;width:100%;">
                           <i class="fa fa-phone"></i> <?=$row3['user_phone'];?>
                           </span>
                        </div>
                        <div style="width:45%; float:right;">
                           <span style="font-size:14px;float:right;  padding:3px; text-align:right;">
                           <b>Invoice # : </b><?=$row3['order_id'];?>
                           </span>
                           <span style="font-size:14px;float:right;  padding:3px; text-align:right;">
                           <b>Date : </b> <?=date("d-m-Y", strtotime($row3['order_date'])); ?><br>
                           </span>
                            <span style="font-size:14px;float:right;  padding:3px; text-align:right;">
                           <b>Time : </b> <?=date("h:i:s", strtotime($row3['order_date'])); ?><br>
                           </span>
                           <?php
                              if($row3['order_pay_mode']){
                              ?>
                           <span style="font-size:14px;float:right;  padding:3px; ">
                              <b>Pay Mode : </b><?=$row3['order_pay_mode']?><br/>
                              <!--<b>Transaction Id : </b><?=$payu_id;?> -->
                           </span>
                           <span style="font-size:14px;float:right;  padding:3px; ">
                           <span><?=$row3['bar_location_name'];?>(<?=$row3['order_table'];?>) </span>
                           </span>
                           <?php }  ?>
                        </div>
                     </div>
                     
                     <table class="table pritable">
                        <tr  style="border-bottom:1px dashed #374767" class="active">
                           <th colspan="2">Items</th>
                           <th >Qty</th>
                           <th >Rate</th>
                           <th style="text-align:right">Amount</th>
                        </tr>
                       <?php
                           //print_r($order_total);
                           $k = $order_stotal = 0;
                           while($k < $count3)
                           {
                               $fid =$order_items3[$k];
                               $sql1 ="SELECT * from `bar_brand` where `brand_id` = $fid";
                               $result1 = $conn->query($sql1);
                                
                                   if($row1 = $result1->fetch_assoc())
                                   {
                                         $fname= $row1['brand_name'];
                                         $capasity= $row1['brand_capacity'];
                                         $order_stotal=$order_stotal+ceil($order_price3[$k]); 
                                   } ?>
                        <tr>
                           <td  colspan="2"> <?=$fname;?> <?=$order_qty3[$k]; ?>ml </td>
                           <td style="text-align:right">1</td>
                           <td style="text-align:right"><?=ceil($order_price3[$k]); ?></td>
                           <td   style="text-align:right"> <?=ceil($order_price3[$k]*1); ?> </td>
                        </tr>
                        <?php $k++; } ?>
                             <tr style="border-bottom:1px dashed #374767;border-top:1px dashed #374767">
                               <th colspan="4" style="text-align:right">
                                  <h4  class="gtotal">GRAND TOTAL :</h4>
                               </th>
                               <th  style="text-align:right">
                                  <h4  class="gtotal"><i class="fa fa-inr" style="font-size:14px;"></i> <?=round($order_stotal);?></h4>
                               </th>
                            </tr>
                     </table>
                     <center>
                        <p>Rounded Off to Nearest Indian Rupee</p>
                        <h4>THANK YOU</h4><a href="javascript:window.print();" title="Print" class="printbtn"><i class="fa fa-print" aria-hidden="true"></i></a>
                     </center>
                   </div>
               </div>
            </div>
         </div>
<?php $x++; } ?>
<?php include("footer.php"); ?>