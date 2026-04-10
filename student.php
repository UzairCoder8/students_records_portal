<?php
// session_start();

// if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
//     $_SESSION['auth_error'] = "Please login to add new student";
//     header("Location: login-form.php");
//     exit;
// }
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New Student | Student Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #0f111a 0%, #0a0c12 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        /* Modern Card Design */
        .glass-card {
            background: rgba(26, 29, 39, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(13, 202, 240, 0.1);
            border-radius: 28px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            transition: all 0.4s ease;
        }

        .glass-card:hover {
            border-color: rgba(13, 202, 240, 0.3);
            box-shadow: 0 30px 60px -12px rgba(13, 202, 240, 0.15);
            transform: translateY(-3px);
        }

        /* Header Gradient */
        .form-header {
            background: linear-gradient(135deg, #0dcaf0 0%, #0b5ed7 100%);
            border-radius: 28px 28px 0 0;
            padding: 2rem;
            text-align: center;
            margin: -1px -1px 0 -1px;
        }

        /* Circular Icon */
        .icon-circle {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .icon-circle i {
            font-size: 2.5rem;
            color: white;
        }

        .glass-card:hover .icon-circle {
            transform: scale(1.05);
            background: rgba(255, 255, 255, 0.25);
        }

        /* Form Fields Styling */
        .form-floating>.form-control {
            background-color: #13151f;
            border: 1.5px solid #2d323e;
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .form-floating>.form-control:focus {
            border-color: #0dcaf0;
            box-shadow: 0 0 0 4px rgba(13, 202, 240, 0.1);
            background-color: #13151f;
        }

        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label {
            color: #0dcaf0 !important;
        }

        .form-floating>label {
            color: #8b92a8;
            font-weight: 500;
            padding-left: 1rem;
        }

        /* Gender Field - Modern Radio Button Design */
        .gender-container {
            margin-bottom: 1.5rem;
        }

        .gender-label-title {
            display: block;
            margin-bottom: 0.75rem;
            color: #8b92a8;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .gender-label-title i {
            margin-right: 0.5rem;
            color: #0dcaf0;
        }

        .gender-options {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .gender-option {
            flex: 1;
            min-width: 120px;
        }

        .gender-option input {
            display: none;
        }

        .gender-option label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 0.85rem 1rem;
            background-color: #13151f;
            border: 1.5px solid #2d323e;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #e9ecef;
        }

        .gender-option label i {
            font-size: 1.3rem;
            transition: all 0.3s ease;
        }

        .gender-option input:checked + label {
            border-color: #0dcaf0;
            background: linear-gradient(135deg, rgba(13, 202, 240, 0.15), rgba(11, 94, 215, 0.1));
            color: #0dcaf0;
        }

        .gender-option input:checked + label i {
            color: #0dcaf0;
            transform: scale(1.1);
        }

        .gender-option label:hover {
            border-color: #0dcaf0;
            background: rgba(13, 202, 240, 0.05);
            transform: translateY(-2px);
        }

        /* Animated Submit Button */
        .btn-submit {
            background: linear-gradient(135deg, #0dcaf0 0%, #0b5ed7 100%);
            border: none;
            padding: 14px 32px;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border-radius: 40px;
            font-size: 1rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(13, 202, 240, 0.4);
            filter: brightness(1.05);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Alert Styling */
        .alert-custom {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.15), rgba(220, 53, 69, 0.08));
            border: 1px solid rgba(220, 53, 69, 0.3);
            border-radius: 14px;
            color: #ff8a8a;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            padding: 0.75rem 1rem;
            backdrop-filter: blur(4px);
        }

        /* Navbar integration */
        header {
            margin-bottom: 2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .glass-card {
                margin: 0 1rem;
            }
            
            .form-header {
                padding: 1.5rem;
            }
            
            .form-header h2 {
                font-size: 1.5rem;
            }

            .icon-circle {
                width: 60px;
                height: 60px;
            }

            .icon-circle i {
                font-size: 2rem;
            }

            .gender-options {
                flex-direction: column;
                gap: 0.75rem;
            }

            .gender-option label {
                justify-content: center;
            }
        }

        /* Animation */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-custom {
            animation: slideIn 0.3s ease;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #1a1d27;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #0dcaf0;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #0b5ed7;
        }

        /* Remove number input arrows */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            opacity: 0.5;
        }
    </style>
</head>

<body>
    <header>
        <?php require "./navbar.php"; ?>
    </header>

    <main class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-12">
                
                <!-- Modern Glass Card -->
                <div class="glass-card">
                    <div class="form-header">
                        <div class="icon-circle">
                            <i class="ri-user-add-line"></i>
                        </div>
                        <h2 class="text-white mb-1 fw-bold">Add New Student</h2>
                        <p class="text-white-50 mb-0">Fill in the student details below</p>
                    </div>
                    
                    <div class="p-4 p-md-5">
                        <form method="post" action="./fetch.php">
                            
                            <!-- Name Field -->
                            <div class="form-floating mb-4">
                                <input type="text" 
                                       name="name" 
                                       class="form-control" 
                                       id="nameInput" 
                                       placeholder="Full Name"
                                       value="<?php echo isset($_SESSION['old_name']) ? htmlspecialchars($_SESSION['old_name']) : ''; ?>">
                                <label for="nameInput">
                                    <i class="ri-user-3-line me-2"></i>Full Name
                                </label>
                                <?php if(isset($_SESSION['name_error']) && !empty($_SESSION['name_error'])) { ?>
                                    <div class="alert-custom">
                                        <i class="ri-error-warning-line me-2"></i>
                                        <?php echo htmlspecialchars($_SESSION['name_error']); 
                                        unset($_SESSION['name_error']); 
                                        unset($_SESSION['old_name']); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            
                            <!-- Email Field -->
                            <div class="form-floating mb-4">
                                <input type="email" 
                                       name="email" 
                                       class="form-control" 
                                       id="emailInput" 
                                       placeholder="Email Address"
                                       value="<?php echo isset($_SESSION['old_email']) ? htmlspecialchars($_SESSION['old_email']) : ''; ?>">
                                <label for="emailInput">
                                    <i class="ri-mail-line me-2"></i>Email Address
                                </label>
                                <?php if(isset($_SESSION['email_error']) && !empty($_SESSION['email_error'])) { ?>
                                    <div class="alert-custom">
                                        <i class="ri-error-warning-line me-2"></i>
                                        <?php echo htmlspecialchars($_SESSION['email_error']); 
                                        unset($_SESSION['email_error']);
                                        unset($_SESSION['old_email']); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            
                            <!-- Phone Field -->
                            <div class="form-floating mb-4">
                                <input type="number" 
                                       name="number" 
                                       class="form-control" 
                                       id="phoneInput" 
                                       placeholder="Phone Number"
                                       value="<?php echo isset($_SESSION['old_number']) ? htmlspecialchars($_SESSION['old_number']) : ''; ?>">
                                <label for="phoneInput">
                                    <i class="ri-smartphone-line me-2"></i>Phone Number
                                </label>
                                <?php if(isset($_SESSION['phone_error']) && !empty($_SESSION['phone_error'])) { ?>
                                    <div class="alert-custom">
                                        <i class="ri-error-warning-line me-2"></i>
                                        <?php echo htmlspecialchars($_SESSION['phone_error']); 
                                        unset($_SESSION['phone_error']);
                                        unset($_SESSION['old_number']); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            
                            <!-- Gender Field - Modern Radio Toggle Design -->
                            <div class="gender-container">
                                <label class="gender-label-title">
                                    <i class="ri-genderless-line"></i>Select Gender
                                </label>
                                <div class="gender-options">
                                    <div class="gender-option">
                                        <input type="radio" name="gender" id="genderMale" value="Male" 
                                            <?php echo (isset($_SESSION['old_gender']) && $_SESSION['old_gender'] == 'Male') ? 'checked' : ''; ?>>
                                        <label for="genderMale">
                                            <i class="ri-men-line"></i>
                                            <span>Male</span>
                                        </label>
                                    </div>
                                    <div class="gender-option">
                                        <input type="radio" name="gender" id="genderFemale" value="Female" 
                                            <?php echo (isset($_SESSION['old_gender']) && $_SESSION['old_gender'] == 'Female') ? 'checked' : ''; ?>>
                                        <label for="genderFemale">
                                            <i class="ri-women-line"></i>
                                            <span>Female</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php if(isset($_SESSION['gender_error']) && !empty($_SESSION['gender_error'])) { ?>
                                <div class="alert-custom mb-4">
                                    <i class="ri-error-warning-line me-2"></i>
                                    <?php echo htmlspecialchars($_SESSION['gender_error']); 
                                    unset($_SESSION['gender_error']); ?>
                                </div>
                            <?php } ?>
                            
                            <!-- Submit Button -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-submit text-white px-5">
                                    <i class="ri-save-line me-2"></i>Add Record
                                    <i class="ri-arrow-right-line ms-2"></i>
                                </button>
                            </div>
                            
                            <!-- Additional Info -->
                            <div class="text-center mt-4">
                                <small class="text-secondary">
                                    <i class="ri-information-line me-1"></i>
                                    All fields are required. Make sure to fill them correctly.
                                </small>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Navigation Links -->
                <div class="text-center mt-4">
                    <a href="./index.php" class="btn btn-link text-secondary text-decoration-none">
                        <i class="ri-dashboard-line me-1"></i> Dashboard
                    </a>
                    <span class="text-secondary mx-2">•</span>
                    <a href="./index.php" class="btn btn-link text-secondary text-decoration-none">
                        <i class="ri-group-line me-1"></i> View All Students
                    </a>
                    <span class="text-secondary mx-2">•</span>
                    <a href="./logout.php" class="btn btn-link text-secondary text-decoration-none">
                        <i class="ri-logout-box-line me-1"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>