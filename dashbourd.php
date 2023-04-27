<?php
// include "./Front-End/Navbare.php";
include_once "./db/User.php";
$user = new User;
$data = $user->select(' *','product')->print();
// $user->select(' *','product')->print()

include_once "./db/User.php";
$errors1 = '';
$errors2 = '';
$errors3 = '';
$errors4 = '';
$errors5 = '';
$errors6 = '';
if (isset($_GET['delete'])) {
    $user->delete($_GET['delete']);
    unlink("./db/Images/$_GET[photo]");
                sleep(1);
            header("location: /E-Commerce/dashbourd.php");
            exit;
}



if($_SERVER['REQUEST_METHOD']==='POST'){
    $title = $_POST['titleProduct'];
    $price = $_POST['priceProduct'];
    $description = $_POST['descriptionProduct'];
    $photoFile = $_FILES['photoFileProduct'];
    $discount = $_POST['discountProduct'];
    if (!$title) {
        $errors1 = 'Product name is required';
    } elseif (!$price){
        $errors2 = 'You must enter a price for the product';
    } elseif (!$description){
        $errors3 = 'You must enter a description for the product';
    }elseif ($photoFile['size']===0){
        $errors4 = 'You must choose a picture of the product';
    }elseif ($discount == ''){
        $errors5 = 'You must enter discount for the product';
    } else{
        $user = new User;
        $notFound = $user->select(' *','product')->where('title','=',"$title")->orWhere('description','=',"$description")->print();
        // print_r($notFound)  ;
        if (count($notFound)===0) { 
            move_uploaded_file($photoFile['tmp_name'],"./db/Images/".$photoFile['name']);
            $_POST['titleProduct']='';
            $_POST['priceProduct']='';
            $_POST['descriptionProduct']='';
            $_POST['discountProduct']='';
            $user->insertProduct('product', $title, $price, $photoFile['name'],$photoFile['size'],$photoFile['full_path'],$photoFile['tmp_name'], $discount, $description);
            sleep(1);
            header("location: /E-Commerce/dashbourd.php");
            exit;
        }else{
            $errors6 = 'This user already exists';
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
    <title>MMA || dashbourd</title>
    <link rel="shortcut icon"
        href="https://yt3.ggpht.com/K8-YocA-7arl_4uKY_3LP8S3hj4LgTMRwGit9yIPCdfW-fDPGNyCh3XrucxXbTMq9lE20DMJqg=s600-c-k-c0x00ffffff-no-rj-rp-mo"
        type="image/x-icon">
    <!-- Get Bottstrap {css & js} -->
    <link rel="stylesheet" href="./Front-End/assets/bottstrap/css/bootstrap.min.css">
    <link rel="js" href="./Front-End/assets/bottstrap/js/bootstrap.min.js">
    <!-- Get Taliwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    clifford: '#da373d',
                }
            }
        }
    }
    </script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <!-- Get FontAwesome -->
    <link rel="stylesheet" href="./Front-End/assets/fontawesome-free-6.1.1-web/all.min.js">
</head>

<body>
    <nav class="bg-gray-800 fixed w-100 z-20">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button type="button"
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <img class="block h-8 w-auto rounded-full lg:hidden"
                            src="https://yt3.ggpht.com/K8-YocA-7arl_4uKY_3LP8S3hj4LgTMRwGit9yIPCdfW-fDPGNyCh3XrucxXbTMq9lE20DMJqg=s600-c-k-c0x00ffffff-no-rj-rp-mo"
                            alt="Your Company">
                        <img class="hidden h-8 rounded-full w-auto lg:block"
                            src="https://yt3.ggpht.com/K8-YocA-7arl_4uKY_3LP8S3hj4LgTMRwGit9yIPCdfW-fDPGNyCh3XrucxXbTMq9lE20DMJqg=s600-c-k-c0x00ffffff-no-rj-rp-mo"
                            alt="Your Company">
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <a href="#" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                                aria-current="page">Home</a>
                            <a href="#"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Team</a>
                            <a href="#"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Projects</a>
                            <a href="#"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Calendar</a>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <button type="button"
                        class="rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </button>

                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <div>
                            <button type="button"
                                class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full"
                                    src="https://w7.pngwing.com/pngs/535/466/png-transparent-google-account-microsoft-account-login-email-gmail-email-miscellaneous-text-trademark-thumbnail.png"
                                    alt="">
                            </button>
                        </div>
                        <!-- <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                id="user-menu-item-0">Your Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                id="user-menu-item-1">Settings</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                id="user-menu-item-2">Sign out</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <!-- <div class="sm:hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <a href="#" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium"
                    aria-current="page">Dashboard</a>
                <a href="#"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Projects</a>
                <a href="#"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Calendar</a>
            </div>
        </div> -->
    </nav>
    <div class=" pt-20 flex justify-center w-100">
        <form action="./dashbourd.php" method="post" class="px-2 col-6" enctype="multipart/form-data">
            <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors6&&"px-3 py-2" ?> rounded-lg px-3">
                <?=$errors6?></h6>
            <div class="flex flex-col ">
                <label for="titleProduct" class="fs-5  font-bold">Titel:</label>
                <input type="text" value="<?php if(isset($_POST['titleProduct'])){
                        echo $_POST['titleProduct'];
                    }?>" name="titleProduct" id="titleProduct" placeholder="Text"
                    class="rounded-lg bg-slate-300 hover:bg-slate-200 focus:bg-slate-200">
                <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors1&&"px-3 py-2" ?> rounded-lg px-3">
                    <?=$errors1?></h6>
            </div>
            <div class="flex  flex-col">
                <label for="priceProduct" class="fs-5  font-bold">Price:</label>
                <input type="number" value="<?php if(isset($_POST['priceProduct'])){
                        echo $_POST['priceProduct'];
                    }?>" name="priceProduct" id="priceProduct" placeholder="Number"
                    class="rounded-lg bg-slate-300 hover:bg-slate-200 focus:bg-slate-200">
                <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors2&&"px-3 py-2" ?> rounded-lg px-3">
                    <?=$errors2?></h6>
            </div>
            <div class="flex  flex-col">
                <label for="descriptionProduct" class="fs-5  font-bold">Description:</label>
                <input type="text" value="<?php if(isset($_POST['descriptionProduct'])){
                        echo $_POST['descriptionProduct'];
                    }?>" name="descriptionProduct" id="descriptionProduct" placeholder="Text"
                    class="rounded-lg bg-slate-300 hover:bg-slate-200 focus:bg-slate-200">
                <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors3&&"px-3 py-2" ?> rounded-lg px-3">
                    <?=$errors3?></h6>
            </div>
            <div class="flex  flex-col">
                <label for="photoProduct" class="fs-5   font-bold">Photo:</label>
                <div>
                    <!-- <input type="url" name="photoProduct" id="photoProduct" placeholder="URL"
                        class="rounded-lg bg-slate-300 hover:bg-slate-200 focus:bg-slate-200">&Tab;&Tab; OR &Tab; &Tab; -->
                    <input type="file" value="<?php if(isset($_POST['photoFileProduct']['size'])){
                        echo $_POST['photoFileProduct']['size'];
                    }?>" name="photoFileProduct" id="photoProduct"
                        class="rounded-lg bg-slate-300 w-100 hover:bg-slate-200 focus:bg-slate-200">
                </div>
                <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors4&&"px-3 py-2" ?> rounded-lg px-3">
                    <?=$errors4?></h6>
            </div>
            <div class="flex  flex-col">
                <label for="discountProduct" class="fs-5  font-bold">Discount:</label>
                <input type="number" value="<?php if(isset($_POST['discountProduct'])){
                        echo $_POST['discountProduct'];
                    }?>" name="discountProduct" id="discountProduct" placeholder="Number"
                    class="rounded-lg bg-slate-300 hover:bg-slate-200 focus:bg-slate-200">
                <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors5&&"px-3 py-2" ?> rounded-lg px-3">
                    <?=$errors5?></h6>
            </div>
            <input type="submit"
                class="rounded-full w-100 text-center bg-green-400 hover:bg-green-800  hover:text-white  px-5 py-1 my-2 mx-auto "
                value="Add Product">
        </form>
    </div>
    <div class="mt-4 table-responsive px-4">
        <table class="table table-hover  col-7 ">
            <thead>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Photo</th>
                <th>Controls</th>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $product):
                ?>
                <tr>
                    <td class="text-nowrap ">
                        <?=$key?>
                    </td>
                    <td class="text-nowrap ">
                        <?=$product['title']?>
                    </td>
                    <td class="text-nowrap ">
                        <?=$product['description']?>
                    </td>
                    <td class="text-nowrap ">
                        <?=$product['price']?>
                    </td>
                    <td class="text-nowrap ">
                        <?=$product['discount']?>
                    </td>
                    <td class="text-nowrap "><img width='120' class="rounded-lg"
                            src="./db/Images/<?=$product['photo']?>" alt="savc"></td>
                    <td class="text-nowrap ">
                        <a href="/E-Commerce/update.php/?update=<?=$product['Id']?>&title=<?=$product['title']?>&description=<?=$product['description']?>&price=<?=$product['price']?>&discount=<?=$product['discount']?>"
                            class="bg-green-200 hover:bg-green-300 m-1 btn">Update</a>
                        <a href="/E-Commerce/dashbourd.php/?delete=<?=$product['Id']?>&photo=<?=$product['photo']?>"
                            class="bg-red-200 hover:bg-red-300 btn">Delete</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>

</html>
