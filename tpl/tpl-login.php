<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/auth.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
    <title>Login</title>
</head>

<body>
    <div class="login-page">
        <div class="form">
            <form class="register-form">
                <p class="text">Login</p>
                <input type="email" placeholder="Email address" id="email" />
                <input type="password" placeholder="Password" id="password" />
                <button id="login">login</button>
                <p class="message">Do you not have account? <a class="message" href="<?= BASE_URL ?>auth/register.php">register</a></p>
            </form>
        </div>
    </div>
    <br>
    <div class="error"></div>
    <!-- * CDN * -->

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- * Local * -->
    <script src="<?= BASE_URL ?>assets/js/script.js"></script>
</body>

</html>