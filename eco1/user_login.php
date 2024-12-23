<?php
include('includes/connect.php');
include('functions/common_functions.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>

<body>

    <div class="register">
        <div class="container py-3">
            <h2 class="text-center mb-4">Đăng nhập</h2>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form action="" method="post" class="d-flex flex-column gap-4">
                        <!-- username field  -->
                        <div class="form-outline">
                            <label for="username" class="form-label">Tài khoản</label>
                            <input type="text" placeholder="Nhập tài khoản" autocomplete="off" required="required" name="username" id="username" class="form-control">
                        </div>
                        <!-- password field  -->
                        <div class="form-outline">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" placeholder="Nhập mật khẩu" autocomplete="off" required="required" name="password" id="password" class="form-control">
                        </div>
                        <div><a href="" class="text-decoration-underline">Quên mật khẩu?</a></div>
                        <div>
                            <input type="submit" value="Login" class="btn btn-primary mb-2" name="login">
                            <p>
                                Chưa có tài khoản? <a href="user_registration.php" class="text-primary text-decoration-underline"><strong>Đăng ký</strong></strong></a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets//js/bootstrap.bundle.js"></script>
</body>

</html>
<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $select_query = "SELECT * FROM `users` WHERE username='$username' AND `role_id`=2";
    $select_result = mysqli_query($con, $select_query);
    $row_data = mysqli_fetch_array($select_result);

    $row_count = mysqli_num_rows($select_result);

    if ($row_count > 0) {
        if (password_verify($password, $row_data['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row_data['id'];
            echo "<script>window.location.href = './index.php';</script>";
        } else {
            echo "<script>alert('Mật khẩu không chính xác')</script>";
        }
    } else {
        echo "<script>alert('Tài khoản không hợp lệ')</script>";
    }
}
?>