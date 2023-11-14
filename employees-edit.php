<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Light Bootstrap Dashboard - Free Bootstrap 4 Admin Dashboard by Creative Tim</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">

        <?php
                require('config/config.php');
                require('config/db.php');

            $id = $_GET['id'];

            $query = "SELECT * FROM employee WHERE id=".$id;

            $result = mysqli_query($conn, $query);  

            if(mysqli_num_rows($result)==1){
                $employee = mysqli_fetch_array($result);
                $lastname = $employee['lastname'];
                $firstname = $employee['firstname'];
                $address = $employee['address'];
                $office_id = $employee['office_id'];
            }

            mysqli_free_result($result);
            mysqli_close($conn);
         
        ?>


        <div class="sidebar" data-image="assets/img/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <?php
                    $active_sidebar = "employees";
                    include('includes/sidebar.php');
                ?>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <?php include('includes/navbar.php');?>
            <!-- End Navbar -->


            <?php
                require('config/db.php');

                if (isset($_POST['submit'])){
                    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
                    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
                    $address = mysqli_real_escape_string($conn, $_POST['address']);
                    $office_id = mysqli_real_escape_string($conn, $_POST['office_id']);
                        
                    $sql = "UPDATE employee SET lastname='$lastname', firstname='$firstname', address='$address', office_id='$office_id'
                    WHERE id=".$id;

                    if (mysqli_query($conn, $sql)) {
                        echo "<script>alert('Employee updated')</script>";
                    } else {
                        echo "Error: ".mysqli_error($conn);
                    }
                }

                mysqli_close($conn);
            ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="section">
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="name">Lastname</label>
                                                    <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="contactnum">First name</label>
                                                    <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Address</label>
                                                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="address">Office name</label>
                                                    <!-- <input type="text" class="form-control" name="office_id"> -->
                                                    <select class="custom-select" name="office_id">
                                                        <?php
                                                            require('config/db.php');
                                                            
                                                            $query = "SELECT name FROM office WHERE id =".$office_id;
                                                            $result = mysqli_query($conn, $query);

                                                            if ($result && mysqli_num_rows($result) == 1) {
                                                                $row = mysqli_fetch_row($result);
                                                                $name = $row[0];
                                                                echo "<script>alert(".$name.")</script>";
                                                                echo "<option value='".$office_id."'>".$name."</option>";
                                                            } else {
                                                                $name = "No office found";
                                                            }

                                                            mysqli_free_result($result);
                                                            mysqli_close($conn);
                                                        ?>

                                                        <?php
                                                            require('config/db.php');

                                                            $query = "SELECT * FROM office";
                                                            $result = mysqli_query($conn, $query);  

                                                            if (mysqli_num_rows($result) > 0) {
                                                                while ($office = mysqli_fetch_assoc($result)) {
                                                                    echo "<option value='" . $office['id'] . "'>" . $office['name'] . "</option>";
                                                                }
                                                            } else {
                                                                echo "<option value=''>No offices available</option>";
                                                            }

                                                            mysqli_free_result($result);
                                                            mysqli_close($conn);
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" name="submit" value="submit" class="btn btn-info btn-fill pull-right">Save</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>
