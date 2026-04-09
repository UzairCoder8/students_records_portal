<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Data Collect Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body>
    <header class="container">
        <?php
        require "./navbar.php";
        ?>
    </header>
    <div class="container">
        <h1 class="text-success text-center mt-5 mb-3">Welcome To Form Insert Your Data Here</h1>
        <form method="post" action="./fetch.php">
            <div class="mb-3 w-50 m-auto">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <?php if(isset($_SESSION['name_error'] ) && !empty($_SESSION['name_error'] )) { ?>
                    <div class="alert alert-danger"> <?php echo $_SESSION['name_error']; unset($_SESSION['name_error']) ?> </div>
                <?php } ?>
            </div>
            <div class="mb-3 w-50 m-auto">
                <label for="exampleInputPassword1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputPassword1">
                <?php if(isset($_SESSION['name_error'] ) && !empty($_SESSION['name_error'] )) { ?>
                    <div class="alert alert-danger"> <?php echo $_SESSION['name_error']; unset($_SESSION['name_error']) ?> </div>
                <?php } ?>
            </div>
            <div class="mb-3 w-50 m-auto">
                <label for="exampleInputPassword1" class="form-label">Phone</label>
                <input type="number" name="number" class="form-control">
            </div>
            <?php if(isset($_SESSION['name_error'] ) && !empty($_SESSION['name_error'] )) { ?>
                    <div class="alert alert-danger"> <?php echo $_SESSION['name_error']; unset($_SESSION['name_error']) ?> </div>
                <?php } ?>
            <div class="mb-3 w-50 m-auto">
                <select class="form-select" name="gender">
                    <option selected>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="submit-btn text-center"><button type="submit" class="btn btn-primary">Add Record</button></div>
        </form>
    </div>

</body>

</html>