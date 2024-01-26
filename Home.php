<!DOCTYPE html>
<html>
    <head>
        <title>HOME</title>
        <script src="https://cdn.tailwindcss.com"></script>


        <?php



        ?>
    </head>

    <body>

    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <a href="Home.php">
                            <img class="h-8 w-auto" src="./images/foto.png" alt="Disc Jockey">
                        </a>
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="Home.php" id="home" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Home</a>
                            <a href="Home.php" id="perTe" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Per Te</a>
                            <a href="Logout.php" id="logout" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Logout</a>
                        </div>
                    </div>
                </div>

                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <div>
                            <a href="Profile.php" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" src="https://img.favpng.com/1/4/11/portable-network-graphics-computer-icons-google-account-scalable-vector-graphics-computer-file-png-favpng-HScCJdtkakJXsS3T27RyikZiD.jpg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!--<div class="mx-48">
        <div class="mt-5 font-bold text-6xl">
            BEST SELLER
        </div>
        <div class="flex flex-rows justify-center mt-5 mb-10">
            <div class="basis-1/4 box-border h-80 mr-24 border-4 border-black">
                <a href="">
                    <img src="./images/vinile.png"">
                    <div class="my-0.5">
                        <div class="text-center font-semibold text-xl">Titolo vinile - Autore</div>
                    </div>
                </a>
            </div>
            <div class="basis-1/4 box-border h-80 mr-24 border-4 border-black">
                <a href="">
                    <img src="./images/vinile.png"">
                    <div class="my-0.5">
                        <div class="text-center font-semibold text-xl">Titolo vinile - Autore</div>
                    </div>
                </a>
            </div>
            <div class="basis-1/4 box-border h-80 mr-24 border-4 border-black">
                <a href="">
                    <img src="./images/vinile.png"">
                    <div class="my-0.5">
                        <div class="text-center font-semibold text-xl">Titolo vinile - Autore</div>
                    </div>
                </a>
            </div>
            <div class="basis-1/4 box-border h-80 mr-24 border-4 border-black">
                <a href="">
                    <img src="./images/vinile.png"">
                    <div class="my-0.5">
                        <div class="text-center font-semibold text-xl">Titolo vinile - Autore</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="flex flex-rows justify-center mb-10>
            <div class="basis-1/4 box-border h-80 mr-24 border-4 border-black">
                <a href="">
                    <img src="./images/vinile.png"">
                    <div class="my-0.5">
                        <div class="text-center font-semibold text-xl">Titolo vinile - Autore</div>
                    </div>
                </a>
            </div>
            <div class="basis-1/4 box-border h-80 mr-24 border-4 border-black">
                <a href="">
                    <img src="./images/vinile.png"">
                    <div class="my-0.5">
                        <div class="text-center font-semibold text-xl">Titolo vinile - Autore</div>
                    </div>
                </a>
            </div>
            <div class="basis-1/4 box-border h-80 mr-24 border-4 border-black">
                <a href="">
                    <img src="./images/vinile.png"">
                    <div class="my-0.5">
                        <div class="text-center font-semibold text-xl">Titolo vinile - Autore</div>
                    </div>
                </a>
            </div>
            <div class="basis-1/4 box-border h-80 mr-24 border-4 border-black">
                <a href="">
                    <img src="./images/vinile.png"">
                    <div class="my-0.5">
                        <div class="text-center font-semibold text-xl">Titolo vinile - Autore</div>
                    </div>
                </a>
            </div>
        </div>-->

    <div class="mx-48">
        <div class="mt-5 font-bold text-6xl">
            BEST SELLER
        </div>
        <div class="flex flex-rows justify-center mt-5 mb-10">
        <?php
            $json = json_decode(file_get_contents('utenti.json'), true);
            $img="";
            $titolo="";
            $autore="";
            foreach($json as $vinile){   //fixare il fatto di metterli in righe da 4
                $img = $vinile["img"];
                $titolo = $vinile["titolo"];
                $autore = $vinile["autore"];

                echo '<div class="basis-1/4 box-border h-80 mr-24 border-4 border-black">
                            <a href="">
                                <img src=' . $img . '>
                                <div class="my-0.5">
                                    <div class="text-center font-semibold text-xl">' . $titolo . ' - ' .  $autore . '</div>
                                </div>
                            </a>
                        </div>';
            }

        ?>
        </div>
    </div>

    </body>
</html>
ut