<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3 d-flex align-items-center gap-2" href="./index.php">
            <i class="ri-graduation-cap-fill fs-3"></i>
            EduCollect
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1" href="./index.php">
                        <i class="ri-user-add-line"></i>Home</a>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1" href="./students.php">
                        <i class="ri-file-list-3-line"></i>Students</a>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1" href="./add.php">
                        <i class="ri-user-add-line"></i>Add</a>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1" href="./register-form.php">
                        <i class="ri-registered-line"></i>Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-center gap-1" href="./login-form.php">
                        <i class="ri-user-2-fill"></i>Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-center gap-1" href="./logout.php">
                        <i class="ri-user-2-fill"></i>Logout</a>
                </li>
            </ul>
            <form class="d-flex gap-2" role="search">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="ri-search-line text-muted"></i>
                    </span>
                    <input class="form-control border-start-0 ps-0" type="search" placeholder="Search students..." aria-label="Search" />
                </div>
                <button class="btn btn-light fw-semibold px-3" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>