<!DOCTYPE html>
<html>
    <head>
        <title>il tuo profilo</title>
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
                        <a href="EliminaProfilo.php" id="eliminaProfilo" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Elimina Account</a>

                        <a href="Profile.php" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
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
            I TUOI VINILI
        </div>
        <?php
        require_once("DBConn.php");
        use CVinile\CVinile;
        require_once("CVinile.php");


        $conn = new DBConn();
        $conn->conn->query("USE WebCommunity");

        $conn->conn->query("CREATE TABLE IF NOT EXISTS vinili (
                                    id INT (5) NOT NULL AUTO_INCREMENT,
                                    titolo VARCHAR(100) NOT NULL,
                                    autore VARCHAR(64) NOT NULL,
                                    immagine VARCHAR(225) NOT NULL,
                                    descrizione VARCHAR(999) NOT NULL,
                                    user VARCHAR(40) NOT NULL,
                                    PRIMARY KEY (id))");

        $result = $conn->conn->query("SELECT * FROM vinili");
        if ($result->num_rows > 0) {
            $x = 0;
            echo '<div class="flex flex-wrap mx-4">';
            while ($row = $result->fetch_assoc()) {
                $Vinile = new CVinile($row["id"], $row["immagine"], $row["titolo"], $row["autore"], $row["user"], $row['descrizione']);
                if($Vinile->utente == $_COOKIE['utente']){
                    echo '<div class="w-1/4 px-4 my-4 ">
                        <div class="relative group block">
                            <img src="' . $Vinile->img . '" class="w-full max-h-80 object-center object-cover transition-opacity duration-500 ease-in-out group-hover:opacity-30">
                            <div class="absolute inset-0 flex flex-col space-y-5 items-center opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
                                    <div class="pt-20">
                                        <form action="./VinilePreview.php" method="POST" class="">
                                            <input type="hidden" name="id" value="' . $Vinile->id . '">
                                            <button class="bg-gray-800/75 text-gray-300 hover:bg-gray-700 hover:text-white text-center h-10 px-2 mx-4 rounded-lg" name="mostra">MOSTRA</button>
                                        </form>
                                    </div>
                                    <div>
                                        <form action="EditVinile.php" method="POST">
                                            <input type="hidden" name="id" value="' . $Vinile->id . '">
                                            <button name="modifica" class="bg-gray-800/75 text-gray-300 hover:bg-gray-700 hover:text-white text-center h-10 px-2 mx-4 rounded-lg">MODIFICA</button>
                                        </form>
                                    </div>
                                    <div>
                                        <form action="EliminaVinile.php" method="POST">
                                            <input type="hidden" name="id" value="' . $Vinile->id . '">
                                            <button name="eliminaVinile" class="bg-gray-800/75 text-gray-300 hover:bg-gray-700 hover:text-white text-center h-10 px-2 mx-4 rounded-lg">ELIMINA</button>
                                        </form>
                                    </div>' . '
                            </div>
                            <div class="">
                                <div class="border-2 border-gray-800 bg-gray-800 text-center text-white font-semibold text-xl">' . $Vinile->titolo . ' - ' . $Vinile->autore . '</div>
                            </div>
                        </div>
                    </div>';

                    $x++;
                    if ($x % 4 == 0) {
                        echo '</div><div class="flex flex-wrap -mx-4">';
                    }
                }
            }
            echo '</div>';
        } else {
            echo '<div class="pt-5 pb-2 font-bold text-3xl">Non ci sono ancora vinili caricati</div>
                        <div class="bg-teal-700 text-white border-2 rounded-lg border-gray-800 text-2xl font-semibold text-center w-48 h-10 hover:font-bold hover:bg-teal-700/75"><a href="./CaricaVinile.php">Carica un vinile</a></div>';
        }
    ?>
    </div>
    <footer>
        <div class="w-full h-32 bg-gray-800 absolute bottom-0">
            <div class="mx-12 mt-5">
                <label class="text-white font-bold text-lg">WEB DEVELOPER -</label>
                <label class="text-white text-lg">Rigoni Gianluca</label>
            </div>
            <div class="mx-12">
                <label class="text-white font-bold text-lg">Contatti -</label>
                <label class="text-white text-lg">1234567890</label>
            </div>
            <div class="mx-12 flex flex-rows">
                <label class="text-white font-bold text-lg">Social - </label>
                <label class="mx-1 text-white text-lg">@gigilucaa</label>
                <img src="./images/insta-logoo.png" class="mx-5 w-10 h-10">
            </div>
        </div>
    </footer>
    </body>
</html>