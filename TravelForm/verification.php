<?php
    session_start();
    if (!isset($_SESSION['authenticated']))
    {
        //if the value was not set, you redirect the user to your login page
        header('Location: AccessDenied'); // 'Location : error.php'
        exit;
    }
    
    $flag = false;
    if(isset($_POST['ver_code']))
    {
        $verification_code = $_SESSION['verification_code'];
        $user_code = $_POST['ver_code'];

        if($verification_code == $user_code)
        {
            $server = "localhost";
            $username = "root";
            $password = '';

            $con = mysqli_connect($server, $username, $password);

            if(!$con)
            {
                die("Connection to Data Base Failed due to " . mysqli_connect_error());
            }
            
            $name = $_SESSION['name']; // ID's OF input fields 
            $age = $_SESSION['age'];
            $gender = $_SESSION['gender'];
            $email = $_SESSION['email'];
            $phone = $_SESSION['phone'];
            $desc = $_SESSION['desc'];


                        //DATABSE NAME. Table Name
            $sql = "INSERT INTO `trip`.`trip` (`Name`, `Age`, `Gender`, `Email`, `Phone`, `other`, `dt`) VALUES ('$name', '$age',
            '$gender', '$email', '$phone', '$desc', current_timestamp());";

            if ($con->query($sql))
            {
                $flag = true;
               
            }
            else{
                echo "<script>alert('Error Submitting the Form. ')</script>"; 
            }
            $con->close();
        }

        else{
            echo "<script>alert('Invalid Verification Code. ')</script>"; 
        }
        
    }
    
    

?>
<?php
    //MAILING
    if($flag)
    {
        $to = $_SESSION['email']; 
        
        $name = $_SESSION['name']; // ID's OF input fields 
        $to = $_SESSION['email'];
        $desc = $_SESSION['desc'];

        $body = "";
        $body .= "Dear " . $name. ",\n";
        $body .= "\nThis mail is to inform your confirmation in Trip.";

        $body .= " Following are your details\n";
        $body .= "\t Name: " . $name . "\n\t Age : " . $age . "\n\t Phone Number : " . $phone;

        if(isset($_SESSION['desc']) && $desc != ''){
            $body .= "\n\t Specific Instructions / Details : ' " .$desc . " '";
            
        }

        $body .= "\n\nLooking Forward To see you soon !\n";        

        $body .= "Thanks For Choosing Us ! We hope your journey will be safe and sound with us.";
        $body .= "Regards\nMYB Systems\n Email : mybdev10@gmail.com";

        $headers = "From: MYB Systems <mybdev10@gmail.com>";

        mail($to, "Trip Confirmation Mail", $body,$headers);

        header('Location:  Registered ');//'Location: done.php'
        $_SESSION['authenticated'] = true;
        
        die(); 

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="https://image.flaticon.com/icons/png/128/1970/1970023.png">
    <title>Verification Page</title>
</head>
<body>
    <div class="container"  id = "verification">

    <h3>Verification</h3>
    <p>Kindly Enter Verification Code Sent To your email</p>


    <form action="verify" method="post"> <!--action="verification.php"-->
        <input type="number" name="ver_code" id="ver_code" placeholder="Enter Code" required>

        <button type="submit" class="btn">Submit Form</button>
    </form>
    </div>

</body>
</html>