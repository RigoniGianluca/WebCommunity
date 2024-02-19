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
                            <a href="Home.php" id="home" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Home</a>
                            <a href="CaricaVinile.php" id="Iseriscivinile" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Carica vinile</a>
                        </div>
                    </div>
                </div>

                <!-- Profile dropdown -->
                <div class="relative ml-3">
                    <div class="flex space-x-4">
                        <div class="flex flex-row">
                            <form action="Ricerca.php" method="POST">
                                <input class="h-8 w-25 rounded-l-3xl border-2 border-black" id="ricerca" name="ricerca">
                                <button href="Ricerca.php" id="RicercaButton" name="RicercaButton">
                                    <img class="h-8 w-8 rounded-e-3xl" src="./images/icon_ricerca.png">
                                </button>
                            </form>
                        </div>
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
<?php
    require_once('DBConn.php');
    use CVinile\CVinile;
    require_once('CVinile.php');

    $conn = new DBConn();
    $conn->conn->query("USE WebCommunity");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['RicercaButton'])) {
            $ricerca = '%' . $_POST['ricerca'] . '%';

            //QUERY 1
            $query1 = "SELECT * FROM vinili WHERE titolo LIKE ?";
            $stmt1 = $conn->conn->prepare($query1);
            $stmt1->bind_param('s', $ricerca);
            $result1 = $stmt1->execute();
            $result1 = $stmt1->get_result();
            $stmt1->close();

            //QUERY2
            $query2 = "SELECT * FROM vinili WHERE autore LIKE ?";
            $stmt2 = $conn->conn->prepare($query2);
            $stmt2->bind_param('s', $ricerca);
            $result2 = $stmt2->execute();
            $result2 = $stmt2->get_result();
            $stmt2->close();

            if ($result1->num_rows > 0 || $result2->num_rows > 0 ){
                if ($result1->num_rows > 0) {
                    echo '<div class="border border-white bg-gray-800 text-white font-bold text-xl text-center">Ricerca per titolo</div>';
                    $x = 0;
                    echo '<div class="flex flex-wrap mx-4">';
                    while ($row = $result1->fetch_assoc()) {
                        $Vinile = new CVinile($row["id"], $row["immagine"], $row["titolo"], $row["autore"], $row["user"], $row['descrizione']);
                        echo '<div class="w-1/4 px-4 my-4 ">
                                <div class="relative group block">
                            <img src="' . $Vinile->img . '" class="w-full max-h-80 object-cover transition-opacity duration-500 ease-in-out group-hover:opacity-30">
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
                                    <form action="./VinilePreview.php" method="POST">
                                        <input type="hidden" name="id" value="' . $Vinile->id . '">
                                        <button class="mx-4 bg-gray-800/75 text-white text-center p-4 rounded-lg flex">MOSTRA</button>
                                    </form>
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

                if ($result2->num_rows > 0) {
                    echo '<div class="border border-white bg-gray-800 text-white font-bold text-xl text-center">Ricerca per autore</div>';
                    $x = 0;
                    echo '<div class="flex flex-wrap mx-4">';
                    while ($row = $result2->fetch_assoc()) {
                        $Vinile = new CVinile($row["id"], $row["immagine"], $row["titolo"], $row["autore"], $row["user"], $row['descrizione']);
                        echo '<div class="w-1/4 px-4 my-4 ">
                                <div class="relative group block">
                            <img src="' . $Vinile->img . '" class="w-full max-h-80 object-cover transition-opacity duration-500 ease-in-out group-hover:opacity-30">
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
                                    <form action="./VinilePreview.php" method="POST">
                                        <input type="hidden" name="id" value="' . $Vinile->id . '">
                                        <button class="mx-4 bg-gray-800/75 text-white text-center p-4 rounded-lg flex">MOSTRA</button>
                                    </form>
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
            }
            else{
                echo '</div><div class="bg-gray-800 text-white font-bold text-2xl text-center w-full">Non sono stati trovati vinili inerenti alla ricerca</div>';
            }
        }
    }
?>
</div>
</body>
</html>
