<!DOCTYPE html>
<html lang="en">

<?php
include("database/connection.php");
include("Inculde/head.php");


$getid = $_GET['id'];
$qurey2 = "SELECT * FROM `services` WHERE `Service_Id`='$getid'";
$res2 = mysqli_query($conn, $qurey2);
$row2 = mysqli_fetch_array($res2);

$date = date('d');
$millisecond = round(microtime(true) * 1000) % 1000;

if (isset($_POST['addservice'])) {
    // Service Name Start 
    $Service_Name = $_POST['Service_Name'];
    $Service_Details = $_POST['Service_Details'];
    $Service_Price = $_POST['Service_Price'];
    $Service_Name_Rspace = preg_replace('/\s+/', '', $Service_Name);
    // Service Name End

    // Service Image Start 
    $Service_Image_FName = $row2['Service_Image'];
    if (!empty($_FILES['Service_Image']['name'])) {
        $Service_Image = $_FILES['Service_Image'];
        $Service_Image_Name =  $Service_Image['name'];
        $Service_Image_FName = $Service_Name_Rspace . "-" . $date . "-" . $millisecond . "-" . $Service_Image_Name;
        move_uploaded_file($Service_Image['tmp_name'], "../images/services/" . $Service_Image_FName);
    }
    // Service Image End 

    // White Service Image Start 
    $White_Service_Image_FName = $row2["White_Service_Image"];
    if (!empty($_FILES["White_Service_Image"]['name'])) {
        $White_Service_Image = $_FILES["White_Service_Image"];
        $White_Service_Image_Name = $White_Service_Image['name'];
        $White_Service_Image_FName = $Service_Name_Rspace . "-" . $date . "-" . $millisecond . "-" . $White_Service_Image_Name;
        move_uploaded_file($White_Service_Image['tmp_name'], "../images/whiteservices/" . $White_Service_Image_FName);
    }
    // White Service Image End

    // Update Query
    $query = "UPDATE `services` SET `Service_Name` = '$Service_Name',`Service_Details` = '$Service_Details',`Service_Price` = '$Service_Price'   ,`Service_Image` = '$Service_Image_FName',`White_Service_Image` = '$White_Service_Image_FName' WHERE `Service_Id` = '$getid'";

    $res = mysqli_query($conn, $query);

    if ($res) {
        header("Location: manageServices.php");
        exit;
    } else {
        echo "<script>alert('Try Again...')</script>";
    }
}
?>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php include("Inculde/sidebar.php")
        ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include("Inculde/navbar.php") ?>
            <!-- Navbar End -->


            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Add Services</h6>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label">Service Name</label>
                                    <input type="text" class="form-control" name="Service_Name" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="<?php echo $row2[1] ?>">

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Service Details</label><br>
                                    <textarea name="Service_Details" rows="5" cols="50"><?php echo $row2[2] ?>
                                    </textarea>

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Service Price</label><br>
                                    <input type="number" class="form-control" name="Service_Price" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="<?php echo $row2[3] ?>">
                                </div>
<input type="datetime-local">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Service Image</label>
                                    <img class="bg-primary" src="../images/services/<?php echo $row2[4] ?>" alt="">
                                    <input type="file" class="form-control" name="Service_Image" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">White Service Image</label>
                                    <img class="bg-primary" src="../images/whiteservices/<?php echo $row2[5] ?>" alt="">
                                    <input type="file" class="form-control" name="White_Service_Image" id="exampleInputPassword1">
                                </div>
                                <button type="submit" class="btn btn-primary" name="addservice">Add Services</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form End -->


            <!-- Footer Start -->
            <?php include("Inculde/footer.php") ?>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>