<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StatutController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\PersonneController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CourrierController;
use App\Http\Controllers\ItineraireController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Courrier;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('splash');
});

Route::get('/dashboard', function () {

    $Qte_janvier = 0;
    $Qte_fevrier = 0;
    $Qte_mars = 0;
    $Qte_avril = 0;
    $Qte_mai = 0;
    $Qte_juin = 0;
    $Qte_juillet = 0;
    $Qte_aout = 0;
    $Qte_septembre = 0;
    $Qte_octobre = 0;
    $Qte_novembre = 0;
    $Qte_deccembre = 0;

    $Qte_total = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

    $years = [
        2022,2023,2024,2025,2026,2027,2028,2029,2030
    ];

    $colis_en_retard = array();

    $regions = DB::table('regions')->get();

    $sites = DB::table('sites')->get();
    
    $users = DB::table('users')->get();

    $courriers = Courrier::with('users','emetteurs','recepteurs','recepteur_effectifs','coursiers','users_recept','site_recepts', 'itineraires')->get();

    $nbre_courriers = DB::table('courriers')->count();
    $nbre_courriers_interne = DB::table('courriers')->where('TypeEnvoie', '=', 'INTERNE')->count();
    $nbre_courriers_externe = DB::table('courriers')->where('TypeEnvoie', '=', 'EXTERNE')->count();
    $nbre_courriers_encours = DB::table('courriers')->where('status', '=', 'ENCOURS')->count();
    $nbre_courriers_entransit = DB::table('courriers')->where('status', '=', 'ENTRANSIT')->count();
    $nbre_courriers_receptionner = DB::table('courriers')->where('status', '=', 'RECEPTIONNER')->count();
    $nbre_courriers_livrer = DB::table('courriers')->where('status', '=', 'LIVRER')->count();
    $nbre_courriers_annuler = DB::table('courriers')->where('status', '=', 'ANNULER')->count();

    $percent_encours = 0;
    $percent_entransit = 0;
    $percent_receptionner = 0;
    $percent_livrer = 0;
    $percent_annuler = 0;

    if($nbre_courriers > 0){
        $percent_encours = ($nbre_courriers_encours/$nbre_courriers) * 100;
        $percent_encours = intval(substr($percent_encours, 0, 5));

        $percent_entransit = ($nbre_courriers_entransit/$nbre_courriers) * 100;
        $percent_entransit = intval(substr($percent_entransit, 0, 5));

        $percent_receptionner = ($nbre_courriers_receptionner/$nbre_courriers) * 100;
        $percent_receptionner = intval(substr($percent_receptionner, 0, 5));

        $percent_livrer = ($nbre_courriers_livrer/$nbre_courriers) * 100;
        $percent_livrer = intval(substr($percent_livrer, 0, 5));

        $percent_annuler = ($nbre_courriers_annuler/$nbre_courriers) * 100;
        $percent_annuler = intval(substr($percent_annuler, 0, 5));
    }
    toastr()->info('BIENVENUE '. Auth::user()->fullname .' !');

    return view('dashboard', 
    [
                              'regions' => $regions,
                              'sites' => $sites,
                              'users' => $users,
                              'courriers' => $courriers,
                              'percent_encours' => $percent_encours,
                              'percent_entransit' => $percent_entransit,
                              'percent_receptionner' => $percent_receptionner,
                              'percent_livrer' => $percent_livrer,
                              'percent_annuler' => $percent_annuler,
                              'nbre_courriers' => $nbre_courriers,
                              'nbre_courriers_interne' => $nbre_courriers_interne,
                              'nbre_courriers_externe' => $nbre_courriers_externe,
                              'nbre_courriers_encours' => $nbre_courriers_encours,
                              'nbre_courriers_entransit' => $nbre_courriers_entransit,
                              'nbre_courriers_receptionner' => $nbre_courriers_receptionner,
                              'nbre_courriers_livrer' => $nbre_courriers_livrer,
                              'nbre_courriers_annuler' => $nbre_courriers_annuler,

                              'Qte_janvier' => $Qte_janvier,
                              'Qte_fevrier' => $Qte_fevrier,
                              'Qte_mars' => $Qte_mars,
                              'Qte_avril' => $Qte_avril,
                              'Qte_mai' => $Qte_mai,
                              'Qte_juin' => $Qte_juin,
                              'Qte_juillet' => $Qte_juillet,
                              'Qte_aout' => $Qte_aout,
                              'Qte_septembre' => $Qte_septembre,
                              'Qte_octobre' => $Qte_octobre,
                              'Qte_novembre' => $Qte_novembre,
                              'Qte_deccembre' => $Qte_deccembre,   
                              
                              'Qte_total' => $Qte_total,
                              'years' => $years,
                              'colis_en_retard' => $colis_en_retard,
    ]);
})->middleware(['auth'])->name('dashboard');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('regions', RegionController::class);
    Route::resource('sites', SiteController::class);
    Route::resource('statuts', StatutController::class);
    Route::resource('vehicules', VehiculeController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('courriers', CourrierController::class);
    Route::resource('postes', PosteController::class);
    Route::resource('personnes', PersonneController::class);
    Route::resource('itineraires', ItineraireController::class);


    Route::post('createPermission', [PermissionController::class, 'store'])->name('createPermission');

    Route::post('editPermission', [PermissionController::class, 'update'])->name('editPermission');

    Route::get('deletePermission', [PermissionController::class, 'destroy'])->name('deletePermission');


    
    Route::post('createUser', [UserController::class, 'store'])->name('createUser');
    Route::get('getusers', [UserController::class, 'getUsers'])->name('getusers');
    Route::get('deleteUser', [UserController::class, 'destroy'])->name('deleteUser');
    Route::put('editUser', [UserController::class, 'edit'])->name('editUser');


    Route::post('createRole', [RoleController::class, 'store'])->name('createRole');

    Route::get('deleteRole', [RoleController::class, 'destroy'])->name('deleteRole');


    Route::post('createRegion', [RegionController::class, 'store'])->name('createRegion');

    Route::post('editRegion', [RegionController::class, 'update'])->name('editRegion');

    Route::get('deleteRegion', [RegionController::class, 'destroy'])->name('deleteRegion');

    
    Route::post('createVehicule', [VehiculeController::class, 'store'])->name('createVehicule');

    Route::post('editVehicule', [VehiculeController::class, 'update'])->name('editVehicule');

    Route::get('deleteVehicule', [VehiculeController::class, 'destroy'])->name('deleteVehicule');

    Route::get('generate-vehicule', [VehiculeController::class, 'generate'])->name('generate-vehicule');

    Route::post('affectCarToPersonne', [VehiculeController::class, 'affectation'])->name('affectCarToPersonne');


    Route::post('createSite', [SiteController::class, 'store'])->name('createSite');

    Route::get('deleteSite', [SiteController::class, 'destroy'])->name('deleteSite');

    Route::post('editSite', [SiteController::class, 'update'])->name('editSite');

    Route::get('generate-site', [SiteController::class, 'generate'])->name('generate-site');



    Route::post('createStatut', [StatutController::class, 'create'])->name('createStatut');

    Route::get('deleteStatut', [StatutController::class, 'destroy'])->name('deleteStatut');

    Route::post('editStatut', [StatutController::class, 'update'])->name('editStatut');



    Route::post('createPoste', [PosteController::class, 'store'])->name('createPoste');

    Route::get('deletePoste', [PosteController::class, 'destroy'])->name('deletePoste');

    Route::post('editPoste', [PosteController::class, 'update'])->name('editPoste');


    Route::post('createPersonne', [PersonneController::class, 'store'])->name('createPersonne');

    Route::get('deletePersonne', [PersonneController::class, 'destroy'])->name('deletePersonne');

    Route::post('editPersonne', [PersonneController::class, 'update'])->name('editPersonne');

    Route::get('generation_personne', [PersonneController::class, 'generate_personne'])->name('generate-personnes');

    // Route::get('couris', [CourrierController::class, 'couri'])->name('couris');

    Route::get('couriers', [CourrierController::class, 'getcourriers'])->name('couriers');
    
    Route::post('createCourrier', [CourrierController::class, 'store'])->name('createCourrier');

    Route::put('editCourrier', [CourrierController::class, 'edit'])->name('editCourrier');

    Route::get('deleteCourrier', [CourrierController::class, 'destroy'])->name('deleteCourrier');

    Route::put('retraitCourrier', [CourrierController::class, 'retraitcourier'])->name('retraitCourrier');

    // Route::get('transitoireCourrier', [CourrierController::class, 'transitoireShow'])->name('transitoireCourrier');

    // Route::put('transitoire', [CourrierController::class, 'transit'])->name('transitoire');

    Route::get('receptCourrier', [CourrierController::class, 'receptionShow'])->name('receptCourrier');
    
    Route::post('receptionCourrier', [CourrierController::class, 'reception'])->name('receptionCourrier');

    Route::get('livCourrier', [CourrierController::class, 'livraisonShow'])->name('livCourrier');

    Route::post('livraisonCourrier', [CourrierController::class, 'livraison'])->name('livraisonCourrier');

    Route::get('archiveCourrier', [CourrierController::class, 'archive'])->name('archiveCourrier');

    Route::post('annulerCourrier', [CourrierController::class, 'annuler'])->name('annulerCourrier');

    Route::get('consultationCourrierRegion', [CourrierController::class, 'consulter'])->name('consultationCourrierRegion');

    Route::get('ihm_client', [CourrierController::class, 'suiviClient'])->name('ihm_client');

    Route::get('ihmClient', [CourrierController::class, 'suiviClientReq'])->name('ihmClient');

    
    Route::get('generate-file', [CourrierController::class, 'generate_pdf_file'])->name('generate-file');

    Route::get('generate-pdf', [CourrierController::class, 'generatePDF'])->name('generate-pdf');
    
    Route::get('generate', [CourrierController::class, 'generate'])->name('generate');

    Route::get('generate-all', [CourrierController::class, 'generateAllCourrier'])->name('generate-all');

    Route::get('preview', [CourrierController::class, 'save_courrier_preview'])->name('preview');

    Route::get('generate-pdf-date', [CourrierController::class, 'generatePDF_par_date'])->name('generate-pdf-date');
    
    Route::get('generate-pdf-journalier', [CourrierController::class, 'generatePDF_Journalier'])->name('generate-pdf-journalier');
    
    Route::get('generate-pdf-region', [CourrierController::class, 'generatePDF_par_region'])->name('generate-pdf-region');


    Route::post('createItineraireMainPage', [ItineraireController::class, 'store'])->name('createItineraireMainPage');
    Route::post('createItineraireItinPage', [ItineraireController::class, 'store'])->name('createItineraireItinPage');

    Route::post('deleteItineraire', [ItineraireController::class, 'destroy'])->name('deleteItineraire');

    Route::put('updateItineraire', [ItineraireController::class, 'update'])->name('updateItineraire');
    
    Route::get('setGraphColisParMois', [CourrierController::class, 'setGraph'])->name('setGraphColisParMois');

    Route::get('setGraphColisParRegion', [CourrierController::class, 'setGraphParRegion'])->name('setGraphColisParRegion');

    Route::get('setColisEnRetard', [CourrierController::class, 'setCourrierRetard'])->name('setColisEnRetard');
});

require __DIR__.'/auth.php';