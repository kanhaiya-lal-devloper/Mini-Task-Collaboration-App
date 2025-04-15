<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body class=" bg-light">

    <?php
    session_start();
    require_once 'includes/db.php';

    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY id DESC");
    $stmt->execute([$user_id]);
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-7  mx-auto mt-5">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Add Task</h3>
                        <a href="code/logout.php" class="btn btn-sm fw-bold btn-primary">Logout</a>
                    </div>
                    <div class="card-body">

                        <div id="responseMessage"></div>
                        <form id="taskForm" method="post" class="card p-3 mb-4">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deadline</label>
                                <input type="date" name="deadline" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Priority</label>
                                <select name="priority" class="form-select" required>
                                    <option value="High">High</option>
                                    <option value="Medium" selected>Medium</option>
                                    <option value="Low">Low</option>
                                </select>
                            </div>

                            <button type="submit" name="add_task" class="btn btn-primary">Add Task</button>
                        </form>




                        <script>
                            document.getElementById('taskForm').addEventListener('submit', function(e) {
                                e.preventDefault();


                                var formData = new FormData(this);


                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', 'code/add-task.php', true);


                                xhr.onload = function() {
                                    if (xhr.status == 200) {
                                        var response = xhr.responseText;

                                        document.getElementById('responseMessage').innerHTML = response;

                                        document.getElementById('taskForm').reset();
                                    } else {
                                        document.getElementById('responseMessage').innerHTML = 'Something went wrong.';
                                    }
                                };
                                xhr.send(formData);
                            });
                        </script>

                    </div>
                </div>
            </div>

            <div class="col-sm-11 mx-auto my-5">

                <div class="card p-3 mt-5 shadow">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Your Task List</h5>
                        <?php
                        require_once 'includes/db.php';


                        $user_id = $_SESSION['user_id'];
                        $today = date('Y-m-d');


                        $stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = ? AND deadline <= ? AND status != 'completed'");
                        $stmt->execute([$user_id, $today]);
                        $due_tasks = $stmt->fetchAll();
                        ?>



                        <?php if (count($due_tasks) > 0): ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                                <strong>⏰ Reminder:</strong> You have <?= count($due_tasks) ?> task(s) with deadlines today or earlier:
                                <ul class="mb-0 mt-2">
                                    <?php foreach ($due_tasks as $task): ?>
                                        <li><strong><?= htmlspecialchars($task['title']) ?></strong> (Due: <?= $task['deadline'] ?>)</li>
                                    <?php endforeach; ?>
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Deadline</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tbody>

                                <?php if ($tasks): ?>
                                    <?php foreach ($tasks as $task): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($task['title']) ?></td>
                                            <td><?= htmlspecialchars($task['deadline']) ?></td>
                                            <td><?= htmlspecialchars($task['priority']) ?></td>
                                            <td><?= htmlspecialchars($task['status']) ?></td>
                                            
                                            <td>
                                                <button class="btn btn-sm btn-warning edit-task-btn"
                                                    data-id="<?= $task['id'] ?>"
                                                    data-title="<?= htmlspecialchars($task['title']) ?>"
                                                    data-deadline="<?= $task['deadline'] ?>"
                                                    data-priority="<?= $task['priority'] ?>">
                                                    Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger delete-task" data-id="<?= $task['id'] ?>">Delete</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No tasks found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>


                            <!-- delete task -->

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    document.addEventListener('click', function(e) {
                                        if (e.target.classList.contains('delete-task')) {
                                            const taskId = e.target.getAttribute('data-id');

                                            if (confirm("Are you sure you want to delete this task?")) {
                                                fetch('code/delete_task.php', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/x-www-form-urlencoded'
                                                        },
                                                        body: 'id=' + taskId
                                                    })
                                                    .then(res => res.text())
                                                    .then(data => {
                                                        if (data === 'success') {

                                                            location.reload();
                                                        } else {
                                                            alert("Delete failed!");
                                                        }
                                                    });
                                            }
                                        }
                                    });
                                });
                            </script>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- update task -->
    <div class="modal fade" id="editTaskModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="editTaskForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="editTaskId">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" id="editTaskTitle" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deadline</label>
                        <input type="date" name="deadline" id="editTaskDeadline" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Priority</label>
                        <select name="priority" id="editTaskPriority" class="form-select">
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Task</button>
                </div>
            </form>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editModal = new bootstrap.Modal(document.getElementById('editTaskModal'));
                const form = document.getElementById('editTaskForm');


                document.addEventListener('click', function(e) {
                    if (e.target.classList.contains('edit-task-btn')) {
                        document.getElementById('editTaskId').value = e.target.dataset.id;
                        document.getElementById('editTaskTitle').value = e.target.dataset.title;
                        document.getElementById('editTaskDeadline').value = e.target.dataset.deadline;
                        document.getElementById('editTaskPriority').value = e.target.dataset.priority;

                        editModal.show();
                    }
                });


                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(form);
                    fetch('code/edit_task.php', {
                            method: 'POST',
                            body: new URLSearchParams(formData)
                        })
                        .then(res => res.text())
                        .then(data => {
                            if (data === 'success') {
                                editModal.hide();
                                location.reload();
                            } else {
                                alert("Update failed.");
                            }
                        });
                });
            });
        </script>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>