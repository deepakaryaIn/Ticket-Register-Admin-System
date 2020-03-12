<?php
session_start();
error_reporting(0);
include('includes/config.php');
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
    $status=0;
    $sql="INSERT INTO  register(fname,lname,contno,emailid,collname,gender,dob,ticket,Status) VALUES(:fname,:lname,:contno,:emailid,:collname,:gender,:dob,:ticket,:status)";
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
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        header('Location: ../');
    }
    else 
    {
        $error="Something went wrong. Please try again";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">
                    <div class="main-page">
                       <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">Registration</h2>
                            </div>
                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="../"><i class="fa fa-home"></i> Home</a></li>

                                    <li class="active">Registration</li>
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

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">First Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="fname" class="form-control" id="fname" required="required" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Last Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="lname" class="form-control" id="lname" required="required" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Contact No.</label>
                                                <div class="col-sm-10">
                                                    <input type="tel" name="contno" class="form-control" id="contno" minlength="10" minlength="10"  required="required" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Email id</label>
                                                <div class="col-sm-10">
                                                    <input type="email" name="emailid" class="form-control" id="emailid" required="required" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">College / School Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="collname" class="form-control" id="collname" required="required" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Gender</label>
                                                <div class="col-sm-10">
                                                    <input type="radio" name="gender" value="Male" required="required" checked="">Male <input type="radio" name="gender" value="Female" required="required">Female <input type="radio" name="gender" value="Other" required="required">Other
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="date" class="col-sm-2 control-label">DOB</label>
                                                <div class="col-sm-10">
                                                    <input type="date"  name="dob" class="form-control" id="date">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Select Ticket</label>
                                                <div class="col-sm-10">
                                                    <input type="radio" name="ticket" value="FORMALS EVENT" required="required" checked="">FORMALS EVENT - Rs.150</br>  <input type="radio" name="ticket" value="BHANGRA NIGHT" required="required">BHANGRA NIGHT - Rs.50</br>   <input type="radio" name="ticket" value="EDM NIGHT" required="required">EDM NIGHT - Rs.100</br>  <input type="radio" name="ticket" value="STAR NIGHT" required="required">STAR NIGHT - Rs.400</br>  <input type="radio" name="ticket" value="THREE NIGHT" required="required">THREE NIGHT - Rs.550</br>   <input type="radio" name="ticket" value="ALL" required="required">ALL - Rs.700
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="submit" >SUBMIT</button>
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
