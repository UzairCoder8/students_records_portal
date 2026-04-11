<?php session_start();
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet" />
    <style>
        body {
            background-color: #0f111a;
            min-height: 100vh;
        }

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
        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label {
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
                            <i class="ri-user-add-fill text-info fs-1"></i>
                        </div>
                        <h3 class="fw-bold text-white mb-1">Register</h3>
                        <p class="text-secondary small">Capture new student credentials</p>
                    </div>

                    <form method="post" action="./register.php">

                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                            <label for="name"><i class="ri-user-3-line me-2"></i>Name</label>
                            <?php if (isset($_SESSION['name-error']) && !empty($_SESSION['name-error'])) { ?>
                                <div class="alert alert-danger my-1"> <?php echo $_SESSION['name-error'];
                                                                        unset($_SESSION['name-error']) ?> </div>
                            <?php } ?>
                        </div>


                        <div class="form-floating mb-3">
                            <input type="email" name="username" class="form-control" id="email" placeholder="Email">
                            <label for="email"><i class="ri-mail-line me-2"></i>Email Address</label>
                            <?php if (isset($_SESSION['username-error']) && !empty($_SESSION['username-error'])) { ?>
                                <div class="alert alert-danger my-1"> <?php echo $_SESSION['username-error'];
                                                                        unset($_SESSION['username-error']) ?> </div>
                            <?php } ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                            <label for="password"><i class="ri-smartphone-line me-2"></i>Password</label>
                            <?php if (isset($_SESSION['password-error']) && !empty($_SESSION['password-error'])) { ?>
                                <div class="alert alert-danger my-1"> <?php echo $_SESSION['password-error'];
                                                                        unset($_SESSION['password-error']) ?> </div>
                            <?php } ?>
                        </div>


                        <button type="submit" class="btn btn-primary btn-interactive w-100 rounded-pill">
                            REGISTER <i class="ri-arrow-right-line ms-2"></i>
                        </button>
                    </form>
                </div>

                <div class="text-center mt-4">
                    <a href="index.php" class="btn btn-link text-secondary text-decoration-none small">
                        <i class="ri-dashboard-line me-1"></i></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>