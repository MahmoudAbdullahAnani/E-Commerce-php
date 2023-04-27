<?php


$errors1 = '';
$errors2 = '';
$errors3 = '';
$errors4 = '';
$errors5 = '';
$errors6 = '';

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
            // $table,$title,$price,$photo,$discount,$description,$photoSize,$full_path,$tmp_name,$id
            $user->update(' product',$title,$price,$photoFile['name'],$discount,$description,$photoFile['size'],$photoFile['full_path'],$photoFile['tmp_name'],$_GET['update']);
            sleep(1);
            header("location: /E-Commerce/dashbourd.php");
            exit;
        }else{
            $errors6 = 'This user already exists';
        }
    }
}
if(!isset($_GET['update'])){
        header("location: /E-Commerce/home.php");
    exit;
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MMA || update</title>
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
    <div class=" pt-20 flex justify-center w-100">
        <form action="./update.php" method="post" class="px-2 col-6" enctype="multipart/form-data">
            <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors6&&"px-3 py-2" ?> rounded-lg px-3">
                <?=$errors6?></h6>
            <div class="flex flex-col ">
                <label for="titleProduct" class="fs-5  font-bold">Titel:</label>
                <input type="text" value="<?php 
                        echo $_GET['title'];
                    ?>" name="titleProduct" id="titleProduct" placeholder="Text"
                    class="rounded-lg bg-slate-300 hover:bg-slate-200 focus:bg-slate-200">
                <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors1&&"px-3 py-2" ?> rounded-lg px-3">
                    <?=$errors1?></h6>
            </div>
            <div class="flex  flex-col">
                <label for="priceProduct" class="fs-5  font-bold">Price:</label>
                <input type="number" value="<?=$_GET['price'];?>" name="priceProduct" id="priceProduct"
                    placeholder="Number" class="rounded-lg bg-slate-300 hover:bg-slate-200 focus:bg-slate-200">
                <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors2&&"px-3 py-2" ?> rounded-lg px-3">
                    <?=$errors2?></h6>
            </div>
            <div class="flex  flex-col">
                <label for="descriptionProduct" class="fs-5  font-bold">Description:</label>
                <input type="text" value="<?=$_GET['description'];?>" name="descriptionProduct" id="descriptionProduct"
                    placeholder="Text" class="rounded-lg bg-slate-300 hover:bg-slate-200 focus:bg-slate-200">
                <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors3&&"px-3 py-2" ?> rounded-lg px-3">
                    <?=$errors3?></h6>
            </div>
            <div class="flex  flex-col">
                <label for="photoProduct" class="fs-5 font-bold">Photo:</label>
                <div>
                    <!-- <input type="url" name="photoProduct" id="photoProduct" placeholder="URL"
                        class="rounded-lg bg-slate-300 hover:bg-slate-200 focus:bg-slate-200">&Tab;&Tab; OR &Tab; &Tab; -->
                    <input type="file" name="photoFileProduct" id="photoProduct"
                        class="rounded-lg bg-slate-300 w-100 hover:bg-slate-200 focus:bg-slate-200">
                </div>
                <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors4&&"px-3 py-2" ?> rounded-lg px-3">
                    <?=$errors4?></h6>
            </div>
            <div class="flex  flex-col">
                <label for="discountProduct" class="fs-5  font-bold">Discount:</label>
                <input type="number" value="<?=$_GET['discount'];?>" name="discountProduct" id="discountProduct"
                    placeholder="Number" class="rounded-lg bg-slate-300 hover:bg-slate-200 focus:bg-slate-200">
                <h6 class="text-white bg-red-400 text-center mt-1 <?php $errors5&&"px-3 py-2" ?> rounded-lg px-3">
                    <?=$errors5?></h6>
            </div>
            <input type="submit"
                class="rounded-full w-100 text-center bg-green-400 hover:bg-green-800  hover:text-white  px-5 py-1 my-2 mx-auto "
                value="Add Product">
        </form>
    </div>

</body>

</html>
