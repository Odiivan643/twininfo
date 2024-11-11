<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TwinIT11 | Info </title>
    @vite('resources/css/app.css')
</head>
<body>

    <div  class="min-h-screen flex justify-center items-center">
        <div class="bg-white w-full max-w-4xl rounded-lg shadow-lg flex">
          <!-- Section gauche: Formulaire de connexion -->
          <div class="w-1/2 p-8">
            <h2 class="text-3xl font-bold text-red-600 mb-4">Connectez-vous</h2>
            <p class="text-gray-600 mb-6">
              Connectez-vous ici pour plus d'information à propos de l'événement et à propos des films qui seront diffusés.
            </p>
      
            <form method="post" action="{{ route('authenticate') }}">
                @csrf
                <div class="mb-4">
                  <input type="email" name="email" value="{{ old('email') }}" placeholder="Adresse email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-red-600">
                </div>
                <div class="mb-4">
                  <input type="password" name="password" placeholder="Mot de passe" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-red-600">
                </div>
                <button class="w-full bg-red-600 text-white py-2 rounded-md hover:bg-red-500 transition duration-300">
                  Se connecter
                </button>
            </form>

          </div>
      
          <!-- Section droite : Image -->
          <div class="w-1/2 relative">
            <img src="{{ asset('images/logoTwinIT11.svg') }}" alt="Image" class="w-full h-full object-cover rounded-r-lg">
          </div>
        </div>
      </div>

</body>
</html>