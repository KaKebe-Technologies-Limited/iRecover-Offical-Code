<?php
// Assume a match is found
$matched = true; // Set to true if the ID matches, or false if no match was found
$phoneNumber = '0393249845'; // Example phone number, you can change this
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success - ID Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJtHqP7nL8r+J2W2U-1sojYc7xUEbJ8R1v0zqS6N/gD5E2jB9m2EJ5d5jktz" crossorigin="anonymous">
    <style>
        body {
            background-color: #f4f8fb;
        }
        .card {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card-body h3 {
            color: #28a745;
        }
        .btn-phone {
            font-size: 1.2rem;
            padding: 12px 25px;
            background-color: #28a745;
            color: #fff;
            border-radius: 5px;
            text-align: center;
        }
        .btn-phone:hover {
            background-color: #218838;
        }
        .alert-success {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="container">
    <?php if ($matched): ?>
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <span class="me-2" style="font-size: 2rem;">😊</span>
            <div>
                <strong>Matched!</strong> Your ID has been successfully found.
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3><strong>Thank you!</strong> We have found your ID details.</h3>
                <p>Your ID has been successfully verified. If you have any questions or need further assistance, please contact us directly using the number below.</p>
                
                <h4>For assistance, call:</h4>
                <p class="lead">
                    <strong class="text-primary"><?php echo $phoneNumber; ?></strong>
                </p>
                <a href="tel:<?php echo $phoneNumber; ?>" class="btn-phone">Call Now</a>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <span class="me-2" style="font-size: 2rem;">😞</span>
            <div>
                <strong>No match found!</strong> The details you entered do not match any records.
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0YcLzQ1og4CU3oylD2J8+7ddcb9Qmt7Z2/xh3Gn9I+Mz7y55" crossorigin="anonymous"></script>
</body>
</html>
