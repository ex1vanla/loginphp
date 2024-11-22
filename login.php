
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <!-- Form đăng nhập -->
    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit" name="login_user">Login</button>
    </form>
</body>
</html>

<?php
session_start();

echo "this is test for php code";

// Khai báo biến
$username = "";
$password = "";
$errors = array();

// Kết nối tới cơ sở dữ liệu MySQL
$db = mysqli_connect('mysql-sever.mysql.database.azure.com', 'vanla', 'Exone123@', 'test2');
print_r($db);

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Kiểm tra nếu người dùng nhấn nút login
if (isset($_POST['login_user'])) {
    // $username = mysqli_real_escape_string($db, $_POST['username']);
    // $password = mysqli_real_escape_string($db, $_POST['password']);
    $username = $_POST['username'];
    $password = $_POST['password'];


    // Kiểm tra nếu các trường không rỗng
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }

    // Nếu không có lỗi, kiểm tra thông tin người dùng trong cơ sở dữ liệu
    if (count($errors) == 0) {
        // Mã hóa mật khẩu người dùng nhập vào (sử dụng MD5 ở đây)
        // $password = md5($password);

        // Truy vấn để kiểm tra người dùng có tồn tại không
        $query = "select * from users where username = '$username' and password = '$password'"; 
        $result = mysqli_query($db, $query);
        echo $query;

        // if (mysqli_num_rows($result) == 0) {
        //     // Nếu tìm thấy, đăng nhập thành công
        //     $_SESSION['username'] = $username;
        //     $_SESSION['success'] = "You are now logged in";
        //     header('location: welcome.php');
        // } else {
        //     // Nếu không tìm thấy, hiển thị lỗi
        //     array_push($errors, "Wrong username/password combination");
        // }
        if(mysqli_num_rows($result) == 0) {
            echo '<p style="color:red"> Login failed </p>' ;
        } else {
            echo '<p style="color:green"> Login Successful</p>';
        }
    }
}
?>

<!-- Hiển thị lỗi nếu có -->
<?php if (count($errors) > 0): ?>
    <div style="color: red;">
        <?php foreach ($errors as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
