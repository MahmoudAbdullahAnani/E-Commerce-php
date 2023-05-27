<?php

if (isset($_SESSION['login'])) {
            sleep(1);
            header("Location: /E-Commerce/home.php");
            exit;
}

include_once "./db/User.php";
date_default_timezone_set('Africa/Cairo');
$successfully= false;
$errors1 ='';
$errors2 ='';
$errors3 ='';
$errors4 ='';
$errors5 ='';
$errors6 ='';
$errors7 ='';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['fullName'];
    $age = $_POST['age'];
    $date = $_POST['date'];
    $password = $_POST['password'];
    $userName = $_POST['userName'];
    $gmail = $_POST['gmail'];
    if (!$fullName && !$age && !$date && !$userName && !$password) {
        $errors1 = 'Data must be filled';
    }elseif(!$fullName ){
        $errors2 ='You must type full name';
    }elseif(!$age ){
        $errors3 ='Age must be entered';
    }elseif(!$date ){
        $errors4 ='You must enter a date of birth';
    }elseif(!$gmail ){
        $errors4 ='You must enter an email';
    }elseif(!$userName ){
        $errors5 ='You must enter a username';
    }elseif(!$password ){
        $errors6 ='You must enter a password';
    } elseif(strlen($password)<3 ){
        $errors6 ='The password is weak';
    } else {
        $user = new User;
        $notFound = $user->select(' *','user')->where('User_Name','=',"$userName")->andWhere('Password','=',"$password")->print();
        if (count($notFound)===0) { 
            # code...
            $dateCreate = date("Y/m/d  h:i:sa");
            $user->insert('user',$fullName,$age,$date,$password,$dateCreate,$userName,$gmail);
            $successfully = 'Account successfully created';
            sleep(2);
            header("location: /E-Commerce/?u=$userName");
            exit;
            $_POST['age']='';
            $_POST['date']='';
            $_POST['password']='';
            $_POST['userName']='';
        }else{
            $errors1 = 'This user already exists';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MMA || Sign In & Sign Up</title>
    <link rel="shortcut icon"
        href="https://yt3.ggpht.com/K8-YocA-7arl_4uKY_3LP8S3hj4LgTMRwGit9yIPCdfW-fDPGNyCh3XrucxXbTMq9lE20DMJqg=s600-c-k-c0x00ffffff-no-rj-rp-mo"
        type="image/x-icon">
    <!-- Get Bottstrap {css & js} -->
    <link rel="stylesheet" href="./Front-End/assets/bottstrap/css/bootstrap.min.css">
    <link rel="js" href="./Front-End/assets/bottstrap/js/bootstrap.min.js">
    <!-- Get Taliwind -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script src="./Front-End/assets/Tailwindcss/tailwindcss.min.js"></script>
    <!-- Get FontAwesome -->
    <link rel="stylesheet" href="./Front-End/assets/fontawesome-free-6.1.1-web/all.min.js">
</head>

<body>
    <main class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class=" border p-5 rounded-lg col-12 col-sm-6 col-md-4">
            <img class="w-20 mx-auto" src="./Front-End/Images/signUp-accont.jpg" alt="avatar">
            <form action="./signUp.php" method="post" enctype="multipart/form-data">
                <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors1&&"px-3 py-2" ?> rounded-lg px-3">
                    <?=$errors1?></h6>
                <div class="d-flex flex-column ">
                    <label for="fullName">Full Name:</label>
                    <input type="text" value="<?php if(isset($_POST['fullName'])){
                        echo $_POST['fullName'];
                    }?>" class="border rounded px-2 py-1" name="fullName" id="fullName">
                    <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors2&&"px-3 py-2" ?> rounded-lg px-3">
                        <?=$errors2?></h6>
                </div>
                <div class="d-flex flex-column ">
                    <label for="age">Age:</label>
                    <input type="number" value="<?php if(isset($_POST['age'])){
                        echo $_POST['age'];
                    }?>" class="border rounded px-2 py-1" name="age" id="age">
                    <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors3&&"px-3 py-2" ?> rounded-lg px-3">
                        <?=$errors3?></h6>
                </div>
                <div class="d-flex flex-column ">
                    <label for="date">Date:</label>
                    <input type="date" value="<?php if(isset($_POST['date'])){
                        echo $_POST['date'];
                    }?>" class="border rounded px-2 py-1" name="date" id="date">
                    <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors4&&"px-3 py-2" ?> rounded-lg px-3">
                        <?=$errors4?></h6>
                </div>
                <div class="d-flex flex-column ">
                    <label for="gmail">Gmail:</label>
                    <input type="gmail" value="<?php if(isset($_POST['gmail'])){
                        echo $_POST['gmail'];
                    }?>" class="border rounded px-2 py-1" name="gmail" id="gmail">
                    <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors7&&"px-3 py-2" ?> rounded-lg px-3">
                        <?=$errors7?></h6>
                </div>
                <div class="d-flex flex-column ">
                    <label for="userName">User Name:</label>
                    <input type="text" value="<?php if(isset($_POST['userName'])){
                        echo $_POST['userName'];
                    }?>" class="border rounded px-2 py-1" name="userName" id="userName">
                    <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors5&&"px-3 py-2" ?> rounded-lg px-3">
                        <?=$errors5?></h6>
                </div>
                <div class="d-flex flex-column ">
                    <label for="password">Password:</label>
                    <input type="password" value="<?php if(isset($_POST['password'])){
                        echo $_POST['password'];
                    }?>" class="border rounded px-2 py-1" name="password" id="password">
                    <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors6&&"px-3 py-2" ?> rounded-lg px-3">
                        <?=$errors6?></h6>
                </div>
                <div class="text-center"> <button type="submit"
                        class="rounded-full text-center bg-green-300 hover:bg-green-400  hover:text-white  px-5 py-1 my-2 mx-auto ">Create
                        Accont</button>
                </div>
            </form>
            <div class="text-center">
                <a href="./index.php" class="link underline my-1">Login</a>
            </div>
        </div>
        <div class=" col-sm-6 col-md-4 text-center">
            <img class="w-96 mx-auto" src="./Front-End/Images/signUp.webp" alt="Create-Accont">
        </div>
    </main>
</body>

</html>
