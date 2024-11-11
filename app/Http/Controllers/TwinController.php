<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\LoginFormRequest;
use App\Models\Post;

class TwinController extends Controller
{
    
    
    public function home(Request $request){
        $recherche = $request->search ;
        // Faire la recherche dans les champs titres et sujet 
        if ($request->filled('search')) {
            $infos = Post::where('name', 'LIKE', '%' . $recherche . '%')
                        ->orWhere('description', 'LIKE', '%' . $recherche . '%')
                        ->paginate(8);
        } else {
            $infos = Post::paginate(8);
        }
        
        return view('welcome' , ['infos'=>$infos]);
    }

    // Afficher le formulaire d'iscription
    public function index(){
        return view('inscription');
    }
    
    
    // fonction pour enregistrer l'inscription dans le dashboard admin 
    public function store(UserFormRequest $req)
    {
        $data = $req->validated();

         // Crypter le mot de passe
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        return redirect()->route('admin.user.show', ['id' => $user->id]);
    }

    // Afficher le formulaire de connexion
    public function connexion()
    {
        return view('connexion');
    }

    // faire la validation pour l'authentification
    public function authenticate(LoginFormRequest $req) 
    {
        $data = $req->validated();

        if(Auth::attempt($data)){
            return to_route('home');
        } else {
            return to_route('connexion');
        }

        
    }
}
