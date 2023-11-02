<?php

session_start();

include "connection.php";

if (isset($_POST['EPosta']) && isset($_POST['Parola'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['EPosta']);
    $pass = validate($_POST['Parola']);

    if (empty($uname)) {
        header("Location: index.php?error=User Name is required");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM kullanıcılar WHERE EPosta='$uname' AND Parola='$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['EPosta'] === $uname && $row['Parola'] === $pass) {
                $_SESSION['EPosta'] = $row['EPosta'];
                $_SESSION['Ad'] = $row['Ad'];
                $_SESSION['ID'] = $row['ID'];
                // Giriş başarılı olduğunda yönlendirme yapılacak URL
                // Anında yönlendirme
                header("Location: /projects/Project%202/home2.html");
                exit();
            }
        }
        header("Location: /projects/Project%202/login_error.html");
        exit();
    }


    exit();
}
