<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{

    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
         $this->middleware('permission:lister-utilisateur|creer-utilisateur|editer-utilisateur|supprimer-utilisateur|voir-utilisateur', ['only' => ['index','store']]);
         $this->middleware('permission:creer-utilisateur', ['only' => ['create','store']]);
         $this->middleware('permission:editer-utilisateur', ['only' => ['edit','update']]);
         $this->middleware('permission:supprimer-utilisateur', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        toastr()->info('Liste Des Utilisateurs De L\'application !');

        $sites = Site::all();

        $roles = Role::get();

        $utilisateurs = User::get();

        $courriers = DB::table('courriers')->get();

        return view('users.index', 
        [
        'sites' => $sites, 
        'roles' => $roles, 
        'utilisateurs' => $utilisateurs,
        'courriers' => $courriers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }


    public function getUsers(){
        return response()->json(User::with('sites', 'roles')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users = User::all();
        $input = $request->all();
        $good = true;
        $message = "";
        $oui = true;

        foreach ($users as $user) {
            $user_courrant = strtolower(Str::ascii(str_replace(" ", "", $user->login)));
            $user_saisi = strtolower(Str::ascii(str_replace(" ", "", $input['login'])));
            if(strcmp($user_courrant, $user_saisi) == 0){
                $oui = false;
            }
        }
        if(!$oui){
            $good = false;
            $message .= "Veuillez Modifier Votre Nom D'utilisateur Car Déja Existant !\n";
        }

        $oui = true;
        foreach ($users as $user) {
            $email_courrant = strtolower(Str::ascii(str_replace(" ", "", $user->email)));
            $email_saisi = strtolower(Str::ascii(str_replace(" ", "", $input['email'])));
            if(strcmp($email_courrant, $email_saisi) == 0){
                $oui = false;
            }
        }
        if(!$oui){
            $good = false;
            $message .= "Veuillez Modifier Votre Email Car Déja Existant !\n";
        }

        $oui = true;
        foreach ($users as $user) {
            if(Hash::check($request->input('password'), $user->password)){
                $oui = false;
            }
        }
        if(!$oui){
            $good = false;
            $message .= "Veuillez Renseigner Un Autre Mot De Passe Car Déja Existant !\n";
        }

        if($good){
            $input['telephone'] = intval($input['telephone']);
            $input['site_id'] = $input['site_id'] ? intval($input['site_id']) : NULL;
            $input['password'] = Hash::make($input['password']);
            $input['email'] = Str::ascii($input['email']);

            $user = User::create($input);
            
            $user->assignRole($request->input('roles'));

            $utilisateurs = User::get();

            $utilisateur = User::with('sites')->get()->last();
            
            toastr()->success('Utilisateur Créer Avec Succèss !');

            return response()->json([$utilisateur, $utilisateurs]);
        }else{
            return response([$message]);
        }            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
            User::where('id', '=', $request->id)->update([
                'fullname' => $request->input('fullname'),
                'matricule' => $request->input('matricule'),
                'login' => $request->input('login'),
                'password' => Hash::make($request->input('password')),
                'telephone' => intval($request->input('telephone')),
                'email' => $request->input('email'),
                'site_id' => $request->input('site_id') ? intval($request->input('site_id')) : NULL,
            ]);

            $user = User::where('id', '=', $request->id)->get()->first();

            $user->assignRole($request->input('roles'));

            toastr()->success('Utilisateur Modifier Avec Succèss !');

            return response()->json();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fullname' => ['required', 'string', 'max:255'],
            'matricule' => ['required', 'string', 'max:255', 'unique:users'],
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'telephone' => ['required', 'string', 'max:255', 'unique:users'],
            'site_id' => ['required', 'unique:users'],
            'password' => ['required', 'same:confirm-password', Rules\Password::defaults()],
            'email' => 'required|email|unique:users,email',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::find($request->id)->delete();

        toastr()->info('Utilisateur Supprimer Avec Succèss !');

        return response()->json();
    }
}
