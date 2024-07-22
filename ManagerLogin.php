<?php
session_start();
if (isset($_SESSION['salesManager'])) {
    header("Location: ./salesManager/homepage.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Login</title>
    <link rel="shortcut icon" href="./assets/img/catHead.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="./salesManager/assets/css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body style="background: url('./assets/img/managerBackground.jpg');">
    <div class="wrapper-login active">
        <form name="login" class="login-from" method="POST" action="./salesManager/assets/subphp/login.php">
            <h1>salesManager Login</h1>
            <div class="input-box">
                <input class="inputUser" id="inputUser" name="userEmailForLogin" type="text" placeholder="Email" value="<?php if (isset($_COOKIE['userEmailForManange'])) echo htmlspecialchars($_COOKIE['userEmailForManange']); ?>" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input class="inputPass" id="inputPass" type="password" placeholder="Password" name="passwordForLogin" pattern="((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,})" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" value="<?php if (isset($_COOKIE['passwordForManange'])) echo htmlspecialchars($_COOKIE['passwordForManange']); ?>" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox" id="RememberMe"> Remember me</label>
                <a class="forgot">Forgot password?</a>
            </div>
            <input type="submit" name="submit" class="login-btn" id="login-btn" value="Login" onclick="checkRemember()">
            <div class="SuperUser-link">
                <p>
                    Switch to Dealer Login? <a id="loginSwap-btn" href="./index.php">Click Here</a>
                </p>
            </div>
        </form>
    </div>

</body>
<script>
    function checkRemember() {
        var rememberMe = document.getElementById("RememberMe");
        var userEmail = document.getElementById("inputUser").value;
        
        if (rememberMe.checked) {
            var data = {
                ManagerEmail: userEmail
            };

            fetch("./salesManager/assets/subphp/setRememberCookie.php", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(responseData => {
                    if (responseData.status === 'success') {
                        console.log('Cookies set successfully');
                    } else {
                        console.error('Error:', responseData.message);
                    }
                })
                .catch(error => console.error('Fetch error:', error));
        }
    }
</script>
<script src="./salesManager/assets/js/login.js"></script>

</html>