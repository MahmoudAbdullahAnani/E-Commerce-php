<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: /E-Commerce");
    exit;
}
include_once "./Front-End/Navbare.php";
include_once "./db/User.php";
$user = new User;
$data = $user->select(' *','product')->print();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>MMA || Home</title>
    <link rel="stylesheet" href="./Front-End/assets/Galry-css/style.css">
    <style>
    .me {
        width: 400px;
        margin: 90px auto;
    }

    .me p,
    .me h1 {
        letter-spacing: 3px;
        text-align: center;
    }

    .me p {
        font-weight: 200;
    }

    .me span {
        font-weight: bold;
    }

    .social {
        position: fixed;
        top: 20px;
    }

    .social ul {
        padding: 0px;
        transform: translate(-270px, 0);
    }

    .social ul li {
        display: block;
        margin: 5px;
        background: rgba(250, 250, 250, 0.50);
        width: 300px;
        text-align: right;
        padding: 10px;
        border-radius: 0 30px 30px 0;
        transition: all 1s;
    }

    .social ul li:hover {
        transform: translate(110px, 0);
        background: rgba(0, 0, 0, 0.90);
    }

    .social ul li:hover a {
        color: #000;
    }

    .social ul li:hover i {
        color: #fff;
        background: rgba(0, 0, 0, 0.36);
        transform: rotate(360deg);
        transition: all 1s;
    }

    .social ul li i {
        margin-left: 10px;
        color: #000;
        background: #fff;
        padding: 10px;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 20px;
        background: #ffffff;
        transform: rotate(0deg);
    }

    </style>
</head>

<body>
    <div class="social mt-20 z-40">
        <ul>
            <li><a style="  color: #fff;
    text-decoration: none;" href="https://twitter.com/Mahmoud02136886">Twitter <i class="fa fa-twitter"></i></a></li>
            <li><a style="  color: #fff;
    text-decoration: none;" href="https://github.com/MahmoudAbdullahAnani">Github <i class="fa fa-github"></i></a></li>
            <li><a style="  color: #fff;
    text-decoration: none;" href="https://www.linkedin.com/in/mahmoud-abdullah-ab253920b/">Linkedin <i
                        class="fa fa-linkedin"></i></a></li>
        </ul>
    </div>
    <main class="flex justify-center align-items-center relatives mainHome">

        <video autoplay muted loop plays-inline class="videoGalry" style="width: 100%;">
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
<?php include_once "./Front-End/Footer.php"; ?>
