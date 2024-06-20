<!DOCTYPE html>

<?php
session_start();

if(!isset($_SESSION["user"])) {
    header("Location: ../src/login.html");
    exit;
}

if(!isset($_COOKIE["user_id"])) {
    header("Location: ../src/login.html");
    exit;
}
?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Kosti - Inicio</title>

        <script src="https://cdn.tailwindcss.com"></script>

        <link rel="stylesheet" href="../styles/style.css">
        <link rel="icon" type="image/png" href="images/Icon.png">
    </head>

    <body style="background-color: #f2f2f2;">
        <header class="w-screen bg-[#202125] backdrop-blur-2xl shadow-sm h-[10%] 2xl:h-[7%] fixed">
            <nav class="w-[100%] h-[100%] flex items-center">
                <div class="flex items-center mx-5 text-center"><p class="text-[#ffffff] font-thin text-4xl">Kosti</p></div>
                <div class="w-screen h-[100%] flex justify-end items-center">
                    <ul class="gap-4 flex flex-row mr-4">
                        <?php
                        if(!isset($_GET["share"])) {
                        ?>
                        <li>
                            <button class="text-[#b6c7ff] font-thin text-xl 2xl:text-2xl transition-all duration-500 border-b-transparent hover:border-b-[1px] hover:border-[#b6c7ff]" id="share-link">Compartir</button>
                        </li>
                        <?php
                        }
                        ?>
                        <li>
                            <a class="text-[#ffffff] font-thin text-xl 2xl:text-2xl transition-all duration-500 border-b-transparent hover:border-b-[1px] hover:border-[#ffffff]" href="../api/destroy_session.php">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <main class="w-screen bg-[#f2f2f2] h-[100%] 2xl:h-[93%] flex justify-center items-center">
            <div class="w-screen h-screen bg-transparent flex justify-start items-end">
                <section class="w-[98%] h-[88%] mx-4 2xl:h-[88.5%] flex justify-center items-center">
                    <ul class="list-none w-[100%] h-[90%] gap-12 flex flex-row justify-start items-center">
                        <ul class="list-none w-[100%] h-[90%] gap-12 flex flex-row justify-start items-center" id="card-container">
                        </ul>

                        <?php
                        if(!isset($_GET["share"])) {
                        ?>
                        <li class="bg-[#202125] fixed left-[95%] w-[3.8%] h-[6.8%] flex justify-center flex-col items-center rounded-md shadow-md" id="add-list-button-container">
                            <button class="w-[60%] hover:rotate-6 hover:text-[#a1a1a1] transition-all duration-500 bg-transparent h-[60%] min-w-[52px] rounded-xl flex text-center justify-center items-center text-4xl font-thin text-[#ffffff]" id="add-list-button">
                                +
                            </button>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </section>
            </div>
        </main>

        <?php
        if(!isset($_GET["share"])) {
        ?>
        <script src="../scripts/panel.js" type="text/javascript"></script>
        <?php
        } else {
        ?>
        <script src="../scripts/guest.js" type="text/javascript"></script>
        <?php
        }
        ?>
    </body>
</html>
