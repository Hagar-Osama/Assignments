<?php session_start();
include_once 'header.php';

$connection = mysqli_connect('localhost', 'root', '', 'course');
if (!$connection) {
    die('connection with database failed: ' . mysqli_connect_error());
}
$sql_statment = 'select id, firstname, lastname, email, type from users';
$result = mysqli_query($connection, $sql_statment);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
//var_dump($data);




?>


<!-- Start Main -->
<main role="main">
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <?php if (!empty($_SESSION['error'])) : ?>
                            <div class='alert alert-danger'>
                                <span><?= $_SESSION['error']; ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($_SESSION['success'])) : ?>
                            <div class='alert alert-success'>
                                <span><?= $_SESSION['success']; ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">FirstName</th>
                                        <th scope="col">LastName</th>
                                        <th scope="col">Email</th>
                                        <th>Type</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $user) : ?>
                                        <tr>

                                            <td><?= $user['id']; ?></td>
                                            <td><?= $user['firstname']; ?></td>
                                            <td><?= $user['lastname']; ?></td>
                                            <td><?= $user['email']; ?></td>
                                            <td><?= $user['type']; ?></td>
                                            <td><a href="edit.php?id=<?= $user['id']; ?>" class="btn btn-primary">Edit</a></td>
                                            <td><a href="delete.php?id=<?= $user['id']; ?>" class="btn btn-danger">Delete</a></td>
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
</main>
<!-- End Main -->
<?php session_unset(); ?>
<?php include 'footer.php'; ?>