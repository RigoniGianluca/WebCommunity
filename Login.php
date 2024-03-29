<!DOCTYPE html>
<html>
    <head>
        <title>LOGIN</title>
        <script src="https://cdn.tailwindcss.com"></script>

        <?php
        require_once ('DBConn.php');
        $conn = new DBConn();

        $conn->conn->query("CREATE DATABASE IF NOT EXISTS WebCommunity");
        $conn->conn->query("USE WebCommunity");

        $conn->conn->query( "CREATE TABLE IF NOT EXISTS users (
                        username VARCHAR(40) NOT NULL,
                        password VARCHAR(64) NOT NULL,
                        email VARCHAR(128) NOT NULL,
                        PRIMARY KEY (username))");

        if(isset($_COOKIE['utente'])){
            Header('Location: Home.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($_POST['username']==null || $_POST['password']==null){
                echo '<div class="bg-slate-950 text-white font-bold text-xl text-center">Compila tutti i campi</div>';
            }
            else{
                $username = $_POST['username'];
                $password = $_POST['password'];
                $ashedpw = "";

                $query = $conn->conn->query("SELECT * FROM users WHERE username = '$username'");
                // ... = $query->fetch_assoc();     //risultato della query
                if($query->num_rows>0) {
                    $result = $query->fetch_assoc();
                    $ashedpw = $result['password'];

                    if(password_verify($password, $ashedpw))
                    //Accesso consentito
                    if (!isset($_COOKIE['utente'])) {
                        $cookie_name = 'utente';
                        $cookie_value = $username;
                        setcookie($cookie_name, $cookie_value, time() + (3600 * 15), "/"); // 86100 = 1 day  3600 = 1 ora
                        Header('Location: Home.php');
                        exit;
                    }
                }
                else {
                    //Accesso negato
                    echo '<div class="bg-slate-950 text-white font-bold text-xl text-center">Credenziali utente errate</div>';
                }
            }
        }
        ?>

    </head>
    <body>

        <div class="min-h-screen  grid bg-slate-950">
          <div class="flex flex-row flex-auto justify-itmes-center w-90">
            <div
            class="bg-slate-950 h-full flex flex-auto justify-self-end p-10 overflow-hidden text-white relative bg-right bg-[length:6  00px_500px] bg-no-repeat aspect-square"
            style="background-image: url('./images/foto.png');">
            </div>
            <div class="text-white my-auto justify-self-start font-bold text-3xl w-90">
                Disc Jockey
            </div>
            <div class="flex items-center justify-left w-full w-auto h-full xl:w-1/2 p-8  p-10 lg:p-14 sm:rounded-lg rounded-none ">
                <div class="max-w-xl w-full">
                  <div class="lg:text-left text-center">
                    <div class="flex items-center justify-center ">
                        <div class="bg-slate-950 flex flex-col w-80 border border-gray-900 rounded-lg px-8 py-8">
                            <form class="flex flex-col space-y-8 mt-10" action="./Login.php" method="POST">
                                <label class="text-center text-white text-xl font-semibold">Inserisci le credenziali</label>
                                <label class="font-bold text-lg text-white " >Username:</label>
                                <input type="text" id="username" name="username" class="border rounded-lg py-3 px-3 mt-4 bg-slate-950 border-indigo-600 placeholder-white-500 text-white">
                                <label class="font-bold text-lg text-white">Password:</label>
                                <input type="password" id="username" name="password" placeholder="*****" class="border rounded-lg py-3 px-3 bg-slate-950 border-indigo-600 placeholder-white-500 text-white">
                                <button class="border-2 border-indigo-600 hover:bg-slate-700/50 bg-slate-950 text-white rounded-lg py-3 font-semibold">Login</button>
                                <label class="text-white font-semibold text-gl">Non hai un account? <a href="./Register.php" class="font-bold">Registrati</a></label>
                            </form>
                        </div>
                    </div>
                  </div>
                </div>
                </div>
            </div>
            </div>
    </body>
</html>
