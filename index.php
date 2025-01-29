<?php
session_start();
require_once 'db.php';

// Check if the session is set for the logged-in user
if(isset($_SESSION['user'])) {
    $userId = $_SESSION['user'];

    // Query to get user data (name and password)
    $query = "SELECT user_name, password FROM admins WHERE user_name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);  // Assuming user_id is an integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the user data
    if($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
        // echo "Name: " . $userId . "<br>";
//         echo "Password: " . $userData['password'] . "<br>";
    } else {
        echo "No user found.";
    }
} else {
    // header("location: ../adminlogin.php");
    $userId = "Public";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Primary Meta Tags -->
    <title>iRecovery - Document Recovery Platform</title>
    <meta name="title" content="iRecovery - Document Recovery Platform" />
    <meta name="description" content="iRecovery helps you report, upload, and search for lost or found documents. Connecting people to solutions, one document at a time." />
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://id.faithfellows.online/" />
    <meta property="og:title" content="iRecovery - Document Recovery Platform" />
    <meta property="og:description" content="iRecovery helps you report, upload, and search for lost or found documents. Connecting people to solutions, one document at a time." />
    <meta property="og:image" content="https://id.faithfellows.online/img/bg.jpg" />
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://id.faithfellows.online/" />
    <meta property="twitter:title" content="iRecovery - Document Recovery Platform" />
    <meta property="twitter:description" content="iRecovery helps you report, upload, and search for lost or found documents. Connecting people to solutions, one document at a time." />
       <meta property="og:image" content="https://id.faithfellows.online/img/bg.jpg" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Meta Tags Generated with https://metatags.io -->
  <style>

    .accordion-button:focus {
      box-shadow: none;
    }
    .form-label {
      font-weight: bold;
    }
    .container {
      max-width: 1200px;
    }
    .card-body {
      background-color: #f8f9fa;
      padding: 1rem;
      border-radius: 5px;
    }
    button {
      margin-top: 10px;
    }

    /* Hero Section Background */
    header {
      background-image: url('img/bg.jpg'); /* Replace with your image URL */
      background-size: cover;
      background-position: center;
      color: white;
      text-align: center;
      height: 300px;
      padding: 80px 0; /* Adjust padding for more space */
    }

    header h1 {
      font-size: 3rem;
      font-weight: bold;
    }

    header p {
      font-size: 1.2rem;
      font-weight: 500;
    }
  </style>
</head>
<body class="bg-light">

  <!-- Hero Section -->
  <header>
    <h1>iRecover</h1>
    <p>Document Recovery Platform   <br><br> <span class="text-primary bg-light" style="padding-left:10px; padding-right: 10px; border-radius: 50px; display: inline-block;"><?=$userId?></span></p>
  </header>
  
  <div class="container my-5">
    <h2 class="mb-4 text-center">Document Upload Forms</h2>
    <div class="row g-4">
      <!-- Card 1: Upload Found Document -->
      <div class="col-md-4">
        <div class="card shadow">
          <div class="card-header bg-success text-white text-center">
            <h4>Upload Found Document</h4>
          </div>
          <div class="card-body">
            <div class="accordion" id="accordionOne">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                   <span class="click"> Click to upload </span>
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionOne">
                  <div class="accordion-body">
                    <form action="submit_id.php" method="POST" enctype="multipart/form-data">
                      <div class="mb-3">
                        <label for="documentTypeOne" class="form-label">Document Type</label>
                        <select id="documentTypeOne" name="documentType" class="form-select" required>
                          <option value="academicDocument">Academic Document</option>
                          <option value="drivingPermit">Driving Permit</option>
                          <option value="nationalID">National ID</option>
                          <option value="studentID">Student ID</option>
                        </select>
                      </div>
                      <div id="dynamicFieldsOne"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Card 2: Report Lost Document -->
      <div class="col-md-4">
        <div class="card shadow">
          <div class="card-header bg-danger text-white text-center">
            <h4>Report Lost Document</h4>
          </div>
          <div class="card-body">
            <div class="accordion" id="accordionTwo">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <span class="click"> Click to upload </span>
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionTwo">
                  <div class="accordion-body">
                    <form action="report.php" method="POST" enctype="multipart/form-data">
                      <div class="mb-3">
                        <label for="documentTypeTwo" class="form-label">Document Type</label>
                        <select id="documentTypeTwo" name="documentType" class="form-select" required>
                          <option value="academicDocument">Academic Document</option>
                          <option value="drivingPermit">Driving Permit</option>
                          <option value="nationalID">National ID</option>
                          <option value="studentID">Student ID</option>
                        </select>
                      </div>
                      <div id="dynamicFieldsTwo"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Card 3: Search Found Documents -->
      <div class="col-md-4">
        <div class="card shadow">
          <div class="card-header bg-warning text-white text-center">
            <h4>Search Lost Documents</h4>
          </div>
          <div class="card-body">
            <div class="accordion" id="accordionThree">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                    <span class="click"> Click to search </span>
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionThree">
                  <div class="accordion-body">
                    <form action="search_id.php" method="POST" enctype="multipart/form-data">
                      <div class="mb-3">
                        <label for="documentTypeThree" class="form-label">Document Type</label>
                        <select id="documentTypeThree" name="documentType" class="form-select" required>
                          <option value="academicDocument">Academic Document</option>
                          <option value="drivingPermit">Driving Permit</option>
                          <option value="nationalID">National ID</option>
                          <option value="studentID">Student ID</option>
                        </select>
                      </div>
                      <div id="dynamicFieldsThree"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <p class="text-center mt-5">Powered by Kakebe Technologies</p>
    </div>
  </div>
  
<!-- JavaScript and Bootstrap 5 Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Event listener for document type selection change in each form
  document.getElementById('documentTypeOne').addEventListener('change', function() {
    updateFormFields(this, 'One');
  });

  document.getElementById('documentTypeTwo').addEventListener('change', function() {
    updateFormFields(this, 'Two');
  });

  document.getElementById('documentTypeThree').addEventListener('change', function() {
    updateFormFields(this, 'Three');
  });

  // Function to update the form fields dynamically based on selected document type
  function updateFormFields(selectElement, formNumber) {
    let form = selectElement.closest('form');
    let documentType = selectElement.value;
    let dynamicFieldsContainer = document.getElementById('dynamicFields' + formNumber);

    // Clear previous dynamic fields
    dynamicFieldsContainer.innerHTML = '';

    if (documentType === 'nationalID') {
      addNationalIDFields(dynamicFieldsContainer);
    } else if (documentType === 'drivingPermit') {
      addDrivingPermitFields(dynamicFieldsContainer);
    } else if (documentType === 'studentID') {
      addStudentIDFields(dynamicFieldsContainer);
    } else if (documentType === 'academicDocument') {
      addAcademicDocumentFields(dynamicFieldsContainer);
    }

    // Always add the file upload and submit button at the end
    addFileUploadAndSubmit(dynamicFieldsContainer, formNumber);
  }

  // Function to add National ID specific fields
  function addNationalIDFields(container) {
    const fieldsHTML = `
      <div class="mb-3">
        <label for="surName" class="form-label">Sur Name</label>
        <input type="text" name="surName" class="form-control" id="surName" required>
        <input type="hidden" name="reporter" class="form-control" id="academicLevel" value="<?=$userId;?>" required readonly>
      </div>
      <div class="mb-3">
        <label for="givenName" class="form-label">Given Name</label>
        <input type="text" name="givenName" class="form-control" id="givenName" required>
      </div>
      <div class="mb-3">
        <label for="dob" class="form-label">Date of Birth</label>
        <input type="date" name="dob" class="form-control" id="dob" required>
      </div>
      <div class="mb-3">
        <label for="nationality" class="form-label">NIN Number</label>
        <input type="text" name="nationality" class="form-control" id="nationality" required>
      </div>
      <div class="mb-3">
        <label for="gender" class="form-label">Gender</label>
        <select name="gender" class="form-select" id="gender" required>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
      </div>
    `;
    container.insertAdjacentHTML('beforeend', fieldsHTML);
  }

  // Function to add Driving Permit specific fields
  function addDrivingPermitFields(container) {
    const fieldsHTML = `
      <div class="mb-3">
        <label for="surName" class="form-label">Sur Name</label>
        <input type="text" name="surName" class="form-control" id="surName" required>
        <input type="hidden" name="reporter" class="form-control" id="academicLevel" value="<?=$userId;?>" required readonly>
      </div>
      <div class="mb-3">
        <label for="givenName" class="form-label">Given Name</label>
        <input type="text" name="givenName" class="form-control" id="givenName" required>
      </div>
      <div class="mb-3">
        <label for="dob" class="form-label">Date of Birth</label>
        <input type="date" name="dob" class="form-control" id="dob" required>
      </div>
      <div class="mb-3">
        <label for="permitNumber" class="form-label">Permit Number (Licence)</label>
        <input type="text" name="permitNumber" class="form-control" id="permitNumber" required>
      </div>
      <div class="mb-3">
        <label for="nationality" class="form-label">NIN Number</label>
        <input type="text" name="nin" class="form-control" id="nationality" required>
      </div>
    `;
    container.insertAdjacentHTML('beforeend', fieldsHTML);
  }

  // Function to add Student ID specific fields
  function addStudentIDFields(container) {
    const fieldsHTML = `
      <div class="mb-3">
        <label for="surName" class="form-label">Sur Name</label>
        <input type="text" name="surName" class="form-control" id="surName" required>
        <input type="hidden" name="reporter" class="form-control" id="academicLevel" value="<?=$userId;?>" required readonly>
      </div>
      <div class="mb-3">
        <label for="givenName" class="form-label">Given Name</label>
        <input type="text" name="givenName" class="form-control" id="givenName" required>
      </div>
      <div class="mb-3">
        <label for="studentNumber" class="form-label">Registration Number/Code</label>
        <input type="text" name="studentNumber" class="form-control" id="studentNumber" required>
      </div>
      <div class="mb-3">
        <label for="course" class="form-label">Course</label>
        <input type="text" name="course" class="form-control" id="course" required>
      </div>
      <div class="mb-3">
        <label for="dateIssued" class="form-label">Date of Issue</label>
        <input type="date" name="dateIssued" class="form-control" id="dateIssued" required>
      </div>
      <div class="mb-3">
        <label for="school" class="form-label">School</label>
        <input type="text" name="school" class="form-control" id="school" required>
      </div>
    `;
    container.insertAdjacentHTML('beforeend', fieldsHTML);
  }

  // Function to add Academic Document specific fields
  function addAcademicDocumentFields(container) {
    const fieldsHTML = `
      <div class="mb-3">
        <label for="academicLevel" class="form-label">Academic Level</label>
        <input type="text" name="academicLevel" class="form-control" id="academicLevel" required>
        <input type="hidden" name="reporter" class="form-control" id="academicLevel" value="<?=$userId;?>" required readonly>
      </div>
      <div class="mb-3">
        <label for="institutionName" class="form-label">Institution Name</label>
        <input type="text" name="institutionName" class="form-control" id="institutionName" required>
      </div>
      <div class="mb-3">
        <label for="courseTitle" class="form-label">Course Title</label>
        <input type="text" name="courseTitle" class="form-control" id="courseTitle" required>
      </div>
      <div class="mb-3">
        <label for="graduationYear" class="form-label">Graduation Year</label>
        <input type="number" name="graduationYear" class="form-control" id="graduationYear" required>
      </div>
    `;
    container.insertAdjacentHTML('beforeend', fieldsHTML);
  }

  // Function to add image upload fields and submit button
  function addFileUploadAndSubmit(container, formNumber) {
    // If it's not the third form, add the file upload fields
    if (formNumber !== 'Three') {
      const fileUploadHTML = `
        <div class="mb-3">
          <label for="front_img" class="form-label">Front side of document</label>
          <input type="file" name="front_img" class="form-control" id="front_img" required>
        </div>
        <div class="mb-3">
          <label for="back_img" class="form-label">Back side of document</label>
          <input type="file" name="back_img" class="form-control" id="back_img">
        </div>
      `;
      container.insertAdjacentHTML('beforeend', fileUploadHTML);
    }
    
    // Always add the submit button at the end
    const submitButtonHTML = `
      <div class="mb-3">
        <button type="submit" class="btn btn-dark">Submit Document</button>
      </div>
    `;
    container.insertAdjacentHTML('beforeend', submitButtonHTML);
  }
});
</script>


</body>
</html>
