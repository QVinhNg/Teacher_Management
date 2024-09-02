<?php
session_start();
include("./config/config.php");
if (isset($_POST['dangnhap'])) {
    $taikhoan = $_POST['username'];
    $matkhau = $_POST['password'];
    $sql = "SELECT * FROM `giao_vien` WHERE `TENTK`=? AND `MATKHAU`=? LIMIT 1";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ss", $taikhoan, $matkhau);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row_data = $result->fetch_assoc();
        // Lưu trữ thông tin người dùng vào phiên
        $_SESSION['user'] = $row_data;
        $role = $row_data['role'];
        if ($role == 0) {
            header("Location: ./admin/giaovien/lietkegiaovien.php");
        }
        if ($role == 1) {
            header("location: ./user/trangcanhan.php");
        }
    } else {
        $txt_err = "Sai tên tài khoản hoặc mật khẩu";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>


<body>
    <div class="container">
        <h1>Đăng nhập</h1>
        <form method="POST" action="" autocomplete="off">
            <div class="form-group">
                <label for="username">Tài khoản</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="">
            </div>
            <div class="form-group">
                <input type="submit" class="form-control" name="dangnhap" value="Đăng nhập">
            </div>

            <div class="message-err-login">
                <?php
                if (isset($txt_err) && ($txt_err != "")) {
                    echo $txt_err;
                }
                ?>
            </div>
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    body {
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        padding: 20px;
        width: 450px;
    }

    .container h1 {
        color: #007bff;
        text-align: center;
    }

    .container .button-register {
        text-align: center;

    }

    .form-group label {
        font-weight: bold;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-group .form-control:focus {
        border-color: #007bff;
    }

    .form-group input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        margin-top: 10px;
    }

    .form-group input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .message-err-login {
        color: red;
    }
</style>

</html>