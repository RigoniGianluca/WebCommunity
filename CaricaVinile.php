<!DOCTYPE html>
<html>
<head>
    <title>UPLOAD VINILE</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <?php
        Require_once ('DBConn.php');
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


        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($_POST['titolo']==null || $_POST['autore']==null){
                echo '<div class="bg-gray-800 text-white font-bold text-xl text-center">Compila tutti i campi</div>';
            }
            else if($_FILES['image']['error'] === UPLOAD_ERR_OK){
                $titolo = $_POST['titolo'];
                $autore = $_POST['autore'];
                $user = $_COOKIE['utente'];
                $descrizione = $_POST['descrizione'];


                $uploadDir = 'images';
                $uploadPath = $uploadDir . '/' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);


                $query = "INSERT INTO vinili(titolo, autore, immagine, descrizione, user) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->conn->prepare($query);
                $stmt->bind_param('sssss', $titolo, $autore, $uploadPath, $descrizione, $user);
                $result = $stmt->execute();
                $stmt->close();

                if($result === TRUE){
                    Header('Location: ./Home.php');
                    exit;
                }
                else
                    echo '<div class="bg-gray-800 text-white font-bold text-xl text-center">errore nel upload dell\'immagine</div>';
                

            }
            else{
                echo '<div class="bg-gray-800 text-white font-bold text-xl text-center">errore nel upload dell\'immagine</div>';
            }
        }

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

<div class="mx-48 bg-white">
    <div class="mx-auto font-bold text-6xl mt-8">
        INSERISCI IL TUO VINILE
    </div>

    <div class="max-w-xl py-16">
        <form action="./CaricaVinile.php" method="POST" enctype="multipart/form-data" class="border-2 rounded border-black">
            <div class="py-5 mx-5 flex flex-col space-y-4">
                <label for="titolo" class="text-lg">Titolo</label>
                <input type="text" id="titolo" name="titolo" class="border border-slate-400 rounded-md px-3 py-2">

                <label for="autore" class="text-lg">Autore</label>
                <input type="text" id="autore" name="autore" class="border border-slate-400 rounded-md px-3 py-2">

                <label for="autore" class="text-lg">Descrizione</label>
                <input type="text" id="descrizione" name="descrizione" class="border border-slate-400 rounded-md px-3 py-2 h-32">

                <label for="image" class="text-lg">Carica immagine</label>
                <input type="file" id="image" name="image" accept="image/jfif, image/png, image/jpeg" class="border border-slate-400 rounded-md px-3 py-2">

                <button type="submit" class="bg-gray-900 text-white rounde  d-md px-4 py-2 font-semibold text-xl border border-slate-400 rounded-md hover:bg-gray-700/100">Carica il tuo vinile</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>