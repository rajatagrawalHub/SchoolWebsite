<?php
$error_message = "";
if(isset($_POST['fname'])){
if(null != $_POST['fname'] && $_POST['city']){
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

        $sql = "INSERT INTO `main`.`student details` (`Student_ID`, `First Name`, `Last Name`, `Mother Name`, `Father Name`, `Contact Details`, `Date Of Birth`, `Class`, `Percentage`, `City`, `PinCode`, `Fee`, `School`, `Time Added`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,current_timestamp());";
        
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $fatname = $_POST['fatname'];
        $motname = $_POST['motname'];
        $school = $_POST['school'];
        $classn = $_POST['classn'];
        $per = $_POST['per'];
        $city = $_POST['city'];
        $dob = $_POST['dob'];
        $pin = $_POST['pin'];
        $contname = $_POST['contname'];
        $fee = $_POST['fee'];
        $studid = $_POST['fname'].$_POST['city'];
        $statement = mysqli_prepare($con,$sql);
    mysqli_stmt_bind_param($statement,'sssssssiisids',$studid,$fname,$lname,$motname,$fatname,$contname,$dob,$classn,$per,$city,$pin,$fee,$school);
        
        if(mysqli_stmt_execute($statement)){
            
        }else{
           echo "Query Error: ".mysqli_error($con);
        }
    
        $con->close();
    }
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
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Oswald:wght@500&family=Pangolin&family=Roboto:wght@300;400&display=swap" rel="stylesheet">

    <style type="text/css">
        body {
            margin: 0 auto;
            padding: 0;
            background-repeat: no-repeat;
            height: 100vh;
            font-family: 'Roboto', sans-serif;

        }

        p {
            margin: 0;
        }

        #BrandBar {
            display: flex;
            flex-flow: row nowrap;
            justify-content: space-between;
            background-image: linear-gradient(290deg, #e6ade2, rgba(0, 0, 0, 0.65));
            color: rgba(247, 247, 247, 0.97);
            font-family: 'Pangolin', cursive;
            font-weight: 800;
            font-size: 24px;
            margin: 0 auto;
            padding: 8px 20px;
            height: 5vh;
            text-align: center;
            vertical-align: middle;
        }

        #leftpanel {
            background-color: lightgoldenrodyellow;
            width: 240px;
            height: 92vh;
            display: none;
            color: slategrey;
            border-right: 3px solid #e6ade2;
            position: fixed;
            z-index: 1;
        }

        .mainpanel {
            float: left;
            background-color: #f7f7f7;
            height: 92vh;
        }

        #mobilepanel {
            display: none;
            color: red;
            text-align: center;
        }

        #BrandBar i {
            padding: 2px 10px;
            cursor: pointer;
        }

        #xmark {
            display: none;
        }

        #bar {
            display: block;
        }

        .mainpanel {
            font-size: 110%;
            justify-content: center;
            display: block;
            width: 100%;
        }

        input {
            font-size: 13px;
            color: #2c002c;
            border-radius: 8px;
            transition: ease-in-out 100ms;
        }

        .title {
            margin: 0;
            text-align: center;
            font-size: 36px;
            font-weight: 400;
            color: #2c002c;
            font-family: 'Pangolin';
            padding: 20px;
        }

        .input_label {
            padding: 5px;
            color: #5c5c5c;
            font-size: 14px;
            width: 100%;
        }

        input {
            margin: 0;
            border: 1px solid #2c002c !important;
            padding: 8px 5px;
            font-size: 12px;

        }


        input:focus {
            outline: none;
            border: 3px solid #e6ade2 !important;
        }

        .btn {
            font-size: 85%;
            font-weight: 400;
            width: 100px;
            border: 1px solid #2c002c;
            border-radius: 2px;
            cursor: pointer;
            display: inline-block;
            padding: 10px 13px;
            margin: 5px;
            color: white;
            border: 1px solid white;
            background-color: transparent;
            transition: ease-in-out 100ms;
        }

        .btn_submit {
            background-color: #e6ade2;
        }

        .btn_reset {
            background-color: #fafa9d;
            color: lightblue;
        }

        .btn:focus {
            outline: none;
            border: 3px solid lightblue;
        }

        .btn:hover {
            outline: none;
            border: 3px solid lightblue;
        }


        #form-grid {
            display: grid;
            grid-template-areas: 'r1c1 r1c2c3 r1c2c3 r1c4 r1c5c6 r1c5c6'
                'r2c1 r2c2c3 r2c2c3 r2c4c5c6 r2c4c5c6 r2c4c5c6'
                'r3c1 r3c2c3 r3c2c3 r3c4c5c6 r3c4c5c6 r3c4c5c6'
                'r4c1 r4c2c3 r4c2c3 r4c4c5c6 r4c4c5c6 r4c4c5c6'
                'r5c1 r5c2c3 r5c2c3 r5c4c5c6 r5c4c5c6 r5c4c5c6'
                'r6c1 r6c2 r6c3 r6c4 r6c5 r6c6'
                'r7c1 r7c2 r7c3 r7c4 r7c5 r7c6'
                'r8c1c2 r8c1c2 r8c1c2 r8c1c2 r8c3c4 r8c5c6';
            margin: 40px 20px;
            grid-row-gap: 15px;
            column-gap: 5px !important;
        }

        .grid-item {
            padding: 0;
            margin: 0;
        }

        @media only screen and (max-width: 768px) {
            #mobilepanel {
                display: block;
            }

            #leftpanel {
                display: none;
            }

            .mainpanel {
                display: none;
            }
        }

        #error_msg {
            color: red;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            padding: 10px;
        }

    </style>
</head>

<body>
    <div id="container">
        <div id="BrandBar">
            <i class="fa-solid fa-xmark" id="xmark" onclick="toggle();"></i>
            <i class="fa-solid fa-bars" id="bar" onclick="toggle();"></i>
            <p>
                <i class="fa-solid fa-user"></i>Username
            </p>
            <div id="Logo">
                <p>ABC</p>
            </div>
        </div>
        <div id="leftpanel">dccsd
        </div>
        <div class="mainpanel" id="Stud_MainPanel">
            <h2 class="title">Create Student</h2>
            <div id="formstd">
                <form id="form-grid" method="post" action="">
                    <div class="gird-item" style="grid-area: r1c1;"><label for="fname" class="input_label">First Name</label></div>
                    <div class="gird-item" style="grid-area:r1c2c3;"><input type="text" name="fname" id="fname" class="input_text" /></div>
                    <div class="gird-item" style="grid-area:r1c4;"><label for="lname" class="input_label">Last Name</label></div>
                    <div class="gird-item" style="grid-area:r1c5c6;"><input type="text" name="lname" id="lname" class="input_text" /></div>
                    <div class="gird-item" style="grid-area:r2c1;"><label for="motname" class="input_label">Mother's Name</label></div>
                    <div class="gird-item" style="grid-area:r2c2c3;"> <input type="text" name="motname" class="input_text" /></div>
                    <div style="grid-area: r2c4c5c6"></div>
                    <div class="gird-item" style="grid-area:r3c1;"> <label for="fatname" class="input_label">Father's Name</label></div>
                    <div class="gird-item" style="grid-area:r3c2c3;"> <input type="text" name="fatname" class="input_text" /></div>
                    <div style="grid-area: r3c4c5c6"></div>
                    <div class="gird-item" style="grid-area:r4c1;"> <label for="contname" class="input_label">Contact Details</label></div>
                    <div class="gird-item" style="grid-area:r4c2c3;"> <input type="number" name="contname" id="contname" class="input_text" /></div>
                    <div style="grid-area: r4c4c5c6"></div>
                    <div class="gird-item" style="grid-area:r5c1;"><label for="school" class="input_label">School</label></div>
                    <div class="gird-item" style="grid-area:r5c2c3;"> <input type="text" name="school" class="input_text" /></div>
                    <div style="grid-area: r5c4c5c6"></div>
                    <div class="gird-item" style="grid-area:r6c1;"> <label for="dob" class="input_label">Date Of Birth</label></div>
                    <div class="gird-item" style="grid-area:r6c2;"> <input type="date" name="dob" id="dob" class="input_text" /></div>
                    <div class="gird-item" style="grid-area:r6c3;"> <label for="classn" class="input_label">Class</label></div>
                    <div class="gird-item" style="grid-area:r6c4"> <input type="text" name="classn" id="classn" class="input_text" /></div>
                    <div class="gird-item" style="grid-area:r6c5"> <label for="per" class="input_label">Percentage</label></div>
                    <div class="gird-item" style="grid-area:r6c6"> <input type="number" name="per" id="per" class="input_text" /></div>
                    <div class="gird-item" style="grid-area:r7c1"> <label for="city" class="input_label">City</label></div>
                    <div class="gird-item" style="grid-area:r7c2"> <input type="text" name="city" id="city" class="input_text" /></div>
                    <div class="gird-item" style="grid-area:r7c3"> <label for="pin" class="input_label">PIN Code</label></div>
                    <div class="gird-item" style="grid-area:r7c4"> <input type="number" name="pin" id="pin" class="input_text" /></div>
                    <div class="gird-item" style="grid-area:r7c5"> <label for="fee" class="input_label">Fee</label></div>
                    <div class="gird-item" style="grid-area:r7c6"><input type="number" name="fee" class="input_text" /></div>
                    <div style="grid-area: r8c1c2">
                        <p id="error_msg">Error Message</p>
                    </div>
                    <div class="gird-item" style="grid-area:r8c3c4"><button class="btn btn_submit" id="submit_btn">Submit</button></div>
                    <div class="gird-item" style="grid-area:r8c5c6"> <button class="btn btn_reset" id="reset_btn">Reset</button></div>
                </form>
            </div>

        </div>
        <div id="mobilepanel">
            <h2>This Panel cannot be accessed through mobile phones</h2>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/5154870677.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var togglestate = 0;

        function toggle() {
            if (togglestate == 1) {
                document.getElementById("leftpanel").style.display = "none";
                document.getElementById("xmark").style.display = "none";
                document.getElementById("bar").style.display = "block";
                togglestate = 0;
            } else {
                document.getElementById("leftpanel").style.display = "block";
                document.getElementById("xmark").style.display = "block";
                document.getElementById("bar").style.display = "none";
                togglestate = 1;
            }
        }

        //        var n_input_boxes = document.getElementsByClassName("input_text").length;
        //        var i = 0;
        //        for (i = 0; i < n_input_boxes; i++) {
        //
        //        }
        // Logic to Validate Information

        var error = "";

        function Validate_Form() {
            if (document.getElementById("fname").value == "" || document.getElementById("lname").value == "" || document.getElementById("classn").value == "" || document.getElementById("city").value == "") {
                alert("Primary Fields Cannot Be Empty")
            };
        }

        document.getElementById("submit_btn").addEventListener("click", function() {
            Validate_Form();
        });

    </script>
</body>

</html>
