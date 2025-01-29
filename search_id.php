<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success iRecover</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
include_once 'db.php';
// Check for the type of document sent here
if(isset($_POST['nationality'])){
    //  echo "National Id<br><br>";
     $sur_name = $_POST['surName'];
     $given_name = $_POST['givenName'];
     $dob = $_POST['dob'];
     $nationality = $_POST['nationality'];
     $gender = $_POST['gender'];
     $select_data ="SELECT * FROM national_ids WHERE sur_name='$sur_name' AND given_name='$given_name' AND dob='$dob' AND gender='$gender' AND nin_number='$nationality'";
     $query_data = mysqli_query($conn, $select_data);
     
     if ($query_data == TRUE) {
        if (mysqli_num_rows($query_data) > 0) {
            $row =mysqli_fetch_assoc($query_data);
            $date_found =$row['date_found'];
            $img =$row['front'];
            ?>
            <div class="container mt-5">
        <!-- Success Alert -->
        <div class="alert alert-success alert-dismissible fade show shadow-lg rounded" role="alert">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="alert-heading mb-3">Document Found!</h4>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- Display Image -->
            <div class="mb-3">
                <img src="uploads/<?php echo htmlspecialchars($img); ?>" alt="User_Id Front Image" class="img-fluid rounded shadow-sm">
            </div>

            <!-- Message Content -->
            <p>Your National ID was found on: <strong><?php echo htmlspecialchars($date_found); ?></strong></p>
            <p>Please call <a href="tel:0777512529" class="btn btn-link">0777512529</a> for more information regarding getting it back.</p>

            <hr>
            <p class="mb-0">Thank you!</p>
        </div>
    </div>
            <?php
        }else {
            echo '
            <div class="alert alert-warning text-center" role="alert">
                <h4 class="alert-heading">No Match Found!</h4>
                <p class="mb-3">Unfortunately, we couldn’t find a document matching your search in our system at this time.</p>
                <hr>
                <p class="mb-2">We encourage you to check back in a couple of weeks, as new documents are added to our system regularly.</p>
                <a href="index.php" class="btn btn-primary mt-3">Ok</a>
            </div>';
        }
        
     }else{
        echo "There was a system error!";
     }

}if(isset($_POST['permitNumber'])){
    //  echo "Driving Permit";

     $sur_name = $_POST['surName'];
     $given_name = $_POST['givenName'];
     $dob = $_POST['dob'];
     $permit_number = $_POST['permitNumber'];
     $nationality = $_POST['nin'];
     $select_data ="SELECT * FROM driving_permits WHERE sur_name='$sur_name' AND given_name='$given_name' AND dob='$dob' AND permit_number='$permit_number'";
     $query_data = mysqli_query($conn, $select_data);
     
     if ($query_data == TRUE) {
        if (mysqli_num_rows($query_data) > 0) {
            $row =mysqli_fetch_assoc($query_data);
            $date_found =$row['date_found'];
            $img =$row['front'];
            ?>
            <div class="container mt-5">
        <!-- Success Alert -->
        <div class="alert alert-success alert-dismissible fade show shadow-lg rounded" role="alert">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="alert-heading mb-3">Document Found!</h4>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- Display Image -->
            <div class="mb-3">
                <img src="uploads/<?php echo htmlspecialchars($img); ?>" alt="User_Id Front Image" class="img-fluid rounded shadow-sm">
            </div>

            <!-- Message Content -->
            <p>Your National ID was found on: <strong><?php echo htmlspecialchars($date_found); ?></strong></p>
            <p>Please call <a href="tel:0393249845" class="btn btn-link">0393249845</a> for more information regarding getting it back.</p>

            <hr>
            <p class="mb-0">Thank you!</p>
        </div>
    </div>
            <?php
        }else {
            echo '
            <div class="alert alert-warning text-center" role="alert">
                <h4 class="alert-heading">No Match Found!</h4>
                <p class="mb-3">Unfortunately, we couldn’t find a document matching your search in our system at this time.</p>
                <hr>
                <p class="mb-2">We encourage you to check back in a couple of weeks, as new documents are added to our system regularly.</p>
                <a href="search-page-link" class="btn btn-primary mt-3">Search Again</a>
            </div>';
        }
        
     }else{
        echo "There was a system error!";
     }

}elseif(isset($_POST['studentNumber'])){
    // echo "Student Id";


     $sur_name = $_POST['surName'];
     $given_name = $_POST['givenName'];
     $student_number = $_POST['studentNumber'];
     $course = $_POST['course'];
     $issued = $_POST['dateIssued'];
     $school = $_POST['school'];
     $select_data ="SELECT * FROM student_ids WHERE sur_name='$sur_name' AND given_name='$given_name' AND school='$school' AND student_number='$student_number'";
     $query_data = mysqli_query($conn, $select_data);
     
     if ($query_data == TRUE) {
        if (mysqli_num_rows($query_data) > 0) {
            $row =mysqli_fetch_assoc($query_data);
            $date_found =$row['date_found'];
            $img =$row['front'];
            ?>
            <div class="container mt-5">
        <!-- Success Alert -->
        <div class="alert alert-success alert-dismissible fade show shadow-lg rounded" role="alert">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="alert-heading mb-3">Document Found!</h4>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- Display Image -->
            <div class="mb-3">
                <img src="uploads/<?php echo htmlspecialchars($img); ?>" alt="User_Id Front Image" class="img-fluid rounded shadow-sm">
            </div>

            <!-- Message Content -->
            <p>Your National ID was found on: <strong><?php echo htmlspecialchars($date_found); ?></strong></p>
            <p>Please call <a href="tel:0777512529" class="btn btn-link">0777512529</a> for more information regarding getting it back.</p>

            <hr>
            <p class="mb-0">Thank you!</p>
        </div>
    </div>
            <?php
        }else {
            echo '
            <div class="alert alert-warning text-center" role="alert">
                <h4 class="alert-heading">No Match Found!</h4>
                <p class="mb-3">Unfortunately, we couldn’t find a document matching your search in our system at this time.</p>
                <hr>
                <p class="mb-2">We encourage you to check back in a couple of weeks, as new documents are added to our system regularly.</p>
                <a href="search-page-link" class="btn btn-primary mt-3">Search Again</a>
            </div>';
        }
        
     }else{
        echo "There was a system error!";
     }
}else{
    // echo "I see nothig posted sir!";
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>