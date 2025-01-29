<?php
session_start();
require_once '../db.php';

// Check if the session is set for the logged-in user
if(isset($_SESSION['user'])) {
    $userId = $_SESSION['user'];

    // Query to get user data (name and password)
    $query = "SELECT name, password FROM superadmins WHERE name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);  // Assuming user_id is an integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the user data
    if($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
//         echo "Name: " . $userData['name'] . "<br>";
//         echo "Password: " . $userData['password'] . "<br>";
    } else {
        echo "No user found.";
    }
} else {
    header("location: ../adminlogin.php");
}






// Fetch counts for top cards
$userCount = $conn->query("SELECT COUNT(*) AS total FROM admins");
if ($userCount) {
    $userCount = $userCount->fetch_assoc()['total'];
} else {
    die("Error: " . $conn->error);
}

// Count lost documents (user_action = 'Found') across all tables
$lostDocsQuery = "
  SELECT 
    (SELECT COUNT(*) FROM national_ids WHERE user_action = 'Found') +
    (SELECT COUNT(*) FROM student_ids WHERE user_action = 'Found') +
    (SELECT COUNT(*) FROM driving_permits WHERE user_action = 'Found') AS total";
$lostDocs = $conn->query($lostDocsQuery);
if ($lostDocs) {
    $lostDocs = $lostDocs->fetch_assoc()['total'];
} else {
    die("Error: " . $conn->error);
}

// Count reported documents (user_action = 'Reported') across all tables
$reportedDocsQuery =  "
SELECT 
  (SELECT COUNT(*) FROM national_ids WHERE user_action = 'Reported') +
  (SELECT COUNT(*) FROM student_ids WHERE user_action = 'Reported') +
  (SELECT COUNT(*) FROM driving_permits WHERE user_action = 'Reported') AS total"; 
$reportedDocs = $conn->query($reportedDocsQuery);
if ($reportedDocs) {
    $reportedDocs = $reportedDocs->fetch_assoc()['total'];
} else {
    die("Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
::-webkit-scrollbar {
  width: 5px; /* Width of the scrollbar */
}

::-webkit-scrollbar-track {
  background: #999; /* Background of the track */
}

::-webkit-scrollbar-thumb {
  background: #888; /* Color of the scrollbar handle */
  border-radius: 10px; /* Rounded corners for the handle */
}

::-webkit-scrollbar-thumb:hover {
  background: #555; /* Darker color when hovered */
}





    .card {
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      border: none;
      border-radius: 10px;
    }
    .tab-content {
      margin-top: 20px;
    }

    /* Sticky table header */
    .table thead th {
      position: sticky;
      top: 0;
      background-color: #f8f9fa;
      z-index: 1;
    }

    .popup {
          display: none;
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.5);
          z-index: 1000;
          overflow-y: auto;
          }

          

          .popup-content {
          background: #fff;
          margin: 2% auto;
          padding: 20px;
          border-radius: 8px;
          width: 50%;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
          text-align: left;
          }

          .popup-close {
          color: #aaa;
          font-size: 24px;
          font-weight: bold;
          float: right;
          cursor: pointer;
          }
          .popup-close:hover {
          color: #000;
          }



          .popupf {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    overflow-y: auto;
  }
  .popup-content {
    background: white;
    padding: 20px;
    margin: 50px auto;
    border-radius: 8px;
    max-width: 500px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }
  .popup-closef {
    float: right;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
  }
  .popup-closef:hover {
    color: red;
  }

  </style>
</head>
<body>
<!-- Header Section -->
<div class="header bg-dark text-white py-4">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1>iRecover</h1>
        <p>Welcome <b><?php echo $userId; ?></b></p>
      </div>
      <div class="col-md-6 text-md-end">
        <a href="logout.php" class="btn btn-light">Logout</a>
      </div>
    </div>
  </div>
</div>

<div class="container my-5">
  <!-- Top Cards -->
  <div class="row text-center mb-4">
    <div class="col-md-4">
      <div class="card p-4">
        <h3><?php echo $userCount; ?></h3>
        <p>Total Users</p>
        <button id="addUserBtn" class="btn btn-dark" sonclick="window.location.href='add_user.php'">Add Users</button>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4">
        <h3><?php echo $lostDocs; ?></h3>
        <p>Lost Documents</p>
        <button class="btn" style="color:white; background: white; cursor: auto;">Add Users</button>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4">
        <h3><?php echo $reportedDocs; ?></h3>
        <p>Reported Documents</p>
        <button class="btn" style="color:white; background: white; cursor: auto;">Add Users</button>
      </div>
    </div>
  </div>

  <!-- <br> -->
  <hr>
  <br>

  <!-- Search Bar -->
  <div class="mb-4">
    <input type="text" id="searchInput" class="form-control" placeholder="Search for documents..." onkeyup="filterTable()">
  </div>

  <!-- Tabs for Data Tables -->
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" href="javascript:void(0);" onclick="subtabs(event, 'users')">Users</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="javascript:void(0);" onclick="subtabs(event, 'lostDocs')">Lost Documents</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="javascript:void(0);" onclick="subtabs(event, 'reportedDocs')">Reported Documents</a>
    </li>
  </ul>

  <div class="tab-content">
    <!-- Users Table -->
    <div id="users" class="tab-pane fade show active tab">
      <table class="table table-striped mt-3">
        <thead>
          <tr>
            <!--<th>User Id</th>-->
            <th>User Name</th>
            <th>Phone</th>
            <!--<th>Email</th>-->
            <th>Lst_Ids</th>
            <th>Lst_St Docs</th>
            <th>Lst_Prmts</th>
            <th>Password</th>
            <!--<th>District</th>-->
            <th>Address</th>
            <th>Type of entity</th>
            <!--<th>Registration date</th>-->
          </tr>
        </thead>
        <tbody>
          <?php
          $users = $conn->query("SELECT *, COUNT(national_ids.reporter) as nid_docs, COUNT(student_ids.reporter) as sid_docs, COUNT(driving_permits.reporter) as did_docs  FROM admins LEFT JOIN driving_permits ON admins.user_name=driving_permits.reporter LEFT JOIN national_ids ON admins.user_name=national_ids.reporter LEFT JOIN student_ids ON admins.user_name=student_ids.reporter GROUP BY admins.user_name ORDER BY admins.user_id DESC");
          if ($users) {
              while ($row = $users->fetch_assoc()) {
                  echo "<tr>
                      <!-- <td>{$row['user_id']}</td> -->
                      <td>{$row['user_name']}</td>
                      <td>{$row['number']}</td> 
                     <!-- <td>{$row['email']}</td> -->
                      <td>{$row['nid_docs']}</td>
                      <td>{$row['sid_docs']}</td>
                      <td>{$row['did_docs']}</td>
                      <td>{$row['password']}</td>
                      <td>{$row['address']}</td>
                      <td>{$row['type_of_entity']}</td>
                      <!-- <td>{$row['user_name']}</td> -->
                      <!-- <td>{$row['registered_at']}</td> -->
                    </tr>";
              }
          } else {
              echo "Error fetching users: " . $conn->error;
          }
          ?>
        </tbody>
      </table>
    </div>

    <!-- Lost Documents Table -->
    <div id="lostDocs" class="tab-pane fade tab">
    <table class="table table-striped mt-3">
  <thead>
    <tr>
      <th>ID</th>
      <th>Document Type</th>
      <th>Owner Name</th>
      <th>Status</th>
      <th>Reported At</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $lostQuery = "
      SELECT national_id as id, 'National ID' AS document_type, sur_name as owner_name, given_name, CONCAT('../uploads/',front) as front, CONCAT('../uploads/',back) as back, user_action, date_found as reported_at 
      FROM national_ids 
      WHERE user_action = 'Found'
      UNION ALL
      SELECT student_id as id, 'Student ID' AS document_type, sur_name as owner_name, given_name, CONCAT('../uploads/',front) as front, CONCAT('../uploads/',back) as back, user_action, date_found as reported_at 
      FROM student_ids 
      WHERE user_action = 'Found'
      UNION ALL
      SELECT driver_id as id, 'Driving Permit' AS document_type, sur_name as owner_name, given_name, CONCAT('../uploads/',front) as front, CONCAT('../uploads/',back) as back, user_action, date_found as reported_at 
      FROM driving_permits 
      WHERE user_action = 'Found'";

    $lost = $conn->query($lostQuery);
    if ($lost) {
        while ($row = $lost->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['document_type']}</td>
                <td>{$row['owner_name']} {$row['given_name']}</td>
                <td>{$row['user_action']}</td>
                <td>{$row['reported_at']}</td>
                <td>
                  <button class='view-btn' 
                    data-id='{$row['id']}' 
                    data-type='{$row['document_type']}' 
                    data-name='{$row['owner_name']}' 
                    data-second-name='{$row['given_name']}'
                    data-front-image='{$row['front']}'
                    data-back-image='{$row['back']}'
                    data-status='{$row['user_action']}' 
                    data-date='{$row['reported_at']}'>View</button>
                </td>
              </tr>";
        }
    } else {
        echo "Error fetching lost documents: " . $conn->error;
    }
    ?>
  </tbody>
</table>
    </div>

    <!-- Reported Documents Table -->
    <div id="reportedDocs" class="tab-pane fade tab">
      <table class="table table-striped mt-3">
        <thead>
          <tr>
            <th>ID</th>
            <th>Document Type</th>
            <th>Owner Name</th>
            <th>Status</th>
            <th>Reported At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $reported = $conn->query("
          SELECT national_id as id, 'National ID' AS document_type, sur_name as owner_name, given_name, CONCAT('../uploads/',front) as front, CONCAT('../uploads/',back) as back, user_action, date_found as reported_at 
          FROM national_ids 
          WHERE user_action = 'Reported'
          UNION ALL
          SELECT student_id as id, 'Student ID' AS document_type, sur_name as owner_name, given_name, CONCAT('../uploads/',front) as front, CONCAT('../uploads/',back) as back, user_action, date_found as reported_at 
          FROM student_ids 
          WHERE user_action = 'Reported'
          UNION ALL
          SELECT driver_id as id, 'Driving Permit' AS document_type, sur_name as owner_name, given_name, CONCAT('../uploads/',front) as front, CONCAT('../uploads/',back) as back, user_action, date_found as reported_at 
          FROM driving_permits 
          WHERE user_action = 'Reported'");
          if ($reported) {
              while ($row = $reported->fetch_assoc()) {
                  echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['document_type']}</td>
                    <td>{$row['owner_name']} {$row['given_name']}</td>
                    <td>{$row['user_action']}</td>
                    <td>{$row['reported_at']}</td>
                    <td>
                     <button class='view-btn' 
                     data-id='{$row['id']}' 
                     data-type='{$row['document_type']}' 
                     data-name='{$row['owner_name']}' 
                     data-second-name='{$row['given_name']}'
                     data-front-image='{$row['front']}'
                     data-back-image='{$row['back']}'
                     data-status='{$row['user_action']}' 
                     data-date='{$row['reported_at']}'>
                      View
                    </button>
                   </td>
                  </tr>";
              }
          } else {
              echo "Error fetching reported documents: " . $conn->error;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>



<!-- Popup Div Add User Form -->
<div id="userPopup" class="popupf">
  <div class="popup-contentf">
    <span class="popup-closef" id="closeUserPopup">&times;</span>
    <form id="addUserForm" method="POST" action="add_user.php" class="p-4 bg-light shadow rounded m-auto mt-1" style="width:40%;">
      <h3 class="text-center mb-2">Add New User</h3>
      <div id="msg"></div>
      <div class="form-group mb-3">
        <label for="userName">User Name:</label>
        <input type="text" id="userName" name="user_name" class="form-control" required>
      </div>
      <div class="form-group mb-3">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" class="form-control" required>
      </div>
      <div class="form-group mb-3">
        <label for="number">Number:</label>
        <input type="tel" id="number" name="number" class="form-control" required>
      </div>
      <div class="form-group mb-3">
        <label for="number">Email: <span style="color: #999;">(optional)</span></label>
        <input type="tel" id="email" name="email" class="form-control" required>
      </div>
      <div class="form-group mb-3">
        <label for="district">District:</label>
        <input type="text" id="district" name="district" class="form-control" required>
      </div>
      <div class="form-group mb-3">
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" class="form-control" required>
      </div>
      <div class="form-group mb-3">
        <label for="entityType">Type of Entity:</label>
        <select id="entityType" name="type_of_entity" class="form-control" required>
          <option value="">Select Entity Type</option>
          <option value="Individual">Individual</option>
          <option value="Company">Company</option>
          <option value="Organization">Organization</option>
        </select>
      </div>
      <button type="submit" class="btn btn-dark w-100">Add User</button>
    </form>
  </div>
</div>

<!-- Popup Document Viewer -->
<div id="popup" class="popup">
  <div class="popup-content">
    <span class="popup-close" id="closePopup">&times;</span>
    <h2>Document Details</h2>
    <p><strong>ID:</strong> <span id="popupId"></span></p>
    <p><strong>Document Type:</strong> <span id="popupType"></span></p>
    <p><strong>Owner Name:</strong> <span id="popupName"></span></p>
    <p><strong>Second Name:</strong> <span id="popupSecondName"></span></p>
    <p><strong>Status:</strong> <span id="popupStatus"></span></p>
    <p><strong>Reported At:</strong> <span id="popupDate"></span></p>
    <p><strong>Front Image:</strong> <br><img id="popupFrontImage" src="" alt="Front Image" style="width: 70%; max-width: 300px;"></p>
    <p><strong>Back Image:</strong> <br><img id="popupBackImage" src="" alt="Back Image" style="width: 70%; max-width: 300px;"></p>
  </div>
</div>



<!--Form -->
<script>
    var form = document.getElementById('addUserForm');
    form.addEventListener('submit', function(event){
        document.getElementById('msg').innerHTML = "<p style='padding: 5px;'>Saving User...</p>";
        event.preventDefault();
        var formData = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'user_saver.php', true);
        xhr.send(formData);
        xhr.onreadystatechange = function (){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById('msg').innerHTML = this.responseText;
            }else{
                document.getElementById('msg').innerHTML = "Error: " + this.statusText;
            }
        }
    });
</script>
<script>
  const addUserBtn = document.getElementById('addUserBtn');
  const userPopup = document.getElementById('userPopup');
  const closeUserPopup = document.getElementById('closeUserPopup');

  // Open popup
  addUserBtn.addEventListener('click', () => {
    userPopup.style.display = 'block';
  });

  // Close popup
  closeUserPopup.addEventListener('click', () => {
    userPopup.style.display = 'none';
  });

  // Close popup when clicking outside of it
  window.addEventListener('click', (event) => {
    if (event.target === userPopup) {
      userPopup.style.display = 'none';
    }
  });
</script>




<!-- Popup Document Viewer JS-->
<script>
  // Get elements
  const popup = document.getElementById('popup');
  const closePopup = document.getElementById('closePopup');
  const viewButtons = document.querySelectorAll('.view-btn');

  // Function to open the popup with the correct data
  viewButtons.forEach(button => {
    button.addEventListener('click', () => {
      document.getElementById('popupId').innerText = button.getAttribute('data-id');
      document.getElementById('popupType').innerText = button.getAttribute('data-type');
      document.getElementById('popupName').innerText = button.getAttribute('data-name');
      document.getElementById('popupSecondName').innerText = button.getAttribute('data-second-name');
      document.getElementById('popupStatus').innerText = button.getAttribute('data-status');
      document.getElementById('popupDate').innerText = button.getAttribute('data-date');

      const frontImage = button.getAttribute('data-front-image');
      const backImage = button.getAttribute('data-back-image');
      document.getElementById('popupFrontImage').src = frontImage || 'placeholder.png';
      document.getElementById('popupBackImage').src = backImage || 'placeholder.png';

      popup.style.display = 'block';
    });
  });

  // Close the popup
  closePopup.addEventListener('click', () => {
    popup.style.display = 'none';
  });

  // Close popup when clicking outside of it
  window.addEventListener('click', (event) => {
    if (event.target === popup) {
      popup.style.display = 'none';
    }
  });
</script>


<script>
  function subtabs(event, tabName) {
    var tabs = document.querySelectorAll('.tab');
    tabs.forEach(function(tab) {
      tab.classList.remove('show', 'active');
    });
    
    var tabLinks = document.querySelectorAll('.nav-link');
    tabLinks.forEach(function(link) {
      link.classList.remove('active');
    });

    event.target.classList.add('active');
    document.getElementById(tabName).classList.add('show', 'active');
  }
  
  function filterTable() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const tableRows = document.querySelectorAll('.tab-pane.active tbody tr');

    tableRows.forEach(function(row) {
      const rowText = row.innerText.toLowerCase();
      if (rowText.includes(searchInput)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }
</script>

</body>
</html>

