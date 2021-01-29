<?php 
use App\Models\Demande;
use Illuminate\Support\Facades\Input;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

//**********************AUTENTIFICATION**************************** */
//********************************GET********************************
//LoginController
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('admin_login');
Route::get('/login/cadre', 'Auth\LoginController@showCadreLoginForm')->name('cadre_login');

//RegisterController
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm')->name('admin_register');
Route::get('/register/cadre', 'Auth\RegisterController@showCadreRegisterForm')->name('cadre_register');

//LoginController
Route::post('/login/admin', 'Auth\LoginController@adminLogin')->name('admin_login');
Route::post('/login/cadre', 'Auth\LoginController@cadreLogin')->name('cadre_login');

//RegisterController
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('admin_register');
Route::post('/register/cadre', 'Auth\RegisterController@createCadre')->name('cadre_register');

//**********************FIN AUTENTIFICATION**************************** */


//ClientController
Route::get('/cadre', 'CadreController@index')->name('cadre');


/***************************Administrateur****************************** */
//AdminController
Route::namespace('Admin')->prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::any('/demandes/search', function () {
        $q = Input::get ('q');
        if ($q != "") {
            $demande = Demande::where('numero_dossier', 'LIKE', '%'.$q.'%')->get();
            if (count($demande) > 0){
                return redirect()->route('admin.demandes.index')->withDetails($demande)->withQuery($q);
            }
            return redirect()->route('admin.demandes.index')->withMessage('Pas de demandes trouvees. Veuillez reesayer !!!');       
        }
    })->name('recherche');
    Route::get('/collaborateurs/{id}/demande', 'DemandeController@detail',['as'=>'admin'])->name('detail');
    Route::get('/collaborateurs/delete/{id}','CollaborateurController@delete',['as'=>'admin'])->name('delete');
    Route::resource('/collaborateurs', 'CollaborateurController',['as'=>'admin']);
    Route::get('/demandes/affecte','DemandeController@affecte',['as'=>'admin'])->name('affecte');
    Route::get('/demandes/{demande}/affectation', 'DemandeController@affectation')->name('affectation');
    Route::put('/demandes/{demande}/suivie', 'DemandeController@suivre',['as'=>'admin'])->name('suivie');
    Route::put('/demandes/{demande}/affecter', 'DemandeController@affecter')->name('affecter');
    Route::get('/demandes/nonaffecte','DemandeController@nonAffecte',['as'=>'admin'])->name('non_affecte');
    Route::get('/demandes/non_traites','DemandeController@nonTraite',['as'=>'admin'])->name('non_traites');
    Route::get('/demandes/traites','DemandeController@traite',['as'=>'admin'])->name('traites');
    Route::get('/demandes/clotures','DemandeController@cloture',['as'=>'admin'])->name('cloture');
    Route::get('/demandes/nonClotures','DemandeController@nonCloture',['as'=>'admin'])->name('non_cloture');
    Route::get('/demandes/transmisClient','DemandeController@transmisClient',['as'=>'admin'])->name('transmisClient');
    Route::get('/demandes/nonTransmisClient','DemandeController@nonTransmisClient',['as'=>'admin'])->name('non_transmisClient');
    Route::get('/demandes/visa/{id}/detail','DemandeController@detailVisa',['as'=>'admin'])->name('detailVisa');
    Route::get('/demandes/visa/{id}/signe','DemandeController@suivreSigne',['as'=>'admin'])->name('suivreSigne');
    Route::get('/demandes/visa','DemandeController@visa',['as'=>'admin'])->name('visa');
    Route::get('/demandes/signe','DemandeController@signe',['as'=>'admin'])->name('signe');
    Route::get('/demandes/nonArchive','DemandeController@nonArchive',['as'=>'admin'])->name('non_archive');
    Route::get('/demandes/saisieHr','DemandeController@saisieHr',['as'=>'admin'])->name('saisieHr');
    Route::get('/demandes/nonSaisieHr','DemandeController@nonSaisieHr',['as'=>'admin'])->name('non_saisieHr');
    Route::get('/demandes/complet','DemandeController@complet',['as'=>'admin'])->name('complet');
    Route::get('/demandes/nonComplet','DemandeController@nonComplet',['as'=>'admin'])->name('non_complet');
    Route::get('/demandes/mise_a_jour', 'DemandeController@mise_a_jour',['as'=>'admin'])->name('mise_a_jour');
    Route::patch('/demandes/{id}/suivieDemande', 'DemandeController@detailDemande',['as'=>'admin'])->name('detailDemande');
    Route::resource('/demandes', 'DemandeController',['as'=>'admin']);  
});

//HomeController
Route::namespace('Respo')->prefix('home')->middleware('auth')->group(function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/demandes/traites', 'DemandeController@traite',['as'=>'home'])->name('traite');
    Route::get('/demandes/non_traites', 'DemandeController@nonTraite',['as'=>'home'])->name('non_traite');
    Route::put('/demandes/{demande}/traiter', 'DemandeController@traiter',['as'=>'home'])->name('traiter');
    Route::put('/demandes/{demande}/suivieSaisie', 'DemandeController@suivieSaisie',['as'=>'home'])->name('suivieSaisie');
    Route::put('/document/{demande}/redige', 'DocumentController@redige',['as'=>'home'])->name('redige');
    Route::put('/document/{demande}/redigeNote', 'DocumentController@redigeNote',['as'=>'home'])->name('redigeNote');
    Route::put('/document/{demande}/redigeNoteEmbauche', 'DocumentController@redigeNoteEmbauche',['as'=>'home'])->name('redigeNoteEmbauche');
    Route::get('/documents/rediger/{demande}/attestationStage','DocumentController@attestationStage',['as'=>'home'])->name('attestationStage');
    Route::get('/documents/rediger/{demande}/noteStage','DocumentController@noteStage',['as'=>'home'])->name('noteStage');
    Route::get('/documents/rediger/{demande}/noteEmbauche','DocumentController@noteEmbauche',['as'=>'home'])->name('noteEmbauche');
    Route::get('/demandes/saisie/{id}/suivie','DemandeController@signalTraiter',['as'=>'home'])->name('signalTraiter');
    Route::get('/demandes/documents', 'DemandeController@document',['as'=>'home'])->name('redaction');
    Route::resource('/documents', 'DocumentController',['as'=>'home']);
    Route::resource('/demandes', 'DemandeController',['as'=>'home']);
});


 


/*Route::get('/admin', 'HomeController@index')->name('home');
Route::resource('/admin/mouvements','Admin\MouvementController',['as'=>'admin']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');*/
