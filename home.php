<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: /E-Commerce/");
    exit;
}
include_once "./Front-End/Navbare.php";
include_once "./db/User.php";
$user = new User;
$data = $user->select(' *','product')->print();
// $user->select(' *','product')->print()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>MMA || Home</title>
    <link rel="stylesheet" href="./Front-End/assets/Galry-css/style.css">
</head>

<body>
    <main class="flex justify-center align-items-center relatives mainHome">

        <video autoplay muted loop plays-inline class="videoGalry">
            <source src="./Front-End/Images/Video/galry.mp4" type="video/mp4">
        </video>


        <div class="galry z-10 absolute text-center mt-4">
            <h1 class="fs-1 font-bold text-white">M &Tab; M &Tab;A</h1>
            <button id='scrollMotion'
                class="fs-5 pb-1 font-bold rotate-90 text-white scrollMotion bg-gray-800 shadow-lg shadow-blue-500/50 hover:bg-gray-400  px-1 rounded-full text-center">>></button>
        </div>
    </main>
    <div class="px-3 my-3 ">

        <?php  
        if (!$data){
        ?>
        <div class="flex flex-wrap justify-around">
            <div class="YoutubeVideo">
                <div class="Image"></div>
                <div class="Icon"></div>
                <div class="Title"></div>
                <div class="Name"></div>
            </div>
            <div class="YoutubeVideo">
                <div class="Image"></div>
                <div class="Icon"></div>
                <div class="Title"></div>
                <div class="Name"></div>
            </div>
            <div class="YoutubeVideo">
                <div class="Image"></div>
                <div class="Icon"></div>
                <div class="Title"></div>
                <div class="Name"></div>
            </div>
            <div class="YoutubeVideo">
                <div class="Image"></div>
                <div class="Icon"></div>
                <div class="Title"></div>
                <div class="Name"></div>
            </div>
            <div class="YoutubeVideo">
                <div class="Image"></div>
                <div class="Icon"></div>
                <div class="Title"></div>
                <div class="Name"></div>
            </div>
            <div class="YoutubeVideo">
                <div class="Image"></div>
                <div class="Icon"></div>
                <div class="Title"></div>
                <div class="Name"></div>
            </div>
            <div class="YoutubeVideo">
                <div class="Image"></div>
                <div class="Icon"></div>
                <div class="Title"></div>
                <div class="Name"></div>
            </div>
            <div class="YoutubeVideo">
                <div class="Image"></div>
                <div class="Icon"></div>
                <div class="Title"></div>
                <div class="Name"></div>
            </div>
        </div>
        <?php
        } else {?>
        <div class="flex justify-center row">
            <?php
            foreach ($data as $key => $product) :
                ?>
            <div class="card col-2 ">
                <div class="card__image">
                    <img src="./db/Images/<?=$product['photo']?>" alt="<?=$product['photo']?>">
                </div>
                <div class="card__content">
                    <p class="card__title"><?=$product['title']?></p>
                    <p class="card__text"><?=$product['description']?></p>
                    <a class="card__button" href="#">Add Cart</a>
                </div>
            </div>
            <?php
            endforeach;
        ?>
        </div>
        <?php }?>
    </div>
</body>
<script>
export default {
    props: ['img', 'imgAlt', 'eyebrow', 'title', 'pricing', 'url']
}
</script>
<script>
const elemantScroll = document.querySelector('#scrollMotion');
elemantScroll.addEventListener('click', () => {
    window.scrollBy(0, 800);
});
</script>

</html>
