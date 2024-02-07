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
                        if (isset($_POST['modifica'])) {
                            $id = $_POST['id'];
                            $query = "SELECT * FROM vinili WHERE id='$id'";
                            $result = $conn->conn->query($query);

                            if ($result->num_rows > 0) {
                                $x = 0;
                                echo '<div class="flex flex-wrap mx-4 ">';
                                while ($row = $result->fetch_assoc()) {
                                    $Vinile = new CVinile($row["id"], $row["immagine"], $row["titolo"], $row["autore"], $row["user"], $row["descrizione"]);
                                }

                                echo '<div class="mx-48 bg-white">
                                <div class="mx-auto font-bold text-6xl mt-8">
                                    STAI MODIFICANDO ' . strtoupper($Vinile->titolo) . '
                                </div>
                                <div class="max-w-xl py-16">
                                <form action="./UpdateVinile.php" method="POST" enctype="multipart/form-data" class="border-2 rounded border-black">
                                    <div class="py-5 mx-5 flex flex-col space-y-4">
                                        <input type="hidden" name="id" value="'.$Vinile->id.'"> 
                                        <label for="titolo" class="text-lg">Titolo</label>
                                        <input type="text" id="titolo2" name="titolo2" class="border border-slate-400 rounded-md px-3 py-2" value="'.$Vinile->titolo.'">
                        
                                        <label class="text-lg">Autore</label>
                                        <input type="text" id="autore2" name="autore2" class="border border-slate-400 rounded-md px-3 py-2" value="'.$Vinile->autore.'">
                        
                                        <label class="text-lg">Descrizione</label>
                                        <input type="text" id="descrizione2" name="descrizione2" class="border border-slate-400 rounded-md px-3 py-2 h-32" value="'.$Vinile->descrizione.'">
                        
                                        <label for="image" class="text-lg">Carica immagine</label>
                                        <input type="file" id="immagine2" name="immagine2" accept="image/jfif, image/png, image/jpeg" class="border border-slate-400 rounded-md px-3 py-2">
                        
                                        <button type="submit" name="modifica2" class="bg-gray-900 text-white rounde  d-md px-4 py-2 font-semibold text-xl border border-slate-400 rounded-md hover:bg-gray-700/100">Carica il tuo vinile</button>
                                    </div>
                                </form>
                            </div>';
                            }
                            else{
                                echo '<div class="bg-slate-950 text-white font-bold text-xl text-center">Non è possibile modificare qquesto vinile<br>
                                    <a href="Home.php" id="home" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Torna alla Home</a>
                                    </div>';
                            }
                        }
                    }

                ?>
</body>
</html>