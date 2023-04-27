<?php
echo "<h5>
<center>Loing Admin</center></h5>";
session_start();
include_once "./db/User.php";
$errors1 = '';
$errors2 = '';
$errors3 = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    if (!$userName && !$password) {
        $errors3 = 'You must enter the username and password';
    } elseif (!$userName){
        $errors1 = 'You must enter the username ';
    }elseif (!$password && $userName){
        $errors2 = 'You must enter the password ';
    } else {
        $user = new User;
        $notFound = $user->select(' *','admin')->where('User_Name','=',"$userName")->andWhere('Password','=',"$password")->print();
        if (count($notFound)===0) {
            # code...
            $errors3 = 'the user is not found';
        }else{
            
            $_SESSION['login'] = $userName;
            sleep(1);
            header("Location: /E-Commerce/dashbourd.php");
            exit;
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
    <title>MMA || Admin Sign In & Sign Up</title>
    <link rel="shortcut icon"
        href="https://yt3.ggpht.com/K8-YocA-7arl_4uKY_3LP8S3hj4LgTMRwGit9yIPCdfW-fDPGNyCh3XrucxXbTMq9lE20DMJqg=s600-c-k-c0x00ffffff-no-rj-rp-mo"
        type="image/x-icon">
    <!-- Get Bottstrap {css & js} -->
    <link rel="stylesheet" href="./Front-End/assets/bottstrap/css/bootstrap.min.css">
    <link rel="js" href="./Front-End/assets/bottstrap/js/bootstrap.min.js">
    <!-- Get Taliwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Get FontAwesome -->
    <link rel="stylesheet" href="./Front-End/assets/fontawesome-free-6.1.1-web/all.min.js">
</head>

<body>
    <main class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="signIn border p-5 rounded-lg col-12 col-sm-6 col-md-4">
            <img class="w-20 mx-auto" src="./Front-End/Images/vector-login.jpg" alt="avatar">
            <form action="./admin.php" method="post" enctype="multipart/form-data">
                <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors3&&"px-3 py-2" ?> rounded-lg px-3">
                    <?=$errors3?></h6>
                <div class="d-flex flex-column ">
                    <label for="userName">User Name:</label>
                    <input type="text" value="<?php if(isset($_POST['userName'])){
                        echo $_POST['userName'];
                    } elseif(isset($_GET['u'])){
                        echo $_GET['u'];
                    }?>" class="border rounded px-2 py-1" name="userName" id="userName">
                </div>
                <h5 class="text-white bg-red-400 text-center mt-2 <?php $errors1&&"px-3 py-2" ?> rounded-lg px-3">
                    <?=$errors1?></h5>
                <div class="d-flex flex-column ">
                    <label for="password">Password:</label>
                    <input type="password" value="<?php if(isset($_POST['password'])){
                        echo $_POST['password'];
                    }?>" class="border rounded px-2 py-1" name="password" id="password">
                    <h5 class="text-white bg-red-400 text-center mt-2 <?php $errors2&&"px-3 py-2" ?> rounded-lg px-3">
                        <?=$errors2?></h5>
                </div>
                <div class="text-center"> <button type="submit"
                        class="rounded-full text-center bg-green-200 hover:bg-green-400  hover:text-white  px-5 py-1 my-2 mx-auto ">Login</button>
                </div>
            </form>
            <div class="text-center">
                <a href="./create-admin.php" class="link underline my-1">Create Accont</a>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 text-center">
            <img class="w-96" src="./Front-End/Images/login-side.webp" alt="Create-Accont">
        </div>
    </main>
</body>

</html>
