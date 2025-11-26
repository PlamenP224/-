<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "login_system");

if (!$conn) {
    die("Грешка при връзката: " . mysqli_connect_error());
}

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $sql)) {
        $message = "Регистрацията е успешна!";
    } else {
        $message = "Грешка при регистрация.";
    }
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION["logged"] = true;
        $_SESSION["username"] = $username;
    } else {
        $message = "Грешно име или парола!";
    }
}

if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<body>

<?php if (!isset($_SESSION["logged"])): ?>

    <h2>Регистрация</h2>
    <?php if (isset($message)) echo "<p>$message</p>"; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Потребител" required><br><br>
        <input type="password" name="password" placeholder="Парола" required><br><br>
        <button type="submit" name="register">Регистрация</button>
    </form>

    <hr>

    <h2>Вход</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Потребител" required><br><br>
        <input type="password" name="password" placeholder="Парола" required><br><br>
        <button type="submit" name="login">Вход</button>
    </form>

<?php else: ?>

    <h1>Добре дошъл, <?= $_SESSION["username"]; ?>!</h1>
    <p>Това е защитена страница, видима само след логин.</p>

    <a href="index.php?logout=1">Изход</a>

<?php endif; ?>

</body>
</html>