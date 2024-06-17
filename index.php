<?php
$error_message = "";

if(isset($_POST['usrtb'])){
    //Connection Variables
    $server = "localhost";
    $username = "root";
    $password = "";

    //Establishing Connection
    $con = mysqli_connect($server,$username,$password);

    //Checking Connection
    if(!$con){
        // In Case Of Unsuccessful Connection
        die("Connection to this database detailed due to".mysqli_connect_error());
    }else{
        $uname = $_POST['usrtb'];
        $passwrd = $_POST['pwdtb'];

        $sql = "SELECT * FROM `main`.`credentials` WHERE `Username`= ?;";

        $statement = mysqli_prepare($con,$sql);
        mysqli_stmt_bind_param($statement,'s',$uname);
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        if($result){
            if($row = mysqli_fetch_assoc($result)){
                $PasswordFetched = $row['Password'];
                if($PasswordFetched == $passwrd){
                    $error_message = "Login Successful";
                    header("Location: main.php");
                }else{
                    $error_message = "Incorrect Password";
                }
            }else{
                $error_message = "User Not Found";
            }
        }else{
           $error_message = "Querry Error: ".mysqli_error($con);
        }
    
        $con->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My School</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">

    <style type="text/css">
        body {
            margin: 0 auto;
            padding: 0;
            background-image: linear-gradient(50deg, rgb(235, 17, 180), rgba(0, 0, 0, 0.65));
            background-repeat: no-repeat;
            height: 100vh;
            overflow-y: hidden;
        }

        #LoginPanel {
            font-family: 'Roboto', sans-serif;
            border: 3px solid rgba(255, 255, 255, 0.45);
            width: 30%;
            margin: 17% 12%;
            color: white;
            display: flex;
            flex-flow: column nowrap;
            border-radius: 7px;
            background-color: rgba(255, 255, 255, 0.12);
            transition: ease-in 300ms;
        }

        #hdg {
            font-weight: 800;
            text-align: center;
            font-size: 26px;
            margin: 0;
            padding: 10px;
        }

        #container {
            display: flex;
            flex-flow: row-reverse nowrap;
        }

        .tbx {
            padding: 7px;
            width: 70%;
            margin-top: 5px;
            margin-bottom: 5px;
            margin-left: 13%;
            text-align: left;
            font-size: 11px;
            font-weight: 400;
            color: darkgray;
            border: 1px solid white;
            border-radius: 2px;
            outline: 3px solid #e6ade2;
        }

        .tbx:focus {
            outline: 3px solid lightblue;
        }


        label {
            text-align: left;
            font-weight: 300;
            padding: 2px;
            margin-left: 13%;
            font-size: 14px;
        }

        button {
            background-color: white;
            color: rgb(178, 1, 133);
            padding: 9px 15px;
            font-size: 12px;
            font-weight: 300;
            margin: 10px 0 10px 41%;
            border: 1px solid rgba(178, 1, 133, 0.75);
            border-radius: 9px;
            cursor: pointer;
            transition: ease-in 300ms;
        }

        #LoginPanel:hover {
            transform: scale(1.02);
        }

        #LoginPanel #logb {
            pointer-events: auto;
        }

        #LoginPanel #logb:hover {
            border: 1px solid white;
            background-color: rgba(190, 3, 190, 0);
            color: white;
            transform: scale(1.02);
        }

        .chb {
            margin: 0;
            padding: 0 !important;
            margin-top: 2%;
            margin-left: 13%;
            display: flex;
            flex-flow: row nowrap;
        }

        .chb input {
            margin: 0;
            margin-right: 2px;
            padding: 0;
            border: 1px solid #e6ade2 !important;
        }

        .chb p {
            margin: 0 !important;
            font-size: 11px !important;
            padding: 1px 0 0 3px;
        }

        .chb input:focus {
            outline: 1px solid rgba(255, 255, 255, 0.28);
            border: none;
        }

        #logb {
            outline: none;
        }

        #logb:focus {
            outline: none;
            border: 1px solid white;
            background-color: rgba(190, 3, 190, 0);
            color: white;
            transform: scale(1.02);
        }

        h6 {
            margin: 0;
            padding: 0;
            text-align: center;
            font-weight: 300;
            font-size: 12px;
            padding-bottom: 4px;
            color: yellow;
        }

    </style>
</head>

<body>
    <div id="container">
        <div id="LoginPanel">
            <p id="hdg">LOGIN</p>
            <form action="index.php" method="post">
                <label>Username</label>
                <input type="text" placeholder="Username" maxlength="20" class="tbx" id="usrtb" name="usrtb" autocomplete="off" />
                <label>Password</label>
                <input type="password" placeholder="Password" maxlength="25" class="tbx" id="pwdtb" name="pwdtb" />
                <div class="chb">
                    <input type="checkbox" name="Hide" id="chx" />
                    <p>Show Password</p>
                </div>
                <button type="submit" id="logb">LOG IN</button>
                <script type="text/javascript">
                    const checkbox = document.getElementById('chx');
                    const input = document.getElementById('pwdtb');

                    checkbox.addEventListener('change', function() {
                        if (this.checked) {
                            input.type = 'text';
                        } else {
                            input.type = 'password';
                        }

                    });

                </script>
                <?php
                    if(isset($_POST['usrtb'])){
                        echo "<h6>". $error_message . "</h6>";
                    }
                    exit;
                ?>
            </form>
        </div>
    </div>

</body>

</html>
