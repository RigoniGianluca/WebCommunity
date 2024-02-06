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

                    $id = "";
                    $titolo = "";
                    $autore = "";
                    $immagine = "";
                    $user = $_COOKIE['utente'];
                    $descrizione = "";
                    $Vinile = new CVinile($id, $immagine, $titolo, $autore, $user, $descrizione);

                    if(isset($_POST['modifica'])){
                        $id = $_POST['id'];
                        $titolo = $_POST["titolo"];
                        $autore = $_POST['autore'];
                        $immagine = $_POST['immagine'];
                        $descrizione = $_POST['descrizione'];

                        $Vinile->ChangeTitolo($titolo);
                        $Vinile->ChangeAutore($autore);
                        $Vinile->ChangeImg($immagine);
                        $Vinile->ChangeDescrizione($descrizione);
                        $Vinile->ChangeId($id);

                        echo '<div class="mx-48 bg-white">
                                <div class="mx-auto font-bold text-6xl mt-8">
                                    STAI MODIFICANDO ' . strtoupper($Vinile->titolo) . '
                                </div>
                                <div class="max-w-xl py-16">
                                <form action="./EditVinile.php" method="POST" enctype="multipart/form-data" class="border-2 rounded border-black">
                                    <div class="py-5 mx-5 flex flex-col space-y-4">
                                        <label for="titolo" class="text-lg">Titolo</label>
                                        <input type="text" id="titolo2" name="titolo2" class="border border-slate-400 rounded-md px-3 py-2">
                        
                                        <label class="text-lg">Autore</label>
                                        <input type="text" id="autore2" name="autore2" class="border border-slate-400 rounded-md px-3 py-2">
                        
                                        <label class="text-lg">Descrizione</label>
                                        <input type="text" id="descrizione2" name="descrizione2" class="border border-slate-400 rounded-md px-3 py-2 h-32">
                        
                                        <label for="image" class="text-lg">Carica immagine</label>
                                        <input type="file" id="immagine2" name="immagine2" accept="image/jfif, image/png, image/jpeg" class="border border-slate-400 rounded-md px-3 py-2">
                        
                                        <button type="submit" name="modifica2" class="bg-gray-900 text-white rounde  d-md px-4 py-2 font-semibold text-xl border border-slate-400 rounded-md hover:bg-gray-700/100">Carica il tuo vinile</button>
                                    </div>
                                </form>
                            </div>';
                    }

                    if(isset($_POST['modifica2'])) {


                        if (isset($_POST['titolo2'])) {
                            $Vinile->ChangeTitolo($_POST["titolo2"]);
                        }

                        if (isset($_POST['autore2'])) {
                            $Vinile->ChangeAutore($_POST['autore2']);
                        }

                        if (isset($_FILES['immagine2'])) {
                            if ($_FILES['immagine2']['error'] === UPLOAD_ERR_OK) {
                                $uploadDir = 'images';
                                $uploadPath = $uploadDir . '/' . basename($_FILES['immagine2']['name']);
                                move_uploaded_file($_FILES['immagine2']['tmp_name'], $uploadPath);
                                $Vinile->ChangeImg($uploadPath);
                            } else {
                                echo '<div class="bg-gray-800 text-white font-bold text-xl text-center">Errore nel caricamento dell\'immagine</div>';
                            }
                        }

                        if (isset($_POST['descrizione2'])) {
                            $Vinile->ChangeDescrizione($_POST['descrizione2']);
                        }
                        echo $Vinile->toString();
                        //echo '<div class="bg-gray-800 text-white font-bold text-xl text-center">'.$Vinile->id .$Vinile->titolo. $Vinile->autore. $Vinile->img. $Vinile->descrizione. $Vinile->utente. $Vinile->id.'</div>';

                        $query = "UPDATE vinili SET titolo='".$newTitolo."', autore='".$newAutore."', immagine='".$uploadPath."', descrizione='".$newDescrizione."', user='".$newUser."' WHERE id=".$newId;

                        /*$stmt = $conn->conn->prepare($query);

                        $stmt->bind_param('sssssi', $Vinile->titolo, $Vinile->autore, $Vinile->img, $Vinile->descrizione, $Vinile->utente, $Vinile->id);
                            $result = $stmt->execute();*/
                        $result=$conn->conn->query($query);
                        if ($result) {
                            echo "Query di aggiornamento eseguita con successo.";

                            echo $Vinile->id."<br>".$Vinile->titolo."<br>".$Vinile->autore."<br>".$Vinile->img."<br>".$Vinile->descrizione."<br>".$Vinile->utente."<br>";

                            /*echo '<div class="mx-48 bg-white">
                                <div class="mx-auto font-bold text-6xl mt-8">
                                    IL TUO VINILE MODIFICATO
                                </div>
                                <div class="mx-96 my-5 w-3/4 flex flex rows">
                                    <div class="w-80 max-h-80">
                                    <img src="' . $Vinile->img . '" class="w-80 max-h-80 object-cover transition-opacity duration-500 ease-in-out group-hover:opacity-30">
                                    </div>
                                    <div class="w-auto h-auto mx-20">
                                        <div class="text-4xl font-bold text-center">' .
                                $Vinile->titolo . ' - ' . $Vinile->autore
                                . '</div>
                                        <div class="text-xl">
                                            ' . $Vinile->descrizione . '
                                        </div>
                                    </div>
                                  </div>';*/
                        } else {
                            echo "Errore durante l'esecuzione della query: " ;// $stmt->error;
                        }
                    }
                ?>
</body>
</html>