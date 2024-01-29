<!DOCTYPE html>
<html>
    <head>
        <title>HOME</title>
        <script src="https://cdn.tailwindcss.com"></script>

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
                            <a href="CaricaVinile.php" id="Iseriscivinile" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Carica vinile</a>
                        </div>
                    </div>
                </div>

                <!-- Profile dropdown -->
                <div class="relative ml-3">
                    <div class="flex space-x-4">
                        <a href="Profile.php" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="https://img.favpng.com/1/4/11/portable-network-graphics-computer-icons-google-account-scalable-vector-graphics-computer-file-png-favpng-HScCJdtkakJXsS3T27RyikZiD.jpg" alt="">
                        </a>

                        <a href="Logout.php" id="logout" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </nav>

    <div class="mx-48">
        <div class="mt-5 font-bold text-6xl">
            TUTTI I VINILI
        </div>

            <?php
                $vinile = json_decode(file_get_contents('vinili.json'), true);

                $vinili = count($vinile);
                for($x=0; $x<$vinili;) {
                    echo '<div class="flex flex-rows mt-5 mb-10">';
                    for ($i = 0; $i < 4; $i++, $x++) {
                        if($x<$vinili) {

                            

                            $img = $vinile[$x]["img"];
                            $titolo = $vinile[$x]["titolo"];
                            $autore = $vinile[$x]["autore"];

                            echo '<div class="w-1/4 box-border h-auto mr-6 border-4 border-black">
                                    <a href="" class="relative group">
                                        <img src="' . $img . '" alt="Avatar" class="w-full h-auto transition-opacity duration-500 ease-in-out group-hover:opacity-30">
                                        <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
                                            <div class="bg-gray-800/75 text-white text-center p-4 rounded-lg">
                                                OPEN
                                            </div>
                                        </div>
                                        <div class="my-0.5">
                                            <div class="text-center font-semibold text-xl">' . $titolo . ' - ' .  $autore . '</div>
                                        </div>
                                    </a>
                                </div>';
                        }
                    }
                    echo '</div>';
                }
            ?>
        </div>

    </body>
</html>