<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <script>
        function redirectToFacebook() {
            window.location.href = "https://www.facebook.com/profile.php?id=61565414546730";// Replace with your Facebook page URL
        }

        function redirectToInstagram() {
            window.location.href = "https://www.instagram.com/bharatyatra53?igsh=bTV4ODN4YmlzMHJj"; // Replace with your Facebook page URL
        }

        function redirectTopinterest() {
            window.location.href = "https://pin.it/vq0XeFOU5"; // Replace with your Facebook page URL
        }

        function redirectTotwitter() {
            window.location.href = "https://x.com/BHARATYATRA53?t=ZvUZTx1-567mj76JknU1HA&s=08"; // Replace with your Facebook page URL
        }

    </script>
    <style>
    * {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
        box-sizing: border-box;
    }

    .container {
        width: 100%;
        height: 100vh;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.5) 50%, rgba(0, 0, 0, 0.5) 50%), url(images/South-India-Tour-Packages.jpg);
        background-position: center;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .form-box {
        width: 90%;
        height: 600px;
        max-width: 450px;
        min-width: 350px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.5) 50%, rgba(0, 0, 0, 0.5) 50%);
        padding: 55px;
        text-align: center;
        justify-content: center;
        border-radius: 10px;
        box-shadow: -2px 2px 15px rgba(0, 0, 0, 0.5);
    }

    .form-box h1 {
        font-size: 30px;
        color: white;
    }

    .form-box .underline {
        width: 30px;
        height: 4px;
        background: white;
        margin: 10px auto 50px auto;
        border-radius: 5px;
        transition: transform .5s;
    }

    .input-field {
        background: #eaeaea;
        margin: 15px 0;
        border-radius: 10px;
        display: flex;
        align-items: center;
        max-height: 60px;
        transition: max-height 0.5s;
        overflow: hidden;
    }

    .input-field input {
        width: 100%;
        background: transparent;
        border: 0;
        outline: 0;
        padding: 18px 15px;
    }

    .input-field i {
        margin-left: 15px;
        color: #999;
    }

    form p {
        text-align: left;
        font-size: 13px;
        color: white;
    }

    form p a {
        text-decoration: none;
        color: green;
    }

    .btn-field {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .btn-field button {
        flex-basis: 48%;
        background-color: green;
        color: white;
        height: 40px;
        border-radius: 20px;
        border: 0;
        outline: 0;
        cursor: pointer;
        transition: background 1s;
    }

    .input-group {
        height: 280px;
    }

    button.disable {
        background: green;
        color: white;
    }

    .signupbtn:hover {
        background-color: black;
    }

    .signinbtn:hover {
        background-color: black;
    }

    .liw {
        padding-top: 15px;
        padding-bottom: 10px;
        text-align: center;
        font-weight: bold;
        margin-top: 20px;
    }

    .icons a {
        text-decoration: none;
        color: white;
        margin-top: 10px;
        padding-left: 5px;
        gap: 8px;
    }

    .icons ion-icon {
        color: white;
        font-size: 32px;
        margin-top: 10px;
        margin-left: 10px;
        padding: 10px;
        padding-top: 5px;
        transition: .4s ease;
    }

    .icons ion-icon:hover {
        color: green;
    }

    /* Media Queries for Responsiveness */

    /* Mobile Devices */
    @media (max-width: 480px) {
        .form-box {
            height: auto; /* Allow auto height for mobile */
            padding: 30px; /* Reduce padding */
        }

        .form-box h1 {
            font-size: 24px; /* Smaller heading */
        }

        .input-field {
            margin: 10px 0; /* Adjust margin */
        }

        .btn-field button {
            height: 35px; /* Reduce button height */
        }

        .liw {
            font-size: 14px; /* Smaller font for lower text */
        }
    }

    /* Tablets */
    @media (min-width: 481px) and (max-width: 768px) {
        .form-box {
            padding: 40px; /* Adjust padding for tablets */
        }

        .form-box h1 {
            font-size: 28px; /* Adjust heading size */
        }

        .btn-field button {
            height: 38px; /* Slightly larger button height */
        }
    }

    /* Small Desktops */
    @media (min-width: 769px) and (max-width: 1024px) {
        .form-box {
            padding: 50px; /* Maintain padding */
        }

        .form-box h1 {
            font-size: 30px; /* Standard heading size */
        }
    }

    /* Large Desktops */
    @media (min-width: 1025px) {
        .form-box {
            padding: 55px; /* Maintain standard padding */
        }

        .form-box h1 {
            font-size: 32px; /* Larger heading size */
        }
    }
</style>

</head>
<body>
    <?php include_once("header.php"); ?>
    
    <div class="container">
        <div class="form-box">
            <h1 class="title">Sign Up</h1>
            <div class="underline"></div>
            <form method="POST" action="signupvalidation.php">
                <div class="input-group">
                    <div class="input-field namefield">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="name" placeholder="Name" required>
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-at"></i>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-key"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <p><span class="text">Already have an Acoount..?</span> <a href="login.php"> Click Here!</a></p>
                </div>

                <div class="btn-field">
                    <button type="submit" class="signupbtn">Sign up</button>
                </div>

                <p class="liw">Follow Us On</p>
                    <div class="icons">
                        <a href="#" onclick="redirectToFacebook()" ><ion-icon name="logo-facebook"></ion-icon></a>
                        <a href="#" onclick="redirectToInstagram()"><ion-icon name="logo-instagram"></ion-icon></a>
                        <a href="#" onclick="redirectTopinterest()"><ion-icon name="logo-pinterest"></ion-icon></a>
                        <a href="#" onclick="redirectTotwitter()"><ion-icon name="logo-twitter"></ion-icon></a>
                    </div>
                <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
            </form>
        </div>
    </div>

    <?php include_once("footer.php"); ?>
</body>
</html>