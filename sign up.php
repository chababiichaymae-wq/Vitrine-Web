<?php
$conn = new mysqli("localhost", "root", "", "site_web");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];

    // التحقق أن اسم المستخدم ما موجودش من قبل
    $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h3 style='color:red; text-align:center;'>اسم المستخدم موجود مسبقاً.</h3>";
        echo "<p style='text-align:center;'><a href='sign up.html'>العودة للتسجيل</a></p>";
        exit;
    }

    // تشفير كلمة المرور
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // إدخال المستخدم الجديد
    $stmt = $conn->prepare("INSERT INTO utilisateurs (username, mot_de_passe) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $passwordHash);

    if ($stmt->execute()) {
        echo "<h3 style='color:green; text-align:center;'>تم التسجيل بنجاح!</h3>";
        echo "<p style='text-align:center;'><a href='login.html'>الانتقال إلى تسجيل الدخول</a></p>";
    } else {
        echo "<h3 style='color:red; text-align:center;'>حدث خطأ أثناء التسجيل.</h3>";
        echo "<p style='text-align:center;'><a href='sign up.html'>العودة للتسجيل</a></p>";
    }
}
?>