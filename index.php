<?php
    session_start();
    if(isset($_SESSION['dealer'])){
        header("Location: ./dealer/homepage.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="./assets/img/catHead.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="./dealer/assets/css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <div class="wrapper-login active">
        <form name="login" class="login-from" method="POST" action="./dealer/login.php">
            <h1>Dealer Login</h1>
            <div class="input-box">
            <input class="inputUser" id="inputUser" name="userEmailForLogin" type="text" placeholder="Email" value="<?php if(isset($_COOKIE['username'])) echo htmlspecialchars($_COOKIE['username']); ?>" required>                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input class="inputPass" id="inputPass" type="password" placeholder="Password"
                    name="passwordForLogin"
                    pattern="((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,})"
                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                    required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox" id="RememberMe"> Remember me</label>
                <a class="forgot"  >Forgot password?</a>
            </div>
            <input type="submit"  name="submit" class="login-btn" id="login-btn" value="submit" onclick="checkRemember()">
            <div class="register-link">
                <p>
                    Don't have an account? <a id="loginSwap-btn">Register</a>
                </p>
            </div>
            <div class="SuperUser-link">
                <p>
                    Switch to Manager Login? <a id="loginSwap-btn" href="./ManagerLogin.php">Click Here</a>
                </p>
            </div>
        </form>
    </div>
    <div class="wrapper-register">

        <form action="./dealer/register.php" method="post">
            <h1>Register Now</h1>
            <div class="close-btn">
                <i class='bx bx-x' id="close-btn"></i>
            </div>
            <div class="input-box">
                <input class="reg-username" 
                       name="userEmailForRegister"
                       type="text" 
                       placeholder="Your email" 
                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                       title="Please enter a valid email address."
                       required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input class="register-pass" type="password" 
                name="passwordForRegister"
                placeholder="Password" 
                pattern="((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,})" 
                title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="input-box">
                <input class="register-passRepeat" type="password" placeholder="Repeat your password" required>
                <i class='bx bx-check-double' id="check"></i>
            </div>


            <input  type="submit" class="register-submit-btn" value="Register">


        </form>
    </div>
</body>
<script>
   function checkRemember() {
    var rememberMe = document.getElementById("RememberMe");
    var userName = document.getElementById("inputUser").value;

    if (rememberMe.checked) {
        var data = {
            userName: userName
        };

        fetch("./dealer/setRememberCookie.php", {
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
<script src="./dealer/assets/js/login.js"></script>
</html>