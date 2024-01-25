<!DOCTYPE html>
<html>
    <head>
        <title>REGISTER</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['confermaPassword'];

            $usernameInUso = false;

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $message = 'Formato email non valida';
            }
            else if ($password != $cpassword) {
                $message = 'Le password non coincidono';
            } else {
                $utentiRegistrati = json_decode(file_get_contents('utenti.json'), true);

                if($utentiRegistrati != null){
                    foreach ($utentiRegistrati as $utenteRegistrato) {
                        if ($utenteRegistrato['username'] == $username || $utenteRegistrato['email'] == $email) {
                            $message = 'Nome utente o email già in uso';
                            $usernameInUso = true;
                            break;
                        }
                    }
                }

                if (!$usernameInUso) {
                    $newUtente = [
                        'username' => $username,
                        'email' => $email,
                        'password' => $password
                    ];

                    $utentiRegistrati[] = $newUtente;

                    $fileJSON = json_encode($utentiRegistrati, JSON_PRETTY_PRINT);
                    file_put_contents('utenti.json', $fileJSON);

                    Header('Location: Login.php');
                    exit();
                }
            }
        }
        ?>
    </head>
    <body>
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <!--
                          Icon when menu is closed.

                          Menu open: "hidden", Menu closed: "block"
                        -->
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!--
                          Icon when menu is open.

                          Menu open: "block", Menu closed: "hidden"
                        -->
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <img class="h-8 w-auto" src="./images/foto.png" alt="Your Company">
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <button type="button" name="home" id="home" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Home</button>
                            <button type="button" name="perTe" id="perTe" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Per Te</button>
                        </div>
                    </div>
                </div>

                <!-- Profile dropdown -->
                <div class="relative ml-3">
                    <div>
                        <button type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="https://img.favpng.com/1/4/11/portable-network-graphics-computer-icons-google-account-scalable-vector-graphics-computer-file-png-favpng-HScCJdtkakJXsS3T27RyikZiD.jpg" alt="">
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </nav>

    
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
