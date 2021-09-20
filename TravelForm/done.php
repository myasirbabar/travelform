<?php
    session_start();
    if (!isset($_SESSION['authenticated']))
    {
        //if the value was not set, you redirect the user to your login page
        header('Location: AccessDenied'); // 'Location : error.php'
        exit;
    }
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://image.flaticon.com/icons/png/128/1970/1970023.png">
    <title>Form Submitted Successfully</title>
    <style>
        * {
            margin: 0px;
        }
        body{
            background-image: url("./images/background.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
        .msg {
            padding: 25px;
            margin: auto;
            background-color: blanchedalmond;
            font-size: x-large;
        }

        .msg h3, h6{
            padding: 10px;
            margin: 5px;
        }
        hr{
            margin: 25px;
        }
        .msg a {
            padding: 10px;
            margin: 5px;
        }
        .msg a:hover{
            color: black;
        }
        .msg a:focus{
            color: red;
        }
        .msg a:active{
            color: purple;
        }
    </style>
</head>

<body>
    <div class="msg">
        <h3>Form Submitted Successfully</h3>
        <h6>A Confirmation Email Has Also Been Sent to you.. </h6>
        <hr>
        <a href="welcome" class="another">Submit Another Form</a> <!--href="index.php"-->
    </div>
</body>

</html>