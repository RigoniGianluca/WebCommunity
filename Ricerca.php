<?php
    require_once('DBConn.php');
    require_once('CVinile.php');

    $conn = new DBConn();
    $conn->conn->query("USE WebCommunity");

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['RicercaButton'])){
            $ricerca = $_POST['ricerca'];

            $query = "SELECT * FROM vinili WHERE name=?";
            $stmt = $conn->conn->prepare($query);
            $stmt = bind_param('s', $ricerca);
            $result = $stmt->execute();
            $stmt->close();

            if ($result->num_rows > 0) {
                $x = 0;
                echo '<div class="flex flex-wrap mx-4">';
                while ($row = $result->fetch_assoc()) {
                    $Vinile = new CVinile($row["id"], $row["immagine"], $row["titolo"], $row["autore"], $row["user"], $row['descrizione']);
                    echo '<div class="w-1/4 px-4 my-4 ">
                        <div class="relative group block">
                            <img src="' . $Vinile->img . '" class="w-full max-h-80 object-center object-cover transition-opacity duration-500 ease-in-out group-hover:opacity-30">
                            <div class="absolute inset-0 pt-28 flex items-start justify-center opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
                                    <form action="./VinilePreview.php" method="POST">
                                        <input type="hidden" name="id" value="' . $Vinile->id . '">
                                        <button class="mx-4 bg-gray-800/75 text-white text-center p-4 rounded-lg flex">MOSTRA</button>
                                    </form>
                                    <form action="EditVinile.php" method="POST">
                                        <input type="hidden" name="id" value="' . $Vinile->id . '">
                                        <button name="modifica" class="mx-4 bg-gray-800/75 text-white text-center p-4 rounded-lg flex">MODIFICA</button>
                                    </form>
                                    </div>
                            <div class="absolute inset-0 pb-28 flex items-end justify-center opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
                                    <form action="EliminaVinile.php" method="POST">
                                        <input type="hidden" name="id" value="' . $Vinile->id . '">
                                        <button name="eliminaVinile" class="mx-4 bg-gray-800/75 text-white text-center p-4 rounded-lg flex">ELIMINA</button>
                                    </form>' . '
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
    }
