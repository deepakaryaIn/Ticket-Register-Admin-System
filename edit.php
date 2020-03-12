<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
{   
	header("Location: admin.php"); 
}
else{

	$stid=intval($_GET['stid']);
    $sta=intval(1);

	if(isset($_POST['submit']))
	{
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$contno=$_POST['contno'];
		$emailid=$_POST['emailid']; 
		$collname=$_POST['collname']; 
		$gender=$_POST['gender']; 
		$dob=$_POST['dob']; 
		$ticket=$_POST['ticket']; 
		$status=$_POST['status'];
		$sql="update register set fname=:fname,lname=:lname,contno=:contno,emailid=:emailid,collname=:collname,gender=:gender,dob=:dob,ticket=:ticket,Status=:status where Id=:stid ";
		$query = $dbh->prepare($sql);
		$query->bindParam(':fname',$fname,PDO::PARAM_STR);
		$query->bindParam(':lname',$lname,PDO::PARAM_STR);
		$query->bindParam(':contno',$contno,PDO::PARAM_STR);
		$query->bindParam(':emailid',$emailid,PDO::PARAM_STR);
		$query->bindParam(':collname',$collname,PDO::PARAM_STR);
		$query->bindParam(':gender',$gender,PDO::PARAM_STR);
		$query->bindParam(':dob',$dob,PDO::PARAM_STR);
		$query->bindParam(':ticket',$ticket,PDO::PARAM_STR);
		$query->bindParam(':status',$status,PDO::PARAM_STR);
		$query->bindParam(':stid',$stid,PDO::PARAM_STR);
		$query->execute();

		$msg="Student info updated successfully";
	}


	?>
	<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ticket Admin| Edit Student < </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
  <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                   <?php include('includes/leftbar.php');?>  
                    <!-- /.left-sidebar -->

                    <div class="main-page">

                     <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Student Admission</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                
                                        <li class="active">Student Admission</li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Fill the Student info</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                                <form class="form-horizontal" method="post">
<?php 

$sql = "SELECT register.fname,register.lname,register.contno,register.emailid,register.collname,register.gender,register.dob,register.ticket,register.Status from register where register.Id=:stid";
$query = $dbh->prepare($sql);
$query->bindParam(':stid',$stid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>


<div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">First Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="fname" value="<?php echo htmlentities($result->fname)?>" class="form-control" id="fname" required="required" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Last Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="lname" value="<?php echo htmlentities($result->lname)?>" class="form-control" id="lname" required="required" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Contact No.</label>
                                                        <div class="col-sm-10">
                                                            <input type="tel" name="contno" value="<?php echo htmlentities($result->contno)?>" class="form-control" id="contno" minlength="10" minlength="10"  required="required" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Email id</label>
                                                        <div class="col-sm-10">
                                                            <input type="email" name="emailid" value="<?php echo htmlentities($result->emailid)?>" class="form-control" id="emailid" required="required" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">College / School Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="collname" value="<?php echo htmlentities($result->collname)?>" class="form-control" id="collname" required="required" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
<label for="default" class="col-sm-2 control-label">Gender</label>
<div class="col-sm-10">
<?php  $gndr=$result->gender;
if($gndr=="Male")
{
?>
<input type="radio" name="gender" value="Male" required="required" checked>Male <input type="radio" name="gender" value="Female" required="required">Female <input type="radio" name="gender" value="Other" required="required">Other
<?php }?>
<?php  
if($gndr=="Female")
{
?>
<input type="radio" name="gender" value="Male" required="required" >Male <input type="radio" name="gender" value="Female" required="required" checked>Female <input type="radio" name="gender" value="Other" required="required">Other
<?php }?>
<?php  
if($gndr=="Other")
{
?>
<input type="radio" name="gender" value="Male" required="required" >Male <input type="radio" name="gender" value="Female" required="required">Female <input type="radio" name="gender" value="Other" required="required" checked>Other
<?php }?>


</div>
</div>
                                                                <div class="form-group">
                                                                    <label for="date" class="col-sm-2 control-label">DOB</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="date"  value="<?php echo htmlentities($result->dob)?>" name="dob" class="form-control" id="date">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="default" class="col-sm-2 control-label">Select Ticket</label>
                                                                    <div class="col-sm-10">
                                                                        <?php  $tik=$result->ticket;
                                                                        if ($tik=="FORMALS EVENT") {
                                                                            ?>
                                                                            <input type="radio" name="ticket" value="FORMALS EVENT" required="required" checked>FORMALS EVENT - Rs.150 <input type="radio" name="ticket" value="BHANGRA NIGHT" required="required">BHANGRA NIGHT - Rs.50 <input type="radio" name="ticket" value="EDM NIGHT" required="required">EDM NIGHT - Rs.100 <input type="radio" name="ticket" value="STAR NIGHT" required="required">STAR NIGHT - Rs.400 <input type="radio" name="ticket" value="THREE NIGHT" required="required">THREE NIGHT - Rs.550 <input type="radio" name="ticket" value="ALL" required="required">ALL - Rs.700
                                                                            <?php }?>
                                                                            <?php
                                                                            if($tik=="BHANGRA NIGHT")
                                                                            {
                                                                                ?>
                                                                                <input type="radio" name="ticket" value="FORMALS EVENT" required="required">FORMALS EVENT - Rs.150<input type="radio" name="ticket" value="BHANGRA NIGHT" required="required" checked>BHANGRA NIGHT - Rs.50<input type="radio" name="ticket" value="EDM NIGHT" required="required">EDM NIGHT - Rs.100<input type="radio" name="ticket" value="STAR NIGHT" required="required">STAR NIGHT - Rs.400<input type="radio" name="ticket" value="THREE NIGHT" required="required">THREE NIGHT - Rs.550<input type="radio" name="ticket" value="ALL" required="required">ALL - Rs.700
                                                                                <?php }?>
                                                                                <?php
                                                                                if ($tik=="EDM NIGHT") 
                                                                                {
                                                                                    ?>
                                                                                    <input type="radio" name="ticket" value="FORMALS EVENT" required="required">FORMALS EVENT - Rs.150<input type="radio" name="ticket" value="BHANGRA NIGHT" required="required">BHANGRA NIGHT - Rs.50<input type="radio" name="ticket" value="EDM NIGHT" required="required" checked>EDM NIGHT - Rs.100<input type="radio" name="ticket" value="STAR NIGHT" required="required">STAR NIGHT - Rs.400<input type="radio" name="ticket" value="THREE NIGHT" required="required">THREE NIGHT - Rs.550<input type="radio" name="ticket" value="ALL" required="required">ALL - Rs.700
                                                                                    <?php }?>
                                                                                    <?php
                                                                                    if ($tik=="STAR NIGHT")
                                                                                     {
                                                                                        ?>
                                                                                        <input type="radio" name="ticket" value="FORMALS EVENT" required="required">FORMALS EVENT - Rs.150<input type="radio" name="ticket" value="BHANGRA NIGHT" required="required">BHANGRA NIGHT - Rs.50<input type="radio" name="ticket" value="EDM NIGHT" required="required">EDM NIGHT - Rs.100<input type="radio" name="ticket" value="STAR NIGHT" required="required" checked>STAR NIGHT - Rs.400<input type="radio" name="ticket" value="THREE NIGHT" required="required">THREE NIGHT - Rs.550<input type="radio" name="ticket" value="ALL" required="required">ALL - Rs.700
                                                                                        <?php }?>
                                                                                        <?php
                                                                                        if($tik=="THREE NIGHT") 
                                                                                        {
                                                                                            ?>
                                                                                            <input type="radio" name="ticket" value="FORMALS EVENT" required="required">FORMALS EVENT - Rs.150<input type="radio" name="ticket" value="BHANGRA NIGHT" required="required">BHANGRA NIGHT - Rs.50<input type="radio" name="ticket" value="EDM NIGHT" required="required">EDM NIGHT - Rs.100<input type="radio" name="ticket" value="STAR NIGHT" required="required">STAR NIGHT - Rs.400<input type="radio" name="ticket" value="THREE NIGHT" required="required" checked>THREE NIGHT - Rs.550<input type="radio" name="ticket" value="ALL" required="required">ALL - Rs.700
                                                                                            <?php }?>
                                                                                            <?php
                                                                                            if ($tik=="ALL") 
                                                                                            {
                                                                                                ?>
                                                                                                <input type="radio" name="ticket" value="FORMALS EVENT" required="required">FORMALS EVENT - Rs.150<input type="radio" name="ticket" value="BHANGRA NIGHT" required="required">BHANGRA NIGHT - Rs.50<input type="radio" name="ticket" value="EDM NIGHT" required="required">EDM NIGHT - Rs.100<input type="radio" name="ticket" value="STAR NIGHT" required="required">STAR NIGHT - Rs.400<input type="radio" name="ticket" value="THREE NIGHT" required="required">THREE NIGHT - Rs.550<input type="radio" name="ticket" value="ALL" required="required" checked>ALL - Rs.700
                                                                                                <?php }?>
                                                                                            </div>
                                                                                        </div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Status</label>
<div class="col-sm-10">
<?php  $stats=$result->Status;
if($stats=="0")
{
?>
<input type="radio" name="status" value="1" required="required">Paid <input type="radio" name="status" value="0" required="required" checked="">Not Paid 
<?php }?>
<?php  
if($stats=="1")
{
?>
<input type="radio" name="status" value="1" required="required" checked="">Paid <input type="radio" name="status" value="0" required="required">Not Paid 
<?php }?>



</div>
</div>

<?php }} ?>                                                    

                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" class="btn btn-primary">Add</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-12 -->
                                </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
    </body>
</html>
<?PHP } ?>
