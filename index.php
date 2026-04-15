<?php
session_start();

if ( !isset($_SESSION['is-login']) || $_SESSION['is-login'] !== true) {
    $_SESSION['auth-error'] = "Please login to access dashboard";
    header("Location: login-form.php");
    exit;
}

include "./connection.php";

// --- SIMPLE QUERIES FOR DASHBOARD STATS (BEGINNER FRIENDLY) ---

// 1. Get total students
$result_total = mysqli_query($con, "SELECT * FROM studdata");
$total_students = mysqli_num_rows($result_total);

// 2. Get male students count
$result_male = mysqli_query($con, "SELECT * FROM studdata WHERE gender = 'male'");
$total_students_m = mysqli_num_rows($result_male);

// 3. Get female students count
$result_female = mysqli_query($con, "SELECT * FROM studdata WHERE gender = 'female'");
$total_students_f = mysqli_num_rows($result_female);

// 4. Get users count
$result_users = mysqli_query($con, "SELECT * FROM users");
if ($result_users) {
    $total_users = mysqli_num_rows($result_users);
} else {
    $total_users = 0;
}

// 5. Get all students for table display - ORDER BY id ASC (oldest first, newest at bottom)
$result_all_students = mysqli_query($con, "SELECT * FROM studdata ORDER BY id ASC");

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Records</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet">
    
    <!-- Bootstrap Icons (for cards) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        /* DARK THEME STYLES */
        :root {
            --bg-dark: #0f0f1a;
            --bg-card: #1a1a2e;
            --bg-table: #16213e;
            --text-primary: #eef2ff;
            --text-secondary: #a5b4fc;
            --border-color: #2d2d44;
            --hover-bg: #1e2a3e;
            --gradient-1: #4f46e5;
            --gradient-2: #7c3aed;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }
        
        body {
            background: var(--bg-dark);
            color: var(--text-primary);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--bg-dark);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--gradient-1);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--gradient-2);
        }
        
        /* Dashboard Card Style */
        .stat-card {
            background: var(--bg-card);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--gradient-1), var(--gradient-2));
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(79, 70, 229, 0.2);
            border-color: var(--gradient-1);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover .stat-icon {
            transform: scale(1.1);
        }
        
        .stat-number {
            font-size: 36px;
            font-weight: bold;
            margin: 0;
            background: linear-gradient(135deg, var(--text-primary), var(--text-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .stat-label {
            color: var(--text-secondary);
            margin: 0;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        
        .bg-blue-light {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }
        
        .bg-green-light {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }
        
        .bg-purple-light {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
        }
        
        .bg-dark-light {
            background: linear-gradient(135deg, #6b7280, #4b5563);
            color: white;
        }
        
        /* Welcome Banner */
        .welcome-banner {
            background: linear-gradient(135deg, var(--bg-card), var(--bg-table));
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }
        
        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(79,70,229,0.1), transparent);
            border-radius: 50%;
        }
        
        .year-badge {
            background: rgba(79, 70, 229, 0.2);
            border: 1px solid var(--gradient-1);
            border-radius: 30px;
            padding: 8px 18px;
            backdrop-filter: blur(10px);
        }
        
        /* Table Styles */
        .table-container {
            background: var(--bg-card);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }
        
        .table-header {
            background: linear-gradient(135deg, var(--bg-table), var(--bg-dark));
            padding: 18px 20px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .table {
            color: var(--text-primary);
            margin-bottom: 0;
        }
        
        .table thead th {
            background: var(--bg-table);
            color: var(--text-secondary);
            border-bottom: 2px solid var(--border-color);
            padding: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .table tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }
        
        .table tbody tr:hover {
            background: var(--hover-bg);
            transform: scale(1.01);
        }
        
        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
        }
        
        .gender-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }
        
        .gender-male {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }
        
        .gender-female {
            background: linear-gradient(135deg, #ec4899, #db2777);
            color: white;
        }
        
        /* Button Styles */
        .btn-action {
            padding: 6px 14px;
            margin: 0 4px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-action:hover {
            transform: translateY(-2px);
            filter: brightness(110%);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }
        
        .btn-danger:hover, .btn-warning:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        
        /* Empty State */
        .empty-state {
            padding: 60px 20px;
            text-align: center;
        }
        
        .empty-state i {
            font-size: 64px;
            color: var(--text-secondary);
            margin-bottom: 20px;
            opacity: 0.5;
        }
        
        /* Footer */
        .table-footer {
            background: var(--bg-table);
            padding: 12px 20px;
            border-top: 1px solid var(--border-color);
            color: var(--text-secondary);
            font-size: 13px;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .stat-card, .welcome-banner, .table-container {
            animation: fadeInUp 0.6s ease-out;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .stat-number {
                font-size: 28px;
            }
            
            .stat-icon {
                width: 50px;
                height: 50px;
                font-size: 24px;
            }
            
            .btn-action {
                padding: 4px 10px;
                font-size: 11px;
            }
            
            .table thead th, .table tbody td {
                padding: 10px;
                font-size: 13px;
            }
        }
        
        /* Navbar dark theme override */
        .navbar {
            background: var(--bg-card) !important;
            border-bottom: 1px solid var(--border-color);
        }
        
        .navbar-brand, .nav-link {
            color: var(--text-primary) !important;
        }
        
        .nav-link:hover {
            color: var(--gradient-1) !important;
        }
        
        /* Alert customization */
        .alert {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="container">
        <?php require "./navbar.php"; ?>
    </div>

    <!-- Main Content -->
    <div class="container mt-4 mb-5">
        
        <!-- Welcome Message -->
        <div class="welcome-banner">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h3 class="mb-2">
                        <i class="ri-dashboard-line me-2" style="color: var(--gradient-1);"></i>
                        Ticer Students Dashboard
                    </h3>
                    <p class="mb-0 text-secondary">Welcome back! Here's what's happening with your students today.</p>
                </div>
                <div class="year-badge">
                    <i class="ri-calendar-line me-1"></i>
                    <span>2026 Academic Year</span>
                </div>
            </div>
        </div>
        
        <!-- Statistics Cards Row -->
        <div class="row mb-4">
            <!-- Card 1: Total Students -->
            <div class="col-md-3 col-sm-6">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div class="stat-icon bg-blue-light">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <p class="stat-number"><?php echo $total_students; ?></p>
                        <p class="stat-label">Total Students</p>
                    </div>
                </div>
            </div>
            
            <!-- Card 2: Male Students -->
            <div class="col-md-3 col-sm-6">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div class="stat-icon bg-green-light">
                        <i class="bi bi-gender-male"></i>
                    </div>
                    <div>
                        <p class="stat-number"><?php echo $total_students_m; ?></p>
                        <p class="stat-label">Male Students</p>
                    </div>
                </div>
            </div>
            
            <!-- Card 3: Female Students -->
            <div class="col-md-3 col-sm-6">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div class="stat-icon bg-purple-light">
                        <i class="bi bi-gender-female"></i>
                    </div>
                    <div>
                        <p class="stat-number"><?php echo $total_students_f; ?></p>
                        <p class="stat-label">Female Students</p>
                    </div>
                </div>
            </div>
            
            <!-- Card 4: Users -->
            <div class="col-md-3 col-sm-6">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div class="stat-icon bg-dark-light">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div>
                        <p class="stat-number"><?php echo $total_users; ?></p>
                        <p class="stat-label">System Users</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Student Records Table -->
        <div class="table-container">
            <div class="table-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5 class="mb-0">
                    <i class="ri-graduation-cap-line me-2"></i>
                    Student Records
                </h5>
                <span class="badge" style="background: var(--gradient-1); padding: 8px 16px;">
                    <i class="ri-database-2-line me-1"></i> 
                    <?php echo $total_students; ?> Total Records
                </span>
            </div>
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><i class="ri-user-line me-1"></i> Name</th>
                            <th><i class="ri-mail-line me-1"></i> Email</th>
                            <th><i class="ri-phone-line me-1"></i> Phone</th>
                            <th><i class="ri-gender-line me-1"></i> Gender</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sr_no = 1;
                        if(mysqli_num_rows($result_all_students) > 0) {
                            while($student = mysqli_fetch_assoc($result_all_students)) {
                                $gender_class = ($student['gender'] == 'male') ? 'gender-male' : 'gender-female';
                                $gender_icon = ($student['gender'] == 'male') ? 'ri-men-line' : 'ri-women-line';
                        ?>
                            <tr>
                                <td class="fw-bold"><?php echo $sr_no++; ?></td>
                                <td class="fw-semibold">
                                    <i class="ri-user-3-line me-2 text-secondary"></i>
                                    <?php echo htmlspecialchars($student['name']); ?>
                                </td>
                                <td>
                                    <i class="ri-mail-line me-1 text-secondary"></i>
                                    <?php echo htmlspecialchars($student['email']); ?>
                                </td>
                                <td>
                                    <i class="ri-phone-line me-1 text-secondary"></i>
                                    <?php echo htmlspecialchars($student['phone']); ?>
                                </td>
                                <td>
                                    <span class="gender-badge <?php echo $gender_class; ?>">
                                        <i class="<?php echo $gender_icon; ?> me-1"></i>
                                        <?php echo ucfirst($student['gender']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php 
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="6" class="empty-state">
                                    <i class="ri-inbox-line"></i>
                                    <h5 class="mt-3">No Students Found</h5>
                                    <p class="text-secondary mb-0">Click on "Add Student" in the navbar to get started.</p>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            
            <div class="table-footer d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <i class="ri-information-line me-1"></i>
                    Showing <strong><?php echo $total_students; ?></strong> student record(s)
                </div>
                <div>
                    <i class="ri-time-line me-1"></i>
                    Last updated: <?php echo date('F j, Y, g:i a'); ?>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Bootstrap JS (kept as requested) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Optional: Add a simple console log for fun -->
    <script>
        console.log("%c✨ Ticer Dashboard Loaded Successfully! ✨", "color: #4f46e5; font-size: 16px; font-weight: bold;");
        console.log("%cDashboard Statistics: Total Students = <?php echo $total_students; ?>, Male = <?php echo $total_students_m; ?>, Female = <?php echo $total_students_f; ?>", "color: #10b981; font-size: 12px;");
    </script>
    
</body>
</html>