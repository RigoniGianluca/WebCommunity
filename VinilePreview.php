<!DOCTYPE html>
<html>
<head>
    <?php
    $titolo = "";
     if($_SERVER['REQUEST_METHOD'] == 'POST')
         $titolo = $_POST['titolo'];

     $titolo = strtoupper($titolo);
     echo "<title>" . $titolo . "</title>";
    ?>
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
                            <a href="Home.php" id="home" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Home</a>
                            <a href="CaricaVinile.php" id="Iseriscivinile" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Carica vinile</a>
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

    <div>
        <?php

            require_once("DBConn.php");
            use CVinile\CVinile;
            require_once ("CVinile.php");

            $conn = new DBConn();
            $conn->conn->query("USE WebCommunity");

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $titolo = $_POST["titolo"];
                $autore = $_POST['autore'];
                $immagine = $_POST['immagine'];
                $user = $_POST['utente'];

                $Vinile = new CVinile($immagine, $titolo, $autore, $user);

                echo 'il titolo è ' . $Vinile->titolo . '<br>l\'autore è ' . $Vinile->autore . '<br>
                        <img src="' . $Vinile->img . '" class="w-80 max-h-80 object-cover transition-opacity duration-500 ease-in-out group-hover:opacity-30"><br>lo user è ' . $Vinile->utente;
            }

        ?>
    </div>



</body>
</html>