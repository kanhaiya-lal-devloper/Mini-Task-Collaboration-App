<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body class=" bg-light">

    <div class="container">
        <div class="row">
            <div class="col-sm-5  mx-auto" style="margin: 10% auto;">
                <div class="card shadow">
                    <div class="card-header">
                        <h2 class="text-center">Login</h2>

                        <?php
                        
                        if (isset($_REQUEST['msg'])) {
                            $msg = $_REQUEST['msg'];
                        
                            if ($msg == 1) {
                                $message2 = "Both Are Field Required !";
                            }
                            if ($msg == 2) {
                                $message2 = "invalid login";
                            }
                            if ($msg == 3) {
                                $message2 = "Logout";
                            }
                        }
                        

                        if (isset($message2)) {
                        ?>
                            <div class="d-flex justify-content-center">
                                <div class="alert alert-danger alert-dismissible fade show p-0 pe-5 ps-1 py-2" role="alert" style="max-width: 400px;">
                                    <strong>Hello </strong> <span class="fw-bold"><?php echo $message2 ?></span>
                                    <button type="button" class="btn-close p-0 pt-4 pe-4 shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="card-body">
                        <form id="loginForm" action="code/loginCode.php" method="post" onsubmit="return validateLoginForm()">
                            <div class="mb-3">
                                <label class="fw-semibold">Enter User ID</label>
                                <input type="text" name="userid" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="fw-semibold">Enter Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="mb-3 d-flex justify-content-around">
                                <input type="submit" name="login" class="btn btn-sm btn-primary fw-bold" value="Login">
                                <a href="register.php" class="text-decoration-none fw-bold">Register Here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

    <!-- <script>
        function validateLoginForm() {
            const userid = document.forms["loginForm"]["userid"].value.trim();
            const password = document.forms["loginForm"]["password"].value.trim();

            if (userid === "" || password === "") {
                alert("Please enter both User ID and Password.");
                return false;
            }

            if (password.length < 6) {
                alert("Password must be at least 6 characters.");
                return false;
            }

            return true;
        }
    </script> -->
</body>

</html>