<?php
    //MAILING
    $flag = false;
    $to = ''; 
    if( isset( $_POST['email'])) {
        $to = $_POST['email']; 
    }
    if(filter_var($to, FILTER_VALIDATE_EMAIL))
    {
        $name = $_POST['name']; // ID's OF input fields 
        $to = $_POST['email'];
        $verification_code = rand(100000, 999999);
       

        $body = "";
        $body .= "Dear " . $name. ",\n";
        $body .= "Your Trip verification Code is ". $verification_code;

    
        $body .= "\n\nThank You!\n"; 
        $body .= "Regards\nMYB Systems\nEmail : mybdev10@gmail.com";

        $headers = "From: MYB Systems <mybdev10@gmail.com>";

        mail($to, "Trip Verification Code", $body,$headers);

        $flag = true;
    }
    else if( isset( $_POST['email']) && !filter_var($to, FILTER_VALIDATE_EMAIL)){
        echo "<script>alert('Invalid Email Address, Try Again');</script>";
    }
    
    if($flag)
    {
        session_start();
        $_SESSION['name'] = $_POST['name']; // ID's OF input fields 
        $_SESSION['age']= $_POST['age'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['phone'] = $_POST['phone'];
        $_SESSION['desc'] = $_POST['desc'];
        $_SESSION['verification_code'] = $verification_code;
        $_SESSION['authenticated'] = true;
        
        header('Location: verify'); //'Location: verification.php'
        die();
    }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap,100&family=Sriracha&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" href="https://image.flaticon.com/icons/png/128/1970/1970023.png">
    <title>Travel Form</title>
    
</head>

<body>
<!--     <img src="./images/img2.jpg" alt="Error Loading Pictire" class="bg"> -->  
    <div class="container">

        <h3>Welcome To MYB Travel Agency</h3>
        <p>Enter Your Details To Confirm Your Seat in the trip plan</p>
       

        <form action="index.php" method="post">
            <input type="text" name="name" id="name" placeholder="Enter Your Name" required>

            <input type="number" name="age" id="age" placeholder="Enter Your Age" required>

            <select name="gender" id="gender" required>
                <option value="" hidden selected disabled>Select Your Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="NA">Prefer Not To Say</option>
            </select>

            <input type="email" name="email" id="email" placeholder="Enter Your Email" required>

            <input type="tel" name="phone" id="phone" placeholder="Enter Your Number. Format 03001234567" 
            pattern = "[0][3][0-9]{2}[0-9]{7}" required>

            <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter Any Further Details Here"></textarea>

            <button type="submit" class="btn">Submit Form</button>

            <!-- <button type="submit" class="btn">Reset Form</button> -->
        </form>
    </div>
    <script src="index.js"></script>
 
</body>

</html>