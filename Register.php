<!DOCTYPE html>
<html>
    <head>
        <title>REGISTER</title>
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



        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if($_POST['username']==null || $_POST['email']==null || $_POST['password']==null || $_POST['confermaPassword']==null){
                echo '<div class="bg-slate-950 text-white font-bold text-xl text-center">Compila tutti i campi</div>';
            }
            else{

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['confermaPassword'];



                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    echo '<div class="bg-slate-950 text-white font-bold text-xl text-center">Formato email non valida</div>';
                }
                else if ($password != $cpassword) {
                    echo '<div class="bg-slate-950 text-white font-bold text-xl text-center">Le password non coincidono</div>';
                }
                else {
                    $checkQuery = $conn->conn->query("SELECT * FROM users WHERE username = '$username'");
                    $checkQuery2 = $conn->conn->query("SELECT * FROM users WHERE email = '$email'");
                    // ... = $query->fetch_assoc();     //risultato della query
                    if($checkQuery->num_rows>0 || $checkQuery2->num_rows>0) {
                        echo '<div class="bg-slate-950 text-white font-bold text-xl text-center">Nome utente o email già in uso</div>';
                    }
                    else {
                        $hashpassword = password_hash($password, PASSWORD_DEFAULT);
                        $query = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
                        $stmt = $conn->conn->prepare($query);
                        $stmt->bind_param('sss', $username, $hashpassword, $email);

                        $result = $stmt->execute();

                        if($result){
                            Header('Location: ./Login.php');
                            exit;
                        }
                        else
                            echo '<div class="bg-slate-950 text-white font-bold text-xl text-center">Registrazione non andata a buon fine</div>';

                        $stmt->close();
                    }
                }
            }
        }
        ?>
    </head>
    <body>
    
    <div class="min-h-screen  grid bg-slate-950">
        <div class="flex flex-row flex-auto justify-itmes-center w-90">
            <div
                class="bg-slate-950 h-full flex flex-auto justify-self-end p-10 overflow-hidden text-white relative bg-right bg-[length:6  00px_500px] bg-no-repeat"
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
                                <form class="flex flex-col space-y-4 mt-10" action="./Register.php" method="POST">
                                    <label class="text-center text-white text-xl font-semibold">Inserisci le credenziali</label>
                                    <label class="font-bold text-lg text-white " >Username:</label>
                                    <input type="text" id="username" name="username" class="border rounded-lg py-3 px-3 mt-4 bg-slate-950 border-indigo-600 placeholder-white-500 text-white">
                                    <label class="font-bold text-lg text-white " >Mail:</label>
                                    <input type="text" id="email" name="email" class="border rounded-lg py-3 px-3 mt-4 bg-slate-950 border-indigo-600 placeholder-white-500 text-white">
                                    <label class="font-bold text-lg text-white">Password:</label>
                                    <input type="password" id="password" name="password" placeholder="*****" class="border rounded-lg py-3 px-3 bg-slate-950 border-indigo-600 placeholder-white-500 text-white">
                                    <label class="font-bold text-lg text-white">Conferma Password:</label>
                                    <input type="password" id="confermaPassword" name="confermaPassword" placeholder="*****" class="border rounded-lg py-3 px-3 bg-slate-950 border-indigo-600 placeholder-white-500 text-white">
                                    <button class="border-2 border-indigo-600 hover:bg-slate-700/50 bg-slate-950 text-white rounded-lg py-3 font-semibold">Registrati</button>
                                    <label class="text-white font-semibold text-gl">Sei già registrato? <a href="./Login.php" class="font-bold">Accedi</a></label>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </body>
</html>
