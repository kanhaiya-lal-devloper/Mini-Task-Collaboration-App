<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body class=" bg-light">

  <div class="container-fluid ">
    <div class="row">
      <div class="col-sm-12 p-0">
        <nav class="navbar navbar-expand-lg bg-primary ">
          <div class="container-fluid">
            <a class="navbar-brand fw-bold text-light text-uppercase" href="dashboard.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active fw-bold text-uppercase text-light" aria-current="page" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle  fw-bold text-uppercase text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php
                    session_start();
                    echo $_SESSION['name'];
                    ?>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item fw-bold text-uppercase " href="../code/logout.php">Logout</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link fw-bold text-uppercase text-light" href="dashboard.php">Users</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link fw-bold text-uppercase text-light" href="alltask.php">Task</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-sm-12 mt-5">
        <div class="card shodow">
          <div class="card-header">
            <h3>All Users</h3>
          </div>

          <div class="card-body">
            <div class="table-table-responsive">
              <table class="table  table-bordered text-center">
                <?php
                require_once '../includes/db.php';


                $stmt = $conn->query("SELECT * FROM users");
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <thead class="table-dark">
                  <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>View Task</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  $i = 1;
                  foreach ($users as $user):
                  ?>
                    <tr>
                      <td><?= $i++ ?></td>
                      <td><?= htmlspecialchars($user['name']) ?></td>
                      <td><?= htmlspecialchars($user['email']) ?></td>
                      <td><?= $user['role'] == 1 ? 'Admin' : 'User' ?></td>
                      <td>
                        <a href="idTask.php?user_id=<?= $user['id'] ?>" class="btn btn-sm btn-primary">View</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>  
                </tbody>


              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>