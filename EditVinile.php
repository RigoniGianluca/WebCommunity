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

                    $titolo = "";
                    $autore = "";
                    $immagine = "";
                    $user = $_COOKIE['utente'];
                    $descrizione = "";
                    $Vinile = new CVinile($immagine, $titolo, $autore, $user, $descrizione);

                    if(isset($_POST['modifica'])){
                        $titolo = $_POST["titolo"];
                        $autore = $_POST['autore'];
                        $immagine = $_POST['immagine'];
                        $descrizione = $_POST['descrizione'];

                        $Vinile->ChangeTitolo($titolo);
                        $Vinile->ChangeAutore($autore);
                        $Vinile->ChangeImg($immagine);
                        $Vinile->ChangeDescrizione($descrizione);

                        echo '<div class="mx-48 bg-white">
                                <div class="mx-auto font-bold text-6xl mt-8">
                                    MODIFICA IL TUO VINILE
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
                    else if(isset($_POST['modifica2'])){
                        if(isset($_POST['titolo2'])){
                            $Vinile->ChangeTitolo($_POST["titolo2"]);
                        }

                        if(isset($_POST['autore2'])) {
                            $Vinile->ChangeAutore($_POST['autore2']);
                        }

                        if(isset($_POST['immagine2'])){
                            if (isset($_FILES['immagine2']) && $_FILES['immagine2']['error'] === UPLOAD_ERR_OK) {
                                $uploadDir = 'images';
                                $uploadPath = $uploadDir . '/' . basename($_FILES['immagine2']['name']);
                                move_uploaded_file($_FILES['immagine2']['tmp_name'], $uploadPath);
                                $Vinile->ChangeImg($uploadPath);
                            } else {
                                echo '<div class="bg-gray-800 text-white font-bold text-xl text-center">Errore nel caricamento dell\'immagine</div>';
                                // Puoi anche visualizzare ulteriori informazioni sull'errore con $_FILES['immagine2']['error']
                            }
                        }

                        if(isset($_POST['descrizione2'])) {
                            $Vinile->ChangeDescrizione($_POST['descrizione2']);
                        }
                        $newTitolo = $Vinile->titolo;
                        $newAutore = $Vinile->autore;
                        $newImg = $Vinile->img;
                        $newDescrizione = $Vinile->descrizione;

                        $query = 'UPDATE vinili 
                                SET titolo=' . $newTitolo . ', autore=' . $newTitolo . ', immagine=' . $newTitolo . ', user=' . $_COOKIE['utente'] . ', descrizione=' . $newTitolo . ' 
                                WHERE titolo=? AND autore=? AND immagine=? AND user=? AND descrizione=?';

                        $stmt = $conn->conn->prepare($query);

                        if(!$stmt) {
                            die("Errore nella preparazione della query: " . $conn->conn->error);
                        }
                        $stmt->bind_param('sssss',  $titolo, $autore, $immagine, $user, $descrizione);
                        $result = $stmt->execute();

                        if($result === TRUE){
                            echo '<div class="mx-48 bg-white">
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
                                            .'</div>
                                        <div class="text-xl">
                                            ' . $Vinile->descrizione . '
                                        </div>
                                    </div>  
                                  </div>';
                        }
                        else
                            echo '<div class="bg-gray-800 text-white font-bold text-xl text-center">errore nell\' edit dell\'immagine</div>';
                    }

                ?>
</body>
</html>