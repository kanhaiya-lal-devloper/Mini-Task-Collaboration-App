<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body class=" bg-light">

    <div class="container">
        <div class="row">
            <div class="col-sm-5  mx-auto" style="margin: 10% auto;">
                <div class="card shadow">
                    <div class="card-header">
                        <h2 class="text-center">Register</h2>

                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $e): ?>
                                        <li><?= htmlspecialchars($e) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <form id="registerForm" action="code/registerCode.php" method="post" onsubmit="return validateForm()">
                            <div class="mb-3">
                                <label class="fw-semibold">Enter Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="fw-semibold">Enter Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="fw-semibold">Enter Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <!-- <div class="mb-3">
                                <label class="fw-semibold">Select User Type</label>
                                <select name="type" class="form-select">
                                    <option value="">-- Select --</option>
                                    <option value="1">Admin</option>
                                    <option value="0">User</option>
                                </select>
                            </div> -->

                            <div class="mb-3 d-flex justify-content-around">
                                <input type="submit" name="login" class="btn btn-sm btn-primary fw-bold" value="Register">
                                <a href="index.php" class="text-decoration-none fw-bold">Login Here</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>


    <script>
        function validateForm() {
            let name = document.forms["registerForm"]["name"].value.trim();
            let email = document.forms["registerForm"]["email"].value.trim();
            let password = document.forms["registerForm"]["password"].value.trim();
            let type = document.forms["registerForm"]["type"].value;

            if (name === "" || email === "" || password === "" || type === "") {
                alert("Please fill all the fields.");
                return false;
            }

            // Email Format Check
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Password Length Check
            if (password.length < 6) {
                alert("Password must be at least 6 characters.");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>