<?php
include_once 'db.php';
// Random Name Generator
function generatenames($length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'; // Characters to use
    $randomString = '';
    $maxIndex = strlen($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $randomIndex = random_int(0, $maxIndex); // Secure random index
        $randomString .= $characters[$randomIndex];
    }

    return $randomString;
}


// Check for the type of document sent here
if(isset($_POST['nationality'])){
     echo "National Id<br><br>";
     $reporter = $_POST['reporter'];
     $sur_name = $_POST['surName'];
     $given_name = $_POST['givenName'];
     $dob = $_POST['dob'];
     $nationality = $_POST['nationality'];
     $gender = $_POST['gender'];
     $front_img = $_FILES['front_img']['name'];
     $front_tmp =$_FILES['front_img']['tmp_name'];
     $back_img = $_FILES['back_img']['name'];
     $back_tmp = $_FILES['back_img']['tmp_name'];
     $date = Date("Y-m-d / h:i:s A");
     $random_name = generatenames(5);
     $new_front = "NID_FrontRand_66_".$random_name.".png";
     $new_back = "NID_BackRand_55_".$random_name.".png";
     $front_uploader = move_uploaded_file($front_tmp,"uploads/".$new_front);
     $back_uploader = move_uploaded_file($back_tmp,"uploads/".$new_back);
     $action = "Reported";
     $punch_data ="INSERT INTO national_ids(national_id, sur_name, given_name, dob, nin_number, gender, front, back, user_action, reporter, date_found) 
     VALUES('', '$sur_name', '$given_name', '$dob', '$nationality', '$gender', '$new_front', '$new_back', '$action', $reporter, '$date')";
     $query_data = mysqli_query($conn, $punch_data);
     
     if ($query_data == TRUE) {
        echo "Issue taken in successfully";
     }else{
        echo "There was a system error!";
     }

}



if(isset($_POST['permitNumber'])){
     echo "Driving Permit";
     $reporter = $_POST['reporter'];
     $sur_name = $_POST['surName'];
     $given_name = $_POST['givenName'];
     $dob = $_POST['dob'];
     $permit_number = $_POST['permitNumber'];
     $nationality = $_POST['nin'];
     $front_img = $_FILES['front_img']['name'];
     $front_tmp =$_FILES['front_img']['tmp_name'];
     $back_img = $_FILES['back_img']['name'];
     $back_tmp = $_FILES['back_img']['tmp_name'];
     $date = Date("Y-m-d / h:i:s A");
     $random_name = generatenames(5);
     $new_front = "NID_FrontRand_66_".$random_name.".png";
     $new_back = "NID_BackRand_55_".$random_name.".png";
     $front_uploader = move_uploaded_file($front_tmp,"uploads/".$new_front);
     $back_uploader = move_uploaded_file($back_tmp,"uploads/".$new_back);
     $action = "Reported";
     $punch_data ="INSERT INTO driving_permits(driver_id, sur_name, given_name, dob, permit_number, nin_number, front, back, user_action, reporter, date_found) 
     VALUES('', '$sur_name', '$given_name', '$dob', '$permit_number', '$nationality', '$new_front', '$new_back', '$action', '$reporter', '$date')";
     $query_data = mysqli_query($conn, $punch_data);
     
     if ($query_data == TRUE) {
        echo "Issue taken in successfully";
     }else{
        echo "There was a system error!";
     }

}elseif(isset($_POST['studentNumber'])){
    echo "Student Id";

     $reporter = $_POST['reporter'];
     $sur_name = $_POST['surName'];
     $given_name = $_POST['givenName'];
     $student_number = $_POST['studentNumber'];
     $course = $_POST['course'];
     $issued = $_POST['dateIssued'];
     $school = $_POST['school'];
     $front_img = $_FILES['front_img']['name'];
     $front_tmp =$_FILES['front_img']['tmp_name'];
     $back_img = $_FILES['back_img']['name'];
     $back_tmp = $_FILES['back_img']['tmp_name'];
     $date = Date("Y-m-d / h:i:s A");
     $random_name = generatenames(5);
     $new_front = "NID_FrontRand_66_".$random_name.".png";
     $new_back = "NID_BackRand_55_".$random_name.".png";
     $front_uploader = move_uploaded_file($front_tmp,"uploads/".$new_front);
     $back_uploader = move_uploaded_file($back_tmp,"uploads/".$new_back);
     $action = "Reported";
     $punch_data ="INSERT INTO student_ids(student_id, sur_name, given_name, student_number, course, date_issued, school, front, back, user_action, reporter, date_found) 
     VALUES('', '$sur_name', '$given_name', '$student_number', '$course', '$issued', '$school', '$new_front', '$new_back', '$action', '$reporter', '$date')";
     $query_data = mysqli_query($conn, $punch_data);
     
     if ($query_data == TRUE) {
        echo "Issue taken in successfully";
     }else{
        echo "There was a system error!";
     }
}else{
    // echo "I see nothig posted sir!";
}
?>
