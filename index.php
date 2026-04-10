<?php
session_start();

if ( !isset($_SESSION['is-login']) || $_SESSION['is-login'] !== true) {
    $_SESSION['auth-error'] = "Please login to access dashboard";
    header("Location: login-form.php");
    exit;
}

?>
<?php
include "./connection.php";
$qry = "SELECT * FROM studdata";
$res = mysqli_query($con, $qry);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Record Managment Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet" />
</head>
<body class="text-bg-secondary">

    <div class="header container">
        <?php require "./navbar.php"; ?>
    </div>

    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="ri-graduation-cap-line me-2"></i>Student Records</h5>
                <span class="badge bg-white text-primary">
                    <?php echo mysqli_num_rows($res); ?> Students
                </span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"><i class="ri-user-line me-1"></i>Name</th>
                                <th scope="col"><i class="ri-mail-line me-1"></i>Email</th>
                                <th scope="col"><i class="ri-phone-line me-1"></i>Phone</th>
                                <th scope="col"><i class="ri-gender-line me-1"></i>Gender</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($i = mysqli_fetch_assoc($res)) { ?>
                                <tr>
                                    <th scope="row">
                                        <span class="badge bg-secondary"><?php echo $i['id']; ?></span>
                                    </th>
                                    <td class="fw-semibold"><?php echo htmlspecialchars($i['name']); ?></td>
                                    <td class="text-muted"><?php echo htmlspecialchars($i['email']); ?></td>
                                    <td><?php echo htmlspecialchars($i['phone']); ?></td>
                                    <td>
                                        <?php
                                        $gender = strtolower($i['gender']);
                                        $badgeClass = $gender === 'male' ? 'bg-info' : ($gender === 'female' ? 'bg-pink text-dark' : 'bg-secondary');
                                        $icon = $gender === 'male' ? 'ri-men-line' : ($gender === 'female' ? 'ri-women-line' : 'ri-user-line');
                                        ?>
                                        <span class="badge <?php echo $badgeClass; ?>">
                                            <i class="<?php echo $icon; ?> me-1"></i><?php echo htmlspecialchars($i['gender']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-outline-danger me-1" href="./delete.php?id=<?php echo $i['id']; ?>" title="Delete">
                                            <i class="ri-delete-bin-6-line"></i>
                                        </a>
                                        <a class="btn btn-sm btn-outline-warning" href="./update-form.php?id=<?php echo $i['id']; ?>" title="Edit">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-muted text-end small">
                Student Management System
            </div>
        </div>
    </div>

</body>
</html>