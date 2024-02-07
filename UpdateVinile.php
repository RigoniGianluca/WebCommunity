<!DOCTYPE html>
<html>
<head>
    <title>Modifica Vinile</title>
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
<?php
require_once("DBConn.php");
$conn = new DBConn();
$conn->conn->query('USE WebCommunity');

use CVinile\CVinile;
require_once ("CVinile.php");


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['modifica2'])) {
        $id = $_POST['id'];
        $query = "SELECT * FROM vinili WHERE id='$id'";
        $result = $conn->conn->query($query);

        if ($result->num_rows > 0) {
            $x = 0;
            echo '<div class="flex flex-wrap mx-4 ">';
            while ($row = $result->fetch_assoc()) {
                $Vinile = new CVinile($row["id"], $row["immagine"], $row["titolo"], $row["autore"], $row["user"], $row["descrizione"]);
            }


            $Vinile->ChangeTitolo($_POST["titolo2"]);//titolo
            $Vinile->ChangeAutore($_POST['autore2']);//autore
            if(isset($_POST['immagine2'])) {
                if ($_FILES['immagine2']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = 'images';
                    $uploadPath = $uploadDir . '/' . basename($_FILES['immagine2']['name']);
                    move_uploaded_file($_FILES['immagine2']['tmp_name'], $uploadPath);
                    $Vinile->ChangeImg($uploadPath);//immagine
                } else {
                    echo '<div class="bg-gray-800 text-white font-bold text-xl text-center">Errore nel caricamento dell\'immagine</div>';
                }
            }
            $Vinile->ChangeDescrizione($_POST['descrizione2']);//descrizione
            $query = "UPDATE vinili SET titolo=?, autore=?, immagine=?, descrizione=?, user=? WHERE id=?";

            $stmt = $conn->conn->prepare($query);

            $stmt->bind_param('sssssi', $Vinile->titolo, $Vinile->autore, $Vinile->img, $Vinile->descrizione, $Vinile->utente, $Vinile->id);
            $result = $stmt->execute();
            if ($result) {

                echo '<div class="mx-48 bg-white">
                                    <div class="mx-auto font-bold text-6xl mt-8 text-center">
                                        IL TUO VINILE MODIFICATO
                                    </div>
                                    <div class="mx-96 my-5 w-3/4 flex flex rows">
                                        <div class="w-80 max-h-80">
                                        <img src="' . $Vinile->img . '" class="w-80 max-h-80 object-cover transition-opacity duration-500 ease-in-out group-hover:opacity-30">
                                        </div>
                                        <div class="w-auto h-auto mx-20">
                                            <div class="text-4xl font-bold text-center">' . $Vinile->titolo . ' - ' . $Vinile->autore . '</div>
                                            <div class="text-xl">
                                                ' . $Vinile->descrizione . '
                                            </div>
                                        </div>
                                      </div>';
            } else {
                echo "Errore durante l'esecuzione della query: ";// $stmt->error;
            }
        }
    }
}
?>
</body>
</html>
