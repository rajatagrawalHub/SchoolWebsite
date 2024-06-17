<?php
$error_message = "";

if(isset($_POST['cd'])){
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
        $no = $_POST['cd'];

        $sql = "INSERT INTO `main`.`callrequest` (`Mobile Number`, `Time`) VALUES (?, current_timestamp());";

        $statement = mysqli_prepare($con,$sql);
        mysqli_stmt_bind_param($statement,'s',$no);
        if(mysqli_stmt_execute($statement)){
            
        }else{
           echo "Query Error: ".mysqli_error($con);
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

    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Oswald:wght@500&family=Pangolin&family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <!--Icons-->

    <!--Google Map API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4C2IUpXyRLMrW1diYmTcTUA4N0XjvkXU&callback=initMap" async defer></script>

    <style type="text/css">
        ::-webkit-scrollbar {
            width: 5px;
            height: 50vh;
        }

        /* Track background color */
        ::-webkit-scrollbar-track {
            background-color: rgba(118, 202, 230, 0.8);
        }

        /* Color of the scrollbar handle */
        ::-webkit-scrollbar-thumb {
            background-color: #ffffff;
        }


        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            overflow-x: hidden !important;
        }

        #Container {
            margin: 0;
            padding: 0;
        }

        #navBar {
            min-height: 40px;
            background-image: linear-gradient(290deg, #e6ade2, rgba(0, 0, 0, 0.65));
            background-color: rgba(0, 0, 0, 0.5);
            margin: 0 auto;
            display: flex;
            flex-flow: row nowrap;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1;
        }

        p {
            margin: 0;
        }

        #Logo p {
            color: rgba(247, 247, 247, 0.97);
            font-family: 'Pangolin', cursive;
            font-weight: 800;
            font-size: 24px;
        }

        #Logo {
            margin-left: 1%;
            padding: 8px;
        }

        #Links {
            margin-right: 1%;
            margin-top: 12px;
            display: none;
        }

        #Links li {
            list-style: none;
            float: left;
            padding: 1px 12px;
            font-size: 13px;
            font-weight: 600;
            color: #f7f7f7;
        }

        #Links a {
            text-decoration: none;
            color: #F7F7F7;
            margin: 0;
            padding: 0;
            transition: ease-in 200ms;
        }

        #Links ul {
            margin: 0 auto;
        }

        #Links a:hover {
            font-size: 14px;
            cursor: pointer;
            color: rgba(118, 202, 230, 0.8);
        }

        #noticebar {
            background-image: linear-gradient(50deg, #e6ade2, rgba(0, 0, 0, 0.65));
            margin: 0;
            position: fixed;
            right: 0;
            top: 50%;
            z-index: 1;
            transform: translate(0, -50%);
            display: flex;
            flex-flow: column nowrap;
        }

        #noticebar i {
            color: #f7f7f7;
            padding: 12px;
            font-size: 14px;
            cursor: pointer;
        }

        #noticebar i:hover {
            color: rgba(118, 202, 230, 0.8);

        }


        #carousel {
            background-image: url(Images/Carousel_Bg2.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            height: 93vh;
            margin: 0;
            position: relative;
        }

        #carouselcont {
            background-color: rgba(235, 17, 180, 0.26);
            height: 100%;
            padding-top: 45px;
            box-sizing: border-box;
            font-family: 'Lilita One', cursive;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }

        #carouselcont p {
            padding: 0;
            margin: 0;
        }

        #matt {
            width: 50%;
            margin: 0;
            padding: 0;
            margin-right: 40px;
            margin-left: 30px;
            text-align: center;
        }

        #carouselcont h1 {
            color: #2c002c;
            font-size: 78px;
            margin: 0;
            -webkit-text-stroke: 0.01px white;
            text-align: center;
        }

        .btn {
            background-color: rgba(255, 255, 255, 0.82);
            color: #2c002c;
            font-size: 70%;
            font-weight: 400;
            border: 1px solid #2c002c;
            border-radius: 50px;
            cursor: pointer;
            transition: ease-in 300ms;
            display: inline-block;
            padding: 13px;
            margin: 5px;
        }

        .btn:hover {
            background-color: #e6ade2;
            transform: scale(1.03);
            color: white;
            border: 1px solid white;
        }

        .carouselcontroller {
            background-color: #2c002c;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            color: #f7f7f7;
            padding: 1px;
        }

        .carouselcontroller p {
            text-align: center;
            margin: 4px;
            padding: 7px;
            border: 1px solid white;
            cursor: pointer;
        }

        .sections {
            background-color: rgba(247, 247, 247, 0.55);
            margin: 8% 3%;
            padding: 70px 35px 30px 35px;
            color: #2c002c;
        }

        .sectionheaders {
            font-family: 'Oswald', sans-serif;
            font-weight: 500;
            margin: 0;
            padding-bottom: 10px;
        }

        .subsect {
            color: #333333;
            font-family: 'Roboto', sans-serif;
            font-size: 75%;
            letter-spacing: 1px;
            line-height: 22px;
            display: flex;
            flex-flow: row wrap;
            justify-content: space-between;
        }

        #results {
            padding: 70px 35px 30px 35px;
        }

        #about {}

        .subsect li {
            padding: 5px;
            font-size: 120%;
            list-style: circle;
            margin: 0;
        }

        .subsect ul {
            margin: 0;
            padding: 5px;
        }

        .bord {
            border-top: 7px solid #e6ade2;
        }

        #services {}

        #gallery {}

        .grid-item-1 {
            grid-area: r1c1;
        }

        .grid-item-2 {
            grid-area: r1c2;
        }

        .grid-item-3 {
            grid-area: r1c3;
        }

        .grid-item-4 {
            grid-area: r1c4;
        }

        .grid-item-1 {
            grid-area: r2c1;
        }

        .grid-item-2 {
            grid-area: r2c2;
        }

        .grid-item-3 {
            grid-area: r2c3;
        }

        .grid-item-4 {
            grid-area: r2c4;
        }

        li {
            list-style: none !important;
        }

        .grid-container {
            display: grid;
            grid: 'r1c1 r1c2 r1c3 r1c4'
                'r2c1 r2c2 r2c3 r2c4';
            grid-template: auto;


        }

        .grid-container img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            margin: 0 !important;
            padding: 0 !important;
            transition: ease-in-out 300ms;
            transform: scale(0.95);
            border: 3px solid #2c002c;
        }

        .grid-container img:hover {
            transform: scale(1.03);
        }

        #gallcont {
            justify-content: space-between;
            margin: 0;
            padding: 0.5px;
        }

        #gallcont p {
            margin: 0;
            border-width: 2px;
            font-size: 100%;
        }

        #review {
            background-image: linear-gradient(290deg, rgba(98, 12, 76, 0.91), rgba(0, 0, 0, 0.65));

        }

        #revsubsect {
            display: flex;
            flex-flow: row nowrap;
        }

        #review h1 {
            color: #e0cedd;

        }

        .reviewbox {
            display: flex;
            flex-flow: column nowrap;
            justify-content: flex-start;
            background-color: rgba(247, 247, 247, 0.29);
            margin: 7px;
            padding: 10px;
            transition: ease-in-out 250ms;
        }

        .reviewbox:hover {
            cursor: pointer;
            transform: scale(1.03);
        }

        .reviewbox img {
            width: 100%;
            height: 20vh;
            margin-top: 3%;
            padding: 0;
            transition: ease-in-out 250ms;
        }

        .reviewtextbox {
            color: #f7f7f7;
            display: flex;
            flex-flow: column nowrap;
            justify-content: flex-start;
            margin: 2px;
            margin-left: 2px;
            padding: 15px 0;
        }

        .reviewtextbox h4 {
            margin: 0;
            font-size: 15px;
            text-align: center;
        }

        .grid-desg {
            font-weight: bold;
            color: #e6ade2;
            text-align: center;
            font-size: 12px;
        }

        .grid-comment {
            text-align: left;
            padding-top: 4%;
            text-align: center;
        }

        .leftreviewbox {
            margin: 0;
            padding: 0;
            line-height: 0;
        }

        .starcont {
            margin: 0;
            padding: 0;
            background-color: #2c002c;
            font-size: 15px;
            padding: 7px 3px;
            color: gold;
            text-align: center;
            transition: ease-in-out 250ms;
        }

        .fa-regular {
            color: rgba(118, 202, 230, 0.8);
        }

        .reviewbox:hover img {
            transform: scale(1.03);
        }

        .reviewbox:hover .starcont {
            transform: scale(1.03);
        }

        /*
.reviewbox {
animation: marquee 20s linear infinite;
}

@keyframes marquee {
0% {
transform: translateX(430%);
}

100% {
transform: translateX(-430%);
}

}*/


        #review {
            padding-bottom: 60px;
        }

        #footer {
            background-color: #2c002c;
            margin: 0;
            padding: 0;
        }

        #footbox {
            display: flex;
            flex-flow: row nowrap;
            justify-content: space-evenly;
            margin-bottom: 0;
            background-color: rgba(247, 247, 247, 0.05);

            padding: 3%;
            margin-left: 3.4%;
            margin-right: 3.4%;
        }

        #cntctus {
            margin: 0;
            width: 50%;
            margin-top: 20px;
            padding: 0 0 40px 35px;
        }

        #lctus {
            margin: 0;
            width: 50%;
        }

        .lefttext {
            padding: 14px 2px;
            color: #f7f7f7;
            line-height: 175%;
            font-weight: bold;
        }

        h3 {
            color: #e0cedd;
            margin: 0;
            font-size: 150%;
        }

        .lefttext i {
            color: #f7f7f7;
            font-size: 100%;
            font-weight: bold;
            padding-right: 6px;
        }

        .lefttext p {
            font-size: 95%;
        }

        .adrs {
            text-transform: uppercase;
            font-size: 102% !important;
            padding: 5px 0;
        }

        .smhlabel {
            padding-top: 15px;
            font-weight: 300;
            font-family: 'Pangolin', cursive;
            font-size: 90% !important;
        }

        #shandle {
            display: flex;
            flex-flow: row nowrap;
            padding: 9px 0;
        }

        #shandle i {
            font-size: 120%;
            padding: 0 12px 0 0;
            transition: ease-in-out 200ms;
            cursor: pointer;
        }

        #shandle i:hover {
            font-size: 140%;
            color: rgba(118, 202, 230, 0.8);
        }

        #lctus {
            padding: 0 0 40px 35px;
            border-left: 1px solid white;
            margin-top: 20px;
        }

        #map {
            width: 370px;
            height: 130px;
            margin-top: 10px;
        }

        #callrequest {
            margin-top: 5px;
            display: flex;
            flex-flow: column nowrap;
            justify-content: flex-start;
            width: 80%;
            text-align: center;
        }

        #callrequest button {
            width: 80%;
            text-align: center;
            display: inline-block;
            margin-top: 12px;
            border-radius: 3px !important;
            margin-left: 0;
            margin-right: 0;
        }

        #callrequest input {
            padding: 12px;
            font-size: 11px;
            margin-bottom: 5px;
            color: darkgray;
            border: 1px solid white;
            border-radius: 2px;
            outline: 3px solid #e6ade2;
            width: 100%;
        }

        .tbx:focus {
            outline: 3px solid lightblue;
        }

        #callrequest i {
            font-size: 70%;
            color: #2c002c;
        }

        /* Extra Small Devices (portrait phones) */
        @media only screen and (max-width: 576px) {

            .subsect {
                flex-wrap: wrap;
            }

            #footbox {
                flex-wrap: wrap-reverse;
            }



            #map {
                width: 120px;
                height: 240px;
            }

        }

        /* Small Devices (landscape phones) */
        @media only screen and (min-width: 576px) and (max-width: 768px) {

            /* CSS rules for small devices */
            .subsect {
                flex-wrap: wrap;
            }


            #footbox {
                flex-wrap: wrap-reverse;
            }

            #lctus {
                border-left: none;
            }

            #map {
                width: 213px;
                height: 97.5px;
            }


        }

        /* Medium Devices (tablets) */
        @media only screen and (min-width: 768px) and (max-width: 992px) {

            /* CSS rules for medium devices */
            .subsect {
                flex-wrap: nowrap;
            }



            #footbox {
                flex-wrap: nowrap;
            }

            #lctus {
                border-left: none;
            }


            #map {
                width: 285px;
                height: 100px;
            }


        }

        /* Large Devices (desktops) */
        @media only screen and (min-width: 992px) and (max-width: 1200px) {

            /* CSS rules for large devices */
            .subsect {
                flex-wrap: nowrap;
            }




            #footbox {
                flex-wrap: nowrap;
            }


            #lctus {
                border-left: none;
            }

            #map {
                width: 370px;
                height: 130px;
            }

            .reviewbox {
                flex-wrap: nowrap;
            }

        }


        /* Extra Large Devices (large desktops) */
        @media only screen and (min-width: 1200px) {

            /* CSS rules for extra large devices */
            .subsect {
                flex-wrap: nowrap;
            }


            #footbox {
                flex-wrap: nowrap;
            }



            #map {
                width: 400px;
                height: 150px;
            }

            .reviewbox {
                flex-wrap: wrap;
            }

        }

        @media only screen and (min-width:768px) {
            #Links {
                display: block;
            }
        }

        #conbars {
            display: flex;
            flex-flow: row wrap;
            justify-content: center;
        }

        .concards {
            background-color: rgba(240, 242, 246, 0.67);
            margin: 20px;
            display: flex;
            flex-flow: row nowrap;
            justify-content: center;
            line-height: 25px;
            padding: 10px 10px 5px 10px;
            box-shadow: rgba(0, 0, 0, 0.15) 0px 10px 30px 0;
            -webkit-transition: all ease-in-out 0.4s;
            transition: all ease-in-out 0.4s;
        }

        .concards data {
            display: flex;
            flex-flow: column nowrap;
            justify-content: flex-start;
        }

        .ima img {
            width: 24px;
            padding: 0;
            margin: 0;
            border: 4px solid #838383;
        }

        .data {
            margin-left: 10px;
        }

        .data p {
            padding: 0;
            margin: 0;
        }

        .desg {
            font-size: 18px;
            font-weight: 900;
            color: #e6ade2;
            padding: 0 0 5px 0 !important;
        }

        .text {
            font-size: 14px;
        }

        .con {
            font-size: 12px;
            font-weight: 700;
            color: #838383 !important;
            padding-top: 8px !important;
            cursor: pointer;
            -webkit-transition: all ease-in-out 0.4s;
            transition: all ease-in-out 0.4s;
        }

        .con a {
            color: #838383 !important;
        }

        .con a:hover {
            color: #e6ade2 !important;
        }

        .con i {
            padding-right: 5px;
        }

        .concards:hover {
            transform: scale(1.05);
        }

        #result_subsect {
            display: flex;
            justify-content: center;
        }

        a {
            text-decoration: none;
            color: #2c002c;
        }

    </style>
</head>

<body>
    <div id="Container">
        <div id="navBar">
            <div id="Logo">
                <p>ABC</p>
            </div>
            <div id="Links">
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="#aboutus">About Us</a></li>
                    <li><a href="#services">Our Services</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                    <li><a href="#results">Our Reviews</a></li>
                    <li><a href="#footer">Contact Us</a></li>
                    <li><a href="index.php"><i class="fa-solid fa-magnet"></i></a></li>
                </ul>
            </div>
        </div>
        <div id="noticebar">
            <i class="fa-regular fa-message fa-bounce"></i>
            <i class="fa-solid fa-radio"></i>
            <i class="fa-solid fa-handshake-simple"></i>
            <i class="fa-solid fa-street-view fa-flip"></i>
        </div>
        <div id="carousel">
            <div id="carouselcont">
                <div id="matt">
                    <h1>BOOK YOUR SEAT</h1>
                    <button class="btn"><a href="#footer">CONTACT NOW</a></button>
                </div>
            </div>
        </div>
        <div class="carouselcontroller">
            <p>Ariel Bank Corporation</p>
        </div>
        <div class="sections" id="aboutus">
            <h1 class="sectionheaders"><span class="bord">Ab</span>out Us</h1>
            <div class="subsect" id="about">
                <p>Welcome to TSH, The Solution House. We are a school that believes in providing a nurturing and inclusive learning environment for all our students. At TSH, our dedicated team of educators is committed to fostering academic excellence and personal growth. With state-of-the-art facilities and innovative teaching methodologies, we strive to deliver a world-class education. At the heart of TSH is our belief in holistic development, nurturing both the mind and the character of our students.We offer a comprehensive curriculum that empowers students to explore their passions and reach their full potential. TSH promotes a culture of creativity, critical thinking, and problem-solving, preparing students for the challenges of the future. We prioritize the individual needs of each student, providing personalized attention and support to foster their unique talents. Our diverse and inclusive community encourages respect, empathy, and collaboration among students, teachers, and parents.
                    <br><br>
                    Welcome to TSH, The Solution House. We are a school that believes in providing a nurturing and inclusive learning environment for all our students. At TSH, our dedicated team of educators is committed to fostering academic excellence and personal growth. With state-of-the-art facilities and innovative teaching methodologies, we strive to deliver a world-class education. At the heart of TSH is our belief in holistic development, nurturing both the mind and the character of our students.We offer a comprehensive curriculum that empowers students to explore their passions and reach their full potential. TSH promotes a culture of creativity, critical thinking, and problem-solving, preparing students for the challenges of the future. We prioritize the individual needs of each student, providing personalized attention and support to foster their unique talents. Our diverse and inclusive community encourages respect, empathy, and collaboration among students, teachers, and parents.nurturing both the mind and the character of our students.We offer a comprehensive curriculum that empowers students to explore their passions and reach their full potential. TSH promotes a culture of creativity, critical thinking, and problem-solving, preparing students for the challenges of the future. We prioritize the individual needs of each student, providing personalized attention and support to foster their unique talents.
                </p>
            </div>
        </div>
        <div class="sections" id="services">
            <h1 class="sectionheaders"><span class="bord">Ou</span>r Facilities</h1>
            <div class="subsect" id="servic">
                <ul>
                    <li>Modern classrooms with teaching.</li>
                    <li>Well-stocked library.</li>
                    <li>Science laboratories.</li>
                    <li>Sports facilities.</li>
                    <li>Computer labs.</li>
                    <li>Cafeteria.</li>
                    <li>Auditorium/assembly hall.</li>
                    <li>Art/music studios.</li>
                </ul>
                <ul>
                    <li>Science laboratories.</li>
                    <li>Sports facilities.</li>
                    <li>Auditorium/assembly hall.</li>
                    <li>Computer labs.</li>
                    <li>Modern classrooms with teaching.</li>
                    <li>Well-stocked library.</li>
                    <li>Cafeteria.</li>
                    <li>Art/music studios.</li>
                </ul>
                <ul>

                    <li>Well-stocked library.</li>
                    <li>Science laboratories.</li>
                    <li>Cafeteria.</li>
                    <li>Modern classrooms with teaching.</li>
                    <li>Auditorium/assembly hall.</li>
                    <li>Art/music studios.</li>
                    <li>Sports facilities.</li>
                    <li>Computer labs.</li>
                </ul>
            </div>
        </div>
        <div class="sections" id="gallery">
            <h1 class="sectionheaders"><span class="bord">G</span>allery</h1>
            <div class="grid-container">
                <div class="grid-item-1 grid-img"><img src="Images/s9.jpg" id="i1" /></div>
                <div class="grid-item-2 grid-img"><img src="Images/s10.jpg" id="i2" /></div>
                <div class="grid-item-3 grid-img"><img src="Images/s11.jpg" id="i3" /></div>
                <div class="grid-item-4 grid-img"><img src="Images/s12.jpg" id="i4" /></div>
                <div class="grid-item-5 grid-img"><img src="Images/s13.jpg" id="i5" /></div>
                <div class="grid-item-6 grid-img"><img src="Images/s14.jpg" id="i6" /></div>
                <div class="grid-item-7 grid-img"><img src="Images/s15.jpg" id="i7" /></div>
                <div class="grid-item-8 grid-img"><img src="Images/s16.jpg" id="i8" /></div>
            </div>
            <div class="carouselcontroller" id="gallcont">
                <p id="pre">&lt; Previous</p>
                <p id="nxt">Next &gt;</p>
            </div>
        </div>




        <div class="sections" id="results">
            <h1 class="sectionheaders"><span class="bord">Ou</span>r Faculties</h1>
            <div class="subsect" id="result_subsect">
                <marquee>
                    <div id="conbars">
                        <div class="concards">
                            <div class="ima"><img src="Images/s2.png.jpg"></div>
                            <div class="data">
                                <p class="desg">Organising Chair</p>
                                <p class="text">Dr. K John Singh</p>
                                <p class="text">Professor</p>
                                <p class="text">JEE, TSH</p>
                                <p class="con"><i class="fa-solid fa-envelope"></i><a href="mailto:johnsingh.k@tsh.in">johnsingh.k@tsh.in</a></p>
                                <p class="con"><i class="fa-solid fa-phone"></i><a href="tel:+91 9442451035">+91 9442451035</a></p>
                            </div>
                        </div>
                        <div class="concards">
                            <div class="ima"><img src="Images/s4.png.jpg"></div>
                            <div class="data">
                                <p class="desg">Organising Secretary</p>
                                <p class="text">Dr. P.G. Shynu</p>
                                <p class="text">Associate Professor</p>
                                <p class="text">JEE, TSH</p>
                                <p class="con"><i class="fa-solid fa-envelope"></i><a href="mailto:pgshynu@tsh.in">pgshynu@tsh.in</a></p>
                                <p class="con"><i class="fa-solid fa-phone"></i><a href="tel:+91 9840800396"> +91 9840800396</a></p>
                            </div>
                        </div>
                        <div class="concards">
                            <div class="ima"><img src="Images/s8.png.jpg"></div>
                            <div class="data">
                                <p class="desg">Publication Chair</p>
                                <p class="text">Dr. Vijayan R.</p>
                                <p class="text">Associate Professor</p>
                                <p class="text">JEE, TSH</p>
                                <p class="con"><i class="fa-solid fa-envelope"></i><a href="mailto:rvijayan@tsh.in">rvijayan@tsh.in</a></p>
                                <p class="con"><i class="fa-solid fa-phone"></i><a href="tel:+91 9842350596"> +91 9842350596</a></p>
                            </div>
                        </div>

                        <div class="concards">
                            <div class="ima"><img src="Images/s8.png.jpg"></div>
                            <div class="data">
                                <p class="desg">Publication Chair</p>
                                <p class="text">Dr. Vijayan R.</p>
                                <p class="text">Associate Professor</p>
                                <p class="text">JEE, TSH</p>
                                <p class="con"><i class="fa-solid fa-envelope"></i><a href="mailto:rvijayan@tsh.in">rvijayan@tsh.in</a></p>
                                <p class="con"><i class="fa-solid fa-phone"></i><a href="tel:+91 9842350596"> +91 9842350596</a></p>
                            </div>
                        </div>
                        <div class="concards">
                            <div class="ima"><img src="Images/s8.png.jpg"></div>
                            <div class="data">
                                <p class="desg">Publication Chair</p>
                                <p class="text">Dr. Vijayan R.</p>
                                <p class="text">Associate Professor</p>
                                <p class="text">JEE, TSH</p>
                                <p class="con"><i class="fa-solid fa-envelope"></i><a href="mailto:rvijayan@tsh.in">rvijayan@tsh.in</a></p>
                                <p class="con"><i class="fa-solid fa-phone"></i><a href="tel:+91 9842350596"> +91 9842350596</a></p>
                            </div>
                        </div>
                        <div class="concards">
                            <div class="ima"><img src="Images/s8.png.jpg"></div>
                            <div class="data">
                                <p class="desg">Publication Chair</p>
                                <p class="text">Dr. Vijayan R.</p>
                                <p class="text">Associate Professor</p>
                                <p class="text">JEE, TSH</p>
                                <p class="con"><i class="fa-solid fa-envelope"></i><a href="mailto:rvijayan@tsh.in">rvijayan@tsh.in</a></p>
                                <p class="con"><i class="fa-solid fa-phone"></i><a href="tel:+91 9842350596"> +91 9842350596</a></p>
                            </div>
                        </div>
                    </div>
                </marquee>
            </div>
        </div>

        <div id="footer">
            <div id="footbox">
                <div id="cntctus">
                    <h3><span class="bord">C</span>ONTACT US</h3>
                    <div class="lefttext">
                        <p class="adrs"><i class="fa-regular fa-envelope"></i>Address</p>
                        <p>34, Green Park<br>
                            Mumbai, Maharashtra<br>
                            India<br>
                            PIN Code: 400001</p>
                        <p class="smhlabel">Our Social Media Handles</p>
                        <div id="shandle">
                            <i class="fa-brands fa-facebook"></i>
                            <i class="fa-brands fa-twitter"></i>
                            <i class="fa-brands fa-instagram"></i>
                            <i class="fa-brands fa-snapchat"></i>
                            <i class="fa-brands fa-github"></i>
                        </div>
                    </div>
                </div>
                <div id="lctus">
                    <h3><span class="bord">L</span>OCATE US</h3>
                    <div id="map"></div>
                    <div class="lefttext">
                        <p class="smhlabel">Want A Call Back ?</p>
                        <div id="callrequest">
                            <form action="main.php" method="post">
                                <input class="tbx" type="tel" placeholder="Your Phone Number" name="cd" autocomplete="off" />
                                <button class="btn" type="submit"><i class="fa-solid fa-phone fa-shake"></i> CALL ME</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/5154870677.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        document.getElementById("carousel").focus();
        try {
            window.addEventListener('keydown', function(event) {
                if (event.key === 'Tab') {
                    event.preventDefault(); // Prevent default tab behavior
                }
            });

            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: 19.0760,
                        lng: 72.8777
                    },
                    zoom: 10
                });

                var marker = new google.maps.Marker({
                    position: {
                        lat: 19.0760,
                        lng: 72.8777
                    },
                    map: map,
                    title: 'Random Location'
                });

                var infoWindow = new google.maps.InfoWindow({
                    content: '<h3 style="color:#2c002c">Latitude: 19.0760<br>Longitude: 72.8777</h3>'
                });

                marker.addListener('click', function() {
                    infoWindow.open(map, marker);
                });
            }

            initMap();
        } catch {

        }


        var galstate = 1;
        var i1 = document.getElementById('i1');
        var i2 = document.getElementById('i2');
        var i3 = document.getElementById('i3');
        var i4 = document.getElementById('i4');
        var i5 = document.getElementById('i5');
        var i6 = document.getElementById('i6');
        var i7 = document.getElementById('i7');
        var i8 = document.getElementById('i8');

        function state1() {
            i1.src = "Images/s9.jpg";
            i2.src = "Images/s10.jpg";
            i3.src = "Images/s11.jpg";
            i4.src = "Images/s12.jpg";
            i5.src = "Images/s13.jpg";
            i6.src = "Images/s14.jpg";
            i7.src = "Images/s15.jpg";
            i8.src = "Images/s16.jpg";
        }

        function state2() {
            i1.src = "Images/s18.jpg";
            i2.src = "Images/s23.jpg";
            i3.src = "Images/s20.jpg";
            i4.src = "Images/s21.jpg";
            i5.src = "Images/s17.jpg";
            i6.src = "Images/s24.jpg";
            i7.src = "Images/s19.jpg";
            i8.src = "Images/s22.jpg";
        }


        function state3() {
            i1.src = "Images/s25.jpg";
            i2.src = "Images/s26.jpg";
            i3.src = "Images/s27.jpg";
            i4.src = "Images/s18.jpg";
            i5.src = "Images/s29.jpg";
            i6.src = "Images/s30.jpg";
            i7.src = "Images/s19.jpg";
            i8.src = "Images/s32.jpg";
        }

        document.getElementById('nxt').addEventListener("click", function() {
            if (galstate == 1) {
                state2();
                galstate = 2;
            } else if (galstate == 3) {
                state1();
                galstate = 1;
            } else {
                state3();
                galstate = 3;
            }
        });

        document.getElementById('pre').addEventListener("click", function() {
            if (galstate == 1) {
                state3();
                galstate = 3;
            } else if (galstate == 3) {
                state2();
                galstate = 2;
            } else {
                state1();
                galstate = 1;
            }
        });

        function stateN() {
            state1();
            setTimeout(state2, 5000);
            setTimeout(state3, 10000);
        }

        stateN();
        setInterval(stateN, 15000);

    </script>

</body>

</html>
