<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./dealer/assets/css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body style="background: url('./assets/img/managerBackground.jpg');">
    <div class="wrapper-login active" >
        <from name="login" class="login-from">
            <h1>Manager Login</h1>
            <div class="input-box">
                <input class="inputUser" id="inputUser" type="text" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input class="inputPass" id="inputPass" type="password" placeholder="Password"
                    pattern="((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,})"
                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                    required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me</label>
                <a class="forgot" href="https://www.mannings.com.hk/health/cardiovascular-health/fish-oil/c/feomega-3?lang=zh_TW" target="_blank">Forgot password?</a>
            </div>
            <input type="submit" class="login-btn" id="login-btn" value="Login" >
            <div class="register-link">
                <p>
                    Don't have an account? <a id="loginSwap-btn">Register</a>
                </p>
            </div>
            <div class="SuperUser-link">
                <p>
                    Switch to Dealer Login? <a id="loginSwap-btn" href="./index.php">Clink Here</a>
                </p>
            </div>

        </from>
    </div>
    <div class="wrapper-register">

        <from action="" onkeypress="onEnter(event)">
            <h1>Register Now</h1>
            <div class="close-btn">
                <i class='bx bx-x' id="close-btn"></i>
            </div>
            <div class="input-box">
                <input class="reg-username" etype="text" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input class="register-pass" type="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="input-box">
                <input class="register-passRepeat" type="password" placeholder="Repeat your password" required>
                <i class='bx bx-check-double' id="check"></i>
            </div>


            <input  type="submit" class="register-submit-btn" value="Register" onclick="registerAC()">


        </from>
    </div>
</body>
<script src="./dealer/assets/js/Managerlogin.js"></script>
</html>