<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Booking</title>
    
    <link rel="stylesheet" href="../asset/css/bootstrap.css">
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
  
<?php
include('../include/adminheader.php');
include('../include/navbar.php');
include('../include/adminTopbar.php');
?>

<div class="container-fluid mt-5">
    <div class="row">

    <!-- personal infomaton -->
        <div class="col-lg-12 col-md-12 col-12 mb-5">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                    <h1 class="h2 text-dark text-left">Venues</h1>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 text-center">
                    <button type="button" class="btn btn-sm mybg text-light item-left" data-bs-toggle="modal" data-bs-target="#newVenue">Add Venue</button>
                </div>
                
                
            </div>

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="table-responsive">
                    <table class="table table-striped table-hover">
          <thead>
          <tr>
            <th scope="col">S/N</th>
            <th scope="col">Name</th>
            <th scope="col">Telephone</th>
            <th scope="col">Email</th>
            <th scope="col">Capacity</th>
            <th scope="col">Location</th>
            <th scope="col">Services</th>
            <th scope="col">Price</th>
            <th scope="col">Edit/Delete</th>
          </tr>
          </thead>
          <tbody>

          <?php
            require_once("../handler/connection.php");
            $stmt=$conn->prepare("SELECT * FROM venue");  
            $stmt->execute();

            $sn = 1;
            while($show=$stmt->fetch()){

            
            

            ?>
           
          <tr>
            <th scope="row"><?php echo $sn?></th>
            <td><?php echo $show['v_Name']?></td>
            <td><?php echo $show['phone']?></td>
            <td><?php echo $show['email']?></td>
            <td><?php echo $show['capacity']?></td>
            <td><?php echo $show['location']?></td>
            <td class="text-truncate"><?php echo $show['Service']?></td>
            <td><?php echo number_format($show['Price']) ?></td>
            
            <td>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editVenue<?php echo $show['venueId']?>" <?php echo $show['venueId']?>>Edit</button>
              <a class="btn btn-sm bg-danger text-light" onclick="return confirm('Are you sure want to delete?');" href="../handler/deleteVenue.php?vid=<?php echo $show["venueId"]; ?>">Delete</a>
            </td>
          </tr>
                <!-- End of the table -->

<!-- Modal to Edit Venue Details -->

<div class="modal fade" id="editVenue<?php echo $show['venueId']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editVenue" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header mybg">
        <h5 class="modal-title" id="editVenue">Edit Venue</h5>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
      <form method="POST" action="../handler/editVenue.php" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="name" class="text-dark">Venue Name:</label>
                        <input type="text" value="<?php echo $show['v_Name']?>" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="text-dark">Telephone:</label>
                        <input type="tell" value="<?php echo $show['phone']?>" class="form-control" name="phone" id="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-dark">Email:</label>
                        <input type="email" value="<?php echo $show['email']?>" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="price" class="text-dark">Price:</label>
                        <input type="number" value="<?php echo$show['Price']?>" class="form-control" name="price" id="price" required>
                    </div>
                    <div class="form-group">
                        <label for="capacity" lass="text-dark">Capacity:</label>
                        <input type="number" value="<?php echo $show['capacity']?>" class="form-control" name="capacity" id="capacity" required>
                    </div>
                    <div class="form-group">
                        <label for="location"  class="text-dark">Location:</label>
                        <input type="text" value="<?php echo $show['location']?>" class="form-control" name="location" id="location" required>
                    </div>
                    <div class="form-group">
                        <label for="service" class="text-dark">Services:</label>
                        <input type="text" value="<?php echo $show['Service']?>" class="form-control" name="service" id="service" required>
                    </div>
                    <input type="text" hidden readonly name="id" value=" <?php echo $show['venueId']?>">
                    
                    <button type="submit" name="submit" class="btn btn-primary mybg">Edit Venue</button>
                </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>



          <?php $sn++;
            }
          ?>
                    
          </tbody>
        </table>
                    </div>
                </div>
                <script src="../asset\js\bootstrap.bundle.min.js"></script>

<!-- Mordal to Add Venue -->

      <div class="modal fade" id="newVenue" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newVenue" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header mybg">
        <h5 class="modal-title" id="newVenue">Add Venue</h5>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
      <form method="POST" action="../handler/addVhandler.php" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="name" class="text-dark">Venue Name:</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="text-dark">Telephone:</label>
                        <input type="tell" class="form-control" name="phone" id="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-dark">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="price" class="text-dark">Price:</label>
                        <input type="number" class="form-control" name="price" id="price" required>
                    </div>
                    <div class="form-group">
                        <label for="capacity" lass="text-dark">Capacity:</label>
                        <input type="number" class="form-control" name="capacity" id="capacity" required>
                    </div>
                    <div class="form-group">
                        <label for="location" class="text-dark">Location:</label>
                        <input type="text" class="form-control" name="location" id="location" required>
                    </div>
                    <div class="form-group">
                        <label for="service" class="text-dark">Services:</label>
                        <input type="text" class="form-control" name="service" id="service" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class="text-dark">Description:</label>
                        <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="image" class="text-dark">Image:</label>
                        <input type="file" class="form-control" name="image" id="image" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mybg">Add Venue</button>
                </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
            </div>
        </div>


            </div>
        </div>

    
    </div> 
    <!-- end of row   -->
</div>
<?php include('../include/adminscript.php');
include('../include/adminfooter.php');?>       
</body>
</html>