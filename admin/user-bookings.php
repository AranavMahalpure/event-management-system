<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['adminsession'])==0)
{   
header('location:logout.php');
}
else{    

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>EMS | New Bookings</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
 <style>
    .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
</style>
</head>
<body>
<div id="wrapper">
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
<!-- / Header -->
<?php include_once('includes/header.php');?>
<!-- / Leftbar -->
<?php include_once('includes/leftbar.php');?>
</nav>

        <div id="page-wrapper">
            <div class="row">
                <?php echo $uid=intval($_GET['uid']);
$uname=$_GET['uname'];

?>
                <div class="col-lg-12">
                           <h1 class="page-header"><?php echo $uname;?>'s Bookings</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row" style="margin-top:1%">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage  Bookings
                        </div>



                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Booking Id</th>
                                        <th>Event Name</th>
                                        <th>FullName</th>
                                        <th>Number of Members</th>
                                        <th>Status</th>
                                        <th>Booking Date</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$sql = "SELECT tblbookings.id as bid,tblbookings.BookingId,tblevents.EventName,tblusers.FullName,tblbookings.NumberOfMembers,tblbookings.BookingStatus,tblbookings.BookingDate from tblbookings left  join tblusers on tblusers.Userid=tblbookings.UserId left join tblevents on tblevents.id=tblbookings.EventId where tblbookings.UserId='$uid'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ 
    ?>

<tr >
<td><?php echo htmlentities($cnt);?></td>
<td><?php echo htmlentities($row->BookingId);?></td>
<td><?php echo htmlentities($row->EventName);?></td>
<td><?php echo htmlentities($row->FullName);?></td>
<td><?php echo htmlentities($row->NumberOfMembers);?></td>
<td><?php echo htmlentities($row->BookingDate);?></td>

<td><?php $status=$row->BookingStatus;
if($status==""){
echo htmlentities("Not Confirmed yet");    
} else {
echo htmlentities("$status");        
}
?></td>
<td>
<a href="booking-details.php?bkid=<?php echo htmlentities($row->bid);?>">
<i class="fa fa-file-text"></i>
</a>
                            </button>    
                            </a></td>
</tr>
        <?php $cnt++;
    }} else {?>       
       <tr>
        <th colspan="8" style="color:red; text-align:center;">No Booking Yet</th>
    </tr>
    <?php } ?>                   

                                </tbody>
                            </table>
                                </div>

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
      <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
        <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
</body>
</html>
<?php } ?>
