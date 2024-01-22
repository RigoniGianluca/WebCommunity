<!DOCTYPE html>
<html>
    <head>
        <title>BOH</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <div class="relative min-h-screen  grid bg-slate-950">
          <div class="flex flex-row flex-auto min-w-0 justify-itmes-center">
            <div  
            class="relative sm:w-1/2 xl:w-3/5 bg-slate-950 h-full hidden md:flex flex-auto justify-self-end p-10 overflow-hidden text-white relative bg-right bg-[length:6  00px_500px] bg-no-repeat" 
            style="background-image: url('./images/foto.png');">
            </div>
            <div class="text-white my-auto justify-self-start mr-40">
                Disc Jockey
            </div>
            <div class="flex items-center justify-left w-full w-auto h-full xl:w-1/2 p-8  p-10 lg:p-14 sm:rounded-lg rounded-none ">
                <div class="max-w-xl w-full">
                  <div class="lg:text-left text-center">
                    <div class="flex items-center justify-center ">
                        <div class="bg-slate-950 flex flex-col w-80 border border-gray-900 rounded-lg px-8 py-8">
                            <form class="flex flex-col space-y-8 mt-10" action="./Login.php" method="POST">
                                <label class="text-center text-white text-xl text-bold">Inserisci le credenziali</label> 
                                <label class="font-bold text-lg text-white " >Username:</label> 
                                <input type="text" id="username" name="username" class="border rounded-lg py-3 px-3 mt-4 bg-slate-950 border-indigo-600 placeholder-white-500 text-white">
                                <label class="font-bold text-lg text-white">Password:</label> 
                                <input type="password" id="username" name="password" placeholder="*****" class="border rounded-lg py-3 px-3 bg-slate-950 border-indigo-600 placeholder-white-500 text-white">
                                <button class="border-2 border-indigo-600 hover:bg-slate-700/50 bg-slate-950 text-white rounded-lg py-3 font-semibold">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
