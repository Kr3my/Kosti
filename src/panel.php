<!DOCTYPE html>

<?php
session_start();

if(!isset($_SESSION["user"])) {
    header("Location: ../src/login.html");
    exit;
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Kosti - Inicio</title>

        <script src="https://cdn.tailwindcss.com"></script>

        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/png" href="images/Icon.png">
    </head>

    <body style="background-color: #b0e0e6;">
        <header class="w-screen bg-[#df86c3] backdrop-blur-2xl shadow-sm h-[10%] 2xl:h-[7%] fixed">
            <nav class="w-[100%] h-[100%] flex items-center">
                <div class="flex items-center mx-5 text-center"><p class="text-[#ffffff] font-thin text-4xl">Kosti</p></div>
                <div class="w-screen h-[100%] flex justify-end items-center">
                    <ul class="gap-4 flex flex-row mr-4">
                        <li class="text-[#ffffff] font-thin text-xl 2xl:text-2xl transition-all duration-500 border-b-transparent hover:border-b-[1px] hover:border-[#e1c1ff]"><a href="src/login.html">Iniciar sesión</a></li>

                        <li><a class="text-[#ffffff] font-thin text-xl 2xl:text-2xl transition-all duration-500 border-b-transparent hover:border-b-[1px] hover:border-[#e1c1ff]" href="src/logout.html">Cerrar sesión</a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <main class="w-screen bg-[#f2f2f2] h-[100%] 2xl:h-[93%] flex justify-center items-center">
            <div class="w-screen h-screen bg-transparent flex justify-start items-end">
                <section class="w-[98%] h-[88%] mx-4 2xl:h-[88.5%] flex justify-center items-center">
                    <ul class="list-none w-[100%] h-[90%] gap-12 flex flex-row justify-start items-center" id="card-container">
                        <li class="bg-[#e9e9e9] w-[25%] min-w-[150px] 2xl:min-w-[420px] h-[100%] flex justify-center flex-col items-center rounded-md shadow-md">
                            <div class="w-full bg-[#e9e9e9] h-[13%] rounded-t-md flex justify-center items-center">
                                <input type="text" class="text-center text-[#000000] text-2xl 2xl:text-2xl transition-all duration-500 bg-transparent border-b-[1px] outline-none w-[35%] hover:w-[55%]" placeholder="Carta" value="Carta 1">
                            </div>
    
                            <ul class="my-4 w-full list-none h-[100%] gap-4 flex flex-col items-center overflow-y-scroll">
                                <li class="bg-white w-[86%] min-h-[80px] rounded-xl resize-y overflow-auto flex justify-center items-center">
                                    <textarea class="w-[50%] h-[20%] resize-none overflow-hidden outline-none font-thin text-[#242424]" name="" id=""></textarea>
                                </li>

                                <li class="bg-[#df86c3] hover:w-[20%] transition-all duration-700 w-[15%] min-h-[30px] rounded-xl flex justify-center items-center text-center">
                                    <button class="text-3xl w-full h-full text-white hover:text-[#ffd1f0] font-thin text-center flex justify-center items-center transition-all duration-700 hover:rotate-12">+</button>
                                </li>
                            </ul>
                        </li>

                        <li class="bg-[#df86c3] w-[3.8%] h-[6.8%] flex justify-center flex-col items-center rounded-md shadow-md">
                            <button class="w-[60%] bg-transparent h-[60%] rounded-xl flex text-center justify-center items-center text-4xl font-thin text-[#ffffff]">
                                +
                            </button>
                        </li>
                    </ul>
                </section>
            </div>
        </main>
    </body>
</html>
