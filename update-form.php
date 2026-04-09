<?php

if (empty($_GET['id'])  || !isset($_GET['id'])) {
    die("student id is required");
}


$id = $_GET['id'];

// 1. connect to db
require('./connection.php');

if (!$con) {
    die("connection failed "  . mysqli_connect_error());
}


// 2. select all students query
$sql = "SELECT * FROM studdata WHERE id=$id";

// 4. run query   
$result = mysqli_query($con, $sql);

// 5. fetch data
$data = mysqli_fetch_assoc($result);

// echo "<pre>";
//     print_r($data);
// echo "</pre>";

?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Interactive Registration | Student SMS</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet" />
    <style>
        body { background-color: #0f111a; min-height: 100vh; }
        
        /* Interactive Card: Glow on hover */
        .interactive-card { 
            background-color: #1a1d27; 
            border: 1px solid #2d323e; 
            border-radius: 24px; 
            transition: all 0.4s ease;
        }
        .interactive-card:hover {
            border-color: #0dcaf0;
            box-shadow: 0 0 25px rgba(13, 202, 240, 0.2);
            transform: translateY(-5px);
        }

        /* Input Interaction: Focused Glow */
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: #0dcaf0 !important;
        }
        .form-control:focus {
            border-color: #0dcaf0;
            box-shadow: 0 0 10px rgba(13, 202, 240, 0.15);
        }

        /* Animated Submit Button */
        .btn-interactive {
            background: linear-gradient(45deg, #0dcaf0, #007bff);
            border: none;
            padding: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        .btn-interactive:hover {
            letter-spacing: 2px;
            filter: brightness(1.1);
            box-shadow: 0 5px 15px rgba(13, 202, 240, 0.4);
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                
                <div class="interactive-card p-4 p-md-5">
                    <div class="text-center mb-5">
                        <div class="avatar-circle mx-auto mb-3" style="width: 70px; height: 70px; background: rgba(13, 202, 240, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="ri-user-heart-line text-info fs-1"></i>
                        </div>
                        <h3 class="fw-bold text-white mb-1">Join the Database</h3>
                        <p class="text-secondary small">Capture new student credentials</p>
                    </div>

                    <form method="post" action="./update.php">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">




                        <!-- Floating Label Name -->
                        <div class="form-floating mb-3">
                            <input type="text" name="name" value="<?php echo $data['name'] ?>" class="form-control" id="name" placeholder="Name" required>
                            <label for="name"><i class="ri-user-3-line me-2"></i>Full Name</label>
                        </div>

                        <!-- Floating Label Email -->
                        <div class="form-floating mb-3">
                            <input type="email" name="email" value="<?php echo $data['email'] ?>" class="form-control" id="email" placeholder="Email" required>
                            <label for="email"><i class="ri-mail-line me-2"></i>Email Address</label>
                        </div>

                        <!-- Floating Label Phone -->
                        <div class="form-floating mb-3">
                            <input type="number" name="number" value="<?php echo $data['phone'] ?>" class="form-control" id="phone" placeholder="Phone" required>
                            <label for="phone"><i class="ri-smartphone-line me-2"></i>Phone Number</label>
                        </div>

                        <!-- Interactive Select -->
                        <div class="form-floating mb-4">
                            <select class="form-select" name="gender" id="gender" required>
                                <option value="" disabled selected>Choose Gender</option>
                                <option value="Male" <?php echo ($data['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?php echo ($data['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                            </select>
                            <label for="gender"><i class="ri-genderless-line me-2"></i>Gender Identity</label>
                        </div>

                        <!-- Button with hover animation -->
                        <button type="submit" class="btn btn-primary btn-interactive w-100 rounded-pill">
                            UPDATE RECORD <i class="ri-arrow-right-line ms-2"></i>
                        </button>
                    </form>
                </div>

                <div class="text-center mt-4">
                    <a href="index.php" class="btn btn-link text-secondary text-decoration-none small">
                        <i class="ri-layout-grid-line me-1"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
