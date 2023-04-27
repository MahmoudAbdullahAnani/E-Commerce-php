<?php
session_start();

include_once "./db/User.php";
$user = new User;
$account = $user->select(' *','user')->where("User_Name",'=',"$_SESSION[login]")->print();
$data = $account[0];
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
            $_POST['age']='';
            $_POST['date']='';
            $_POST['password']='';
            $_POST['userName']='';
            $user->updateUser('user',$fullName,$age,$date,$gmail,$userName,$password,$data['Id']);
            header("Location: /E-Commerce/account-settings.php");
            exit;
    }
}
include_once "./Front-End/Navbare.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Front-End/assets/Galry-css/style.css">
    <title>MMA || Account Control</title>
</head>

<body>

    <div class="flex justify-center align-items-center bg-slate-200 py-32 rounded-lg px-2">
        <img class="rounded-full"
            src="data:image/jpeg;base64,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"
            alt="Avatar">
    </div>
    <h1 class="text-center fs-1 my-2"><?=ucwords($data['Full_Name'],' ')?></h1>
    <div class="flex justify-center w-100">
        <form class="col-6" action="./account-settings-control.php" method="post" enctype="multipart/form-data">
            <div class="d-flex flex-column ">
                <label for="fullName">Full Name:</label>
                <input type="text" value="<?=$data['Full_Name']?>" class="border rounded px-2 py-1" name="fullName"
                    id="fullName">
            </div>
            <div class="d-flex flex-column ">
                <label for="age">Age:</label>
                <input type="number" value="<?=$data['Age']?>" class="border rounded px-2 py-1" name="age" id="age">
            </div>
            <div class="d-flex flex-column ">
                <label for="date">Date:</label>
                <input type="date" value="<?=$data['Date']?>" class="border rounded px-2 py-1" name="date" id="date">
            </div>
            <div class="d-flex flex-column ">
                <label for="gmail">Gmail:</label>
                <input type="gmail" value="<?=$data['gmail']?>" class="border rounded px-2 py-1" name="gmail"
                    id="gmail">
            </div>
            <div class="d-flex flex-column ">
                <label for="userName">User Name:</label>
                <input type="text" value="<?=$data['User_Name']?>" class="border rounded px-2 py-1" name="userName"
                    id="userName">
            </div>
            <div class="d-flex flex-column ">
                <label for="password">Password:</label>
                <input type="password" value="<?=$data['Password']?>" class="border rounded px-2 py-1" name="password"
                    id="password">
            </div>
            <div class="text-center my-3"> <button type="submit"
                    class="rounded-full text-center bg-green-300 hover:bg-green-400  hover:text-white  px-5 py-1 my-2 mx-auto ">Update
                    Data</button>
            </div>
        </form>
    </div>
</body>

</html>
<?php include_once "./Front-End/Footer.php"; ?>
