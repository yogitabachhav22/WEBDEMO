<?php

require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {


    //Check if username is empty

    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank"; 

    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn,$sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s",$param_username);


            //Set the value of param username

            $param_username = trim($_POST['username']);

            //Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) ==1)
                {
                    $username_err = "This user is already taken";

                }
                else{
                    $username = trim($_POST['username']);

                }
            }
                else{
                    echo "something went wrong";
                }
            }
        }
    

        mysqli_stmt_close($stmt);
    
    
//Check for password

if(empty(trim($_POST['password']))){
$password_err = "password cannot be blank";
}

elseif(strlen(trim($_POST['PASSWORD'])) < 5){
    $password_err = "Password cannot be less than 5 character";

}
else{
    $password = trim($_POST['password']);
}
// Check for confirm password field
if(trim($_POST['password']) != trim ($_POST['confirm_password'])){
    $password_err = "Password should match";

}


//if there are no errors, go ahead and insert into database
 if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
    $sql = "INSERT INTO users(username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
        //Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
    

    //Try to execute the query
    if(mysqli_stmt_execute($stmt))
    {
        header("location: login.php");

    }
    else{
        echo "Something went wrong cannot redirect!";
    }
}
mysqli_stmt_close($stmt);
}

mysqli_close($conn);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rainbow Waves Preschool</title>

    <!-- google font CDN link-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,500;0,600;1,300&display=swap" rel="stylesheet">

    <!--Font Awesome CDN link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <!--Costume css file Link-->
    <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <!-- header section start here-->

        <header>

            <div id="menu" class="fas fa-bars"></div>
            <div id="logo">
            <a href="#" class="logo"><i class="fas fa-user-graduate"></i>Rainbow waves</a><!-- LOGO --> 
            <img src="rw.jpg" alt="">
            </div>
            <nav class="navbar">
                <ul>
                    <li><a class="active" href="#home">home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#course">Classes</a></li>
                    <li><a href="#teacher">Teacher</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>

            <div id="login" class="fas fa-user-circle"></div>
        </header>

        <!-- header section ends here--> 

        <!--login form-->

        <div class="login-form">
            
        <form class="contact-form" action="contactform.php" method="post">
            <h3>login</h3>
            <input type="email" placeholder="username" class="box">
            <input type="password" placeholder="password" class="box">
            <p>forgot password?<a href="#">click here</a></p>
            <p>don't have an account?<a href="registration.php">register now</a></p>
            <input type="submit" class="btn" value="login">
            <i class="fas fa-times"></i>
        </form>

</div>

<!-- home section starts-->
<section class="home" id="home">

    <h1>Rainbow Waves Preschool</h1>
    <h2>Spreading Colors of Happiness</h2>
    <P> Sint asperiores voluptatibus consequatur et repudiandae amet sed inventore iste enim aliquid praesentium minima at culpa sit, porro non quaerat quia odio?</P>
    <a href="#"><button class="btn">get started</button></a>

    <div class="shape"> </div>
</section>

<!--about section start-->


<section class="about" id="about">

    <div class="image">
         <img src="boy.jpg" alt="">
    </div>

<div class="content">
    <h3>why choose us?</h3>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore quidem cumque enim. Sunt, architecto impedit tempora modi totam expedita maxime ratione laborum obcaecati. Dolor nam hic pariatur quam, nulla ullam?</p>
    
    <a href="#"><button class="btn">learn more</button></a>
</div>
</section>

<!--about section ends-->

<!--course section starts-->

<section class="course" id="course">

<h1 class="heading">Classes</h1>

<div class="box-container">

    <div class="box">
        <img src="bg.jpg" alt="">
        <h3 class="price">£50</h3>
        <div class="content">
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half"></i>
        </div>
        <a href="#" class="title">learn PlaySchool</a>

        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente itaque quaerat aut deserunt quod ratione, quasi quis possimus minima sint quae molestias obcaecati ex enim id explicabo labore eveniet quia.</p>
        <div class="info">
            <h3><i class="far fa-clock"></i>2 hours</h3>
            <h3><i class="far fa-calendar-alt"></i>6 months</h3>
            <h3><i class="fas fa-book"></i>12 modules</h3>
        </div>
    </div>
</div>



<div class="box">
    <img src="bg.jpg" alt="">
    <h3 class="price">£50</h3>
    <div class="content">
    <div class="stars">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star-half"></i>
    </div>
    <a href="#" class="title">Learn Nursery</a>

    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente itaque quaerat aut deserunt quod ratione, quasi quis possimus minima sint quae molestias obcaecati ex enim id explicabo labore eveniet quia.</p>
    <div class="info">
        <h3><i class="far fa-clock"></i>2 hours</h3>
        <h3><i class="far fa-calendar-alt"></i>6 months</h3>
        <h3><i class="fas fa-book"></i>12 modules</h3>
    </div>
</div>
</div>

<div class="box">
    <img src="bg.jpg" alt="">
    <h3 class="price">£50</h3>
    <div class="content">
    <div class="stars">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star-half"></i>
    </div>
    <a href="#" class="title">Learn Junior Kinder Garten</a>

    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente itaque quaerat aut deserunt quod ratione, quasi quis possimus minima sint quae molestias obcaecati ex enim id explicabo labore eveniet quia.</p>
    <div class="info">
        <h3><i class="far fa-clock"></i>2 hours</h3>
        <h3><i class="far fa-calendar-alt"></i>6 months</h3>
        <h3><i class="fas fa-book"></i>12 modules</h3>
    </div>
  </div>
</div>

<div class="box">
    <img src="bg.jpg" alt="">
    <h3 class="price">£50</h3>
    <div class="content">
    <div class="stars">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star-half"></i>
    </div>
    <a href="#" class="title">Learn Senior Kinder Garten</a>

    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente itaque quaerat aut deserunt quod ratione, quasi quis possimus minima sint quae molestias obcaecati ex enim id explicabo labore eveniet quia.</p>
    <div class="info">
        <h3><i class="far fa-clock"></i>2 hours</h3>
        <h3><i class="far fa-calendar-alt"></i>6 months</h3>
        <h3><i class="fas fa-book"></i>12 modules</h3>
      </div>
    </div>
  </div>
    



</div>
</section>
<!--course section ends-->


<!--teacher section starts-->

<section class="teacher" id="teacher">
    <h1 class="heading">Our expert teachers</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae eum explicabo hic placeat dolorum eos qui. Error commodi, id, voluptas adipisci reprehenderit architecto expedita animi odio similique ratione dolorum delectus?</p>

    <a href="#"><button class="btn">Learn more</button></a>
</section>

<!--teacher section ends-->

<!-- contact section starts-->
<section class="contact" id="contact">

<h1 class="heading">contact us</h1>

<div class="row">
    <form action="">
        <input type="text" placeholder="full name" class="box">
        <input type="email" placeholder="your email" class="box">
        <input type="password" placeholder="your password" class="box">
        <input type="number" placeholder="your number" class="box">
        <textarea name="" id="" cols="30" rows="10" class="box address" placeholder="your address"></textarea>
        <input type="submit" class="btn" value="send now">
    </form>

    <div class="image">
        <img src="girl.jpg" alt="">
    </div>
</div>
</section>
<!--contact section ends -->

<!--footer section starts-->
<div class="footer">
<div class="box-container">

    <div class="box">
        <h3>branch locations</h3>
        <a href="#">India</a>
    <!--<a href="#">USA</a>       -->

    </div>

    <div class="box">
        <h3>quick links</h3>
        <a href="#">home</a>
        <a href="#">about</a>
        <a href="#">course</a>
        <a href="#">teachers</a>
        <a href="#">contact</a>
    </div>
    <div class="box">
        <h3>contact info</h3>
        <p><i class="fas fa-map-market-alt"></i>Nashik,422101</p>
        <p><i class="fas fa-envelope"></i>hemantsalve@gmail.com</p>
        <p><i class="fas fa-phone">+91 9309927907</i></p>
        <p><i class="fas fa-phone">+91 8275787907</i></p>
    </div>
    </div>
<h1 class="credit">created by <a href="ybwebsite.com">Yogita</a>|all rights reserved.</h1>

</div>
</div>
<!--footer section ends-->



    <!--jquery cdn link-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- custom js file link  -->
    <script src="script.js"></script>
    </body>

</html>

