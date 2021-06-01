<?php session_start();
include_once  'header.php';
if (isset($_GET['id']) && ! empty($_GET['id'])) {
    $connection = mysqli_connect('localhost', 'root', '', 'course');
    if (! $connection) {
        die('connection has failed: ' . mysqli_connect_error());

        }
    $mysql_statement = 'select id from users where id = ' . $_GET['id'];
    $result = mysqli_query($connection, $mysql_statement);
    $data = mysqli_fetch_assoc($result);
    if (count($data) > 0) {
      //write sql statement to get all user data
      $sql = 'select * from users where id = ' . $_GET['id'];
      $result = mysqli_query($connection, $sql);
      $data = mysqli_fetch_assoc($result);
    }else {
        $_SESSION ['error'] = 'user not found';
        header ('location: users.php');
    }
    

}

?>
    <main role="main">
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <?php if (! empty($_SESSION['success'])) : ?>
                        <div class = 'alert alert-success'>
                        <span><?= $_SESSION['success'];?></span>
                        </div>
                        <?php endif; ?>
                            <div class="card-body">
                                <form action="update.php?id=<?= ! empty($_GET['id']) ? $_GET['id'] : '' ?>" method="post">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">First Name:</label>
                                        <input type="text" class="form-control" name="firstname" value = <?= ! empty($data['firstname']) ? $data['firstname'] : '' ;?>>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">last Name:</label>
                                        <input type="text" class="form-control" name="lastname" value = <?= ! empty($data['lastname']) ? $data['lastname'] : '' ;?> >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address:</label>
                                        <input type="text" class="form-control" name="email"value = <?= ! empty($data['email']) ? $data['email'] : '' ;?> >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password:</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">User Type :</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="type">
                                            <option value="" disabled> Select Value</option>
                                            <option value="admin" <?= ! empty($data['type']) && $data['type'] == 'admin' ? 'selected' : '' ;?> >Admin</option>
                                            <option value="super_admin" <?= ! empty($data['type']) && $data['type'] == 'super_admin' ? 'selected' : '' ;?> >super_admin</option>
                                            <option value="user"<?= ! empty($data['type']) && $data['type'] == 'user' ? 'selected' : '' ;?> >user</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="update" value='update'>Update</button>
                                </form>
                                <?php if (! empty($_SESSION['errors'])) : ?>
                            <div class = 'alert alert-danger'>
                            <ul>
                            <?php foreach ($_SESSION['errors'] as $error) : ?>
                            <li> <?= $error; ?></li>
                            <?php endforeach;?>
                            </ul>
                    
                            </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php unset($_SESSION['errors']);?>
<?php unset($_SESSION['success']);?>
<?php include_once 'footer.php'; ?>