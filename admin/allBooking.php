<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Venue Booking</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../css/bootsrtap1" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php
    include('../include/adminheader.php');
    include('../include/navbar.php');
    include('../include/adminTopbar.php');


    include('../handler/connection.php');
    $stmt = $conn->prepare("SELECT * FROM booking_t, cutomers, venue, payment WHERE booking_t.customerId = cutomers.customerId AND booking_t.VenueId = venue.VenueId and booking_t.BookingId = payment.BookingId");
    $stmt->execute();
    
    ?>
    
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h1 class="h2 text-dark bold text-left">Your Booking History</h1>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Customer Name</th>
                                            <th>Hall Name</th>
                                            <th>Date</th>
                                            <th>Phone</th>
                                            <th>Reference_no</th>
                                            <th>Type of Service</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                        <?php
                                            $sn = 1;
                                            while($show = $stmt->fetch()){

                                            
                                        ?>
                                        <tr>
                                            <td><?php echo $sn?></td>
                                            <td><h6><?php echo $show['name']?></h6>
                                             <small><?php echo $show['fullName']?></small></td>
                                            <td><h6><?php echo $show['v_Name']?></h6>
                                            <small>Tsh <?php echo number_format( $show['Price'])?></small> </td>
                                            <td><?php echo $show['Date']?></td>
                                            <td><?php echo $show['Phone']?></td>
                                            <td><?php echo $show['reference_no']?></td>
                                            <td><?php echo $show['service_type']?></td>
                                            <td>
                                            <?php
                                            if($show['status'] == 0){
                                                echo "Pending";
                                            }else{
                                                echo "Comfirmed";

                                             }
                                             ?>
                                            </td>
                                                <?php
                                            if($show['status'] == 0){
                                                ?>
                                                <td><a href="../handler/allBookingHandler.php?confirm=<?php echo $show['BookingId']?>" class="btn btn-sm btn-success">Confirm</a></td>
                                            <?php }else{?>
                                                <td><a href="../handler/allBookingHandler.php?cencel=<?php echo $show['BookingId']?>" class="btn btn-sm btn-danger">Cancel</a></td>
                                            <?php }?>
                                            
                                            
                                         
                                          
                                        </tr>

                                        

                                        
                            </div>
                                      
                                        <?php $sn++;
                                             }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <script src="../asset\js\bootstrap.bundle.min.js"></script>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            </footer>
        
        <div class="container my-auto ">
      <div class="container text-center mb-4">
        <p class="mb-0">&copy; 2023 Venue Booking System. All rights reserved.</p>
      </div>
    </div>
    </footer>
            <!-- End of Footer -->

        </div>
   </div>
        <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
</body>
<?php include('../include/adminscript.php');
include('../include/adminfooter.php');?>
</html>