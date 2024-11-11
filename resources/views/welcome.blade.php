<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class="">

  <nav>
        <div class="flex items-center justify-between s">
            {{-- Le logo --}}
            <a href="#"><img src="{{ asset('images/logoTwinIT11.svg') }}" alt="logo" class="w-[30px] ml-5 mt-5"></a>
            {{-- Lien de navigation --}}
            <div class="flex space-x-5 font-bold px-5">
                <a href="#" class="rounded-lg px-2 py-2 hover:bg-blue-500 hover:border hover:text-white">Home</a>
                {{-- Verifier s'il est connecter --}}
                @auth 
                    <a href="{{ route('admin.post.create') }}" class="rounded-lg px-2 py-2 hover:bg-blue-500 hover:border hover:text-white">Admin</a>
                @else            
                    <a href="{{ route('connexion') }}" class="rounded-lg px-2 py-2 hover:bg-blue-500 hover:border hover:text-white">Connexion</a>
                @endauth
            </div> 
        </div>
    </nav>

    {{-- Formulaire de recherche --}}
    <section class="px-10 mt-10 mb-5">
        <form action="" class="pb-3 pr-2 flex items-center border-b border-b-slate-300 text-slate-300 focus-within:border-b-slate-900 focus-within:text-slate-900 transition">
            <input id="search" value="{{ request()->get('search') }}" class="px-2 w-full outline-none leading-none placeholder-slate-400" type="search" name="search" placeholder="Rechercher une information">
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                </svg>
            </button>
        </form>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-5">
        <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
            @foreach ($infos as $info)
                <div class="px-5 py-5 min-h-[150px] border rounded-lg border-black  text-center">
                    <p class="font-bold"> 
                        {{ $info->name }}
                    </p> 
                    <img src="{{ Storage::url($info->imageUrl) }}" alt="" class="w-50 mt-2 w-full h-72 object-cover">
                    <p class="tracking-wide md:tracking-tight mt-2">
                    {{ $info->description }}
                    </p>
                </div>
            @endforeach
        </div>
    </section>

    <footer class="bg-gray-900 text-center text-white py-5 mt-[150px]">
        &copy;copyright devs by Odi_IT11
    </footer>

</body>
</html>