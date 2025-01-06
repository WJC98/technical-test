<?php
session_start();

date_default_timezone_set('Asia/Kuala_Lumpur');

$current_time = date('l, F j, Y h:i A');

if (isset($_SESSION['error'])) {
    $error_message = $_SESSION['error'];
    unset($_SESSION['error']); 
} else {
    $error_message = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center; 
            align-items: center; 
            min-height: 100vh;
            background-color: rgb(124, 80, 228);
        }

        .container {
            display: flex;
            width: 80%;
            max-width: 1000px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .left-side {
            background: linear-gradient(135deg, #6c5ce7, #a29bfe);
            color: #fff;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .left-side h1 {
            font-size: 3rem;
            font-weight: 600;
            margin-bottom: 15px;
            background: -webkit-linear-gradient(#6a11cb,rgb(68, 64, 64));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .left-side p {
            font-size: 1.2rem;
            font-weight: 400;
            color: rgb(255, 255, 255);
            margin-top: 10px;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .right-side {
            background-color: #F8F8F8;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            text-align: center;
        }

        .right-side h2 {
            font-size: 1.6rem;
            margin-bottom: 20px;
        }

        .right-side input {
            width: 100%;
            max-width: 350px;
            padding: 10px;
            margin: 8px 0;
            border-radius: 25px;
            border: 1px solid #ddd;
            font-size: 1rem;
            box-sizing: border-box; 
        }

        .right-side input[type="submit"] {
            background-color: #6c5ce7;
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .right-side input[type="submit"]:hover {
            background-color: #2575fc;
        }

        .error-message {
            color: #e74c3c;
            margin-top: 10px;
        }

        .login-footer {
            margin-top: 15px;
            font-size: 0.9rem;
            color: #777;
        }

        .login-footer a {
            color: #2575fc;
            text-decoration: none;
            font-weight: bold;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            body {
                padding: 0;
        		margin: 0;
            }

            .container {
                flex-direction: column;
                width: 100%; 
                margin: 0;
                border-radius: 0; 
                box-shadow: none; 
            }

            .left-side, .right-side {
                flex: none;
                width: 100%;
                height: auto;
                padding: 10px; 
            }

            .left-side h1 {
                font-size: 1.8rem;
            }

            .left-side p {
                font-size: 1rem;
                word-wrap: break-word; 
            }

            .right-side input {
                font-size: 1rem;
            }

            .right-side input[type="submit"] {
                font-size: 1rem;
            }

            .login-footer {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-side">
            <h1>Welcome, Admin</h1>
            <p id="date-time"><?php echo $current_time; ?></p>
        </div>

        <div class="right-side">
            <div class="logo-container">
                <img src="image/admin_logo.png" alt="Admin Logo" style="max-width: 150px;">
            </div>

            <h2>Admin Login</h2>
            <form action="login_process.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
            </form>

            <?php if ($error_message): ?>
                <p class="error-message"><?= htmlspecialchars($error_message) ?></p>
            <?php endif; ?>

            <div class="login-footer">
                <p></p>
            </div>
        </div>
    </div>
</body>
</html>
