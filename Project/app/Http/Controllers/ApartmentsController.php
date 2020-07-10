<?php

// IMPORTO MODELLI
namespace App\Http\Controllers;
use App\Apartment;
use App\Sponsor;
use App\Photo;
use App\Optional;
use App\Message;

use DB;
use Storage;
use Str;
use Auth;

use Illuminate\Http\Request;

class ApartmentsController extends Controller
{
  // HOMEPAGE (index)[visibile] ----------------------------------------------------------------------
  public function index() {

    // prendo tutte le colonne di Apartment
    $apartments = Apartment::all();
    // filtro gli appartamenti che hanno sponsor (funzione in fondo)
    $apartmentWithSponsor = $this->filterApartmentWithSponsor($apartments);
    // riunisco e impagino gli appartamenti filtrati
    $apartments_sponsor = collect($apartmentWithSponsor) -> paginate(4);

    return view('home', compact('apartments_sponsor'));
  }

  // PAGINA DI RICERCA (search)[visibile]  ------------------------------------------------------------
  public function search(Request $request){
<<<<<<< HEAD
<<<<<<< HEAD
    // prendo tutte le colonne di Apartment
=======
    
>>>>>>> master
=======
    
>>>>>>> master
    $apartments = Apartment::all();
    // filtro gli appartamenti che hanno sponsor (funzione in fondo)
    $apartmentWithSponsor = $this->filterApartmentWithSponsor($apartments);
    // filtro gli appartamenti a un raggio definito partendo da lat e lon definita
    $apartmentsRadius20 = $this -> findNearestHouse($request -> lat , $request -> lon);
    // riunisco e impagino gli appartamenti filtrati per raggio
    $apartments_no_sponsor = collect($apartmentsRadius20) -> paginate(12);

<<<<<<< HEAD
<<<<<<< HEAD
    return view('search', compact('apartmentWithSponsor', 'apartments_no_sponsor'));
=======
=======
>>>>>>> master
    $search = $request -> search;

    // dd($apartments_no_sponsor);
    return view('search', compact('apartmentWithSponsor', 'apartments_no_sponsor', 'search'));
<<<<<<< HEAD
>>>>>>> master
=======
>>>>>>> master
  }

  // PAGINA DI DETTAGLIO APPARTAMENTO (show)[visibile] -------------------------------------------------
  public function show($id) {
    // prendo tutte le colonne di Apartment
    $apartment = Apartment::findOrFail($id);
    // ricavo le url delle foto salvate nel database
    $photos = $apartment -> photos;
    // ricavo gli optional degli appartamenti salvati nel database
    $optionals = $apartment -> optionals;

    return view('show', compact('apartment', 'photos', 'optionals'));
  }

  // PAGINA DI CREAZIONE APPARTAMENTO (create)[visibile] ----------------------------------------------
  public function create() {
    return view('create_apartment');
  }

  // PAGINA DI UPLOAD APPARTAMENTO CREATO (store)[non visibile]-----------------------------------------------
                  // request da create.blade.php
  public function store(Request $request) {

    // validazione dati presi dal form in create.blade.php, e slavataggio in variabile di dati validati
    $validate_data = $request->validate([
      'title' => 'required|alpha_num',
      'address' => 'required',
      'city' => 'required|alpha',
      'civicNumber' => 'required',
      'postCode' => 'required|integer',
      'room_number' => 'required|integer',
      'bath_number' => 'required|integer',
      'beds' => 'required|integer',
      'area' => 'required|integer',
      'price' => 'required|integer|not_in:0',
      'lat' => 'required',
      'lon' => 'required',
      'image' => 'required|mimes:jpeg,jpg,bmp,png|max:8000',
      'photos' => 'array|max:4',
      'photos.*' => 'mimes:jpeg,jpg,bmp,png|max:8000',
      'optionals' => 'array',
      'description' => 'required|string'
    ]);

    // creazione nuovo modello appartamento
    $apartment = new Apartment();

    // compilazione  dei valori del nuovo modello tramite valori presi dal form
    $apartment -> title = $validate_data['title'];
    $apartment -> address = $validate_data['address'];
    $apartment -> city = $validate_data['city'];
    $apartment -> civicNumber = $validate_data['civicNumber'];
    $apartment -> postCode = $validate_data['postCode'];
    $apartment -> room_number = $validate_data['room_number'];
    $apartment -> bath_number = $validate_data['bath_number'];
    $apartment -> beds = $validate_data['beds'];
    $apartment -> area = $validate_data['area'];
    $apartment -> price = $validate_data['price'];
    $apartment -> description = $validate_data['description'];
    $apartment -> image = "";
    $apartment -> latitude = $validate_data['lat'];
    $apartment -> longitude = $validate_data['lon'];
    // autenticazione user
    $apartment -> user_id = auth()->user()->id;
    // salvataggio dati
    $apartment -> save();

    if (!empty($validate_data['optionals'])) {
      $apartment -> optionals() -> attach($validate_data['optionals']);
    }

    if ($request->hasFile('image')) {
      $img = $request->file('image');

      if ($img->isValid()) {
        $img_ext = $img->extension();
        $img_name = Str::slug($apartment -> id . "-" . $apartment -> title);
        $img_name_with_ext = $img_name . "." . $img_ext;
        $img -> storeAs('apartments/copertina/' . $apartment -> id, $img_name_with_ext, 'public');
        $img_path = 'apartments/copertina/' . $apartment -> id . "/" . $img_name_with_ext;

        $apartment -> image = $img_path;
      }
    }
    // salvataggio dati
    $apartment -> save();

    if ($request->hasFile('photos')) {

      $images = $request->file('photos');
      foreach ($images as $image) {
        if ($image -> isValid()) {
            $photo = new Photo();
            $image_ext = $image->extension();
            $image_name = Str::slug($photo -> id . "-" . $apartment -> title . "-" . bin2hex(random_bytes(10)));
            $image_name_with_ext = $image_name . "." . $image_ext;
            $image -> storeAs('apartments/photos/' . $apartment -> id, $image_name_with_ext, 'public');
            $image_path = 'apartments/photos/' . $apartment -> id . "/" . $image_name_with_ext;

            $photo -> img_path = $image_path;
            $photo -> apartment_id = $apartment -> id;
            $photo -> save();
        }
      }
    }

    return redirect() -> route('show', $apartment -> id) -> withSuccess('Appartamento ' . $apartment -> title . ' inserito con successo');
  }


  // PAGINA DI DETTAGLIO APPARTAMENTI PERSONALI(my apartments)[visibile]-----------------------------------------------
  public function myApartments() {

    // prendo gli appartamenti dello user autenticato
    $apartments = Auth::user()->apartments;
    // filtro gli appartamenti con lo sponsor
    $apartmentWithSponsor = $this->filterApartmentWithSponsor($apartments);
    // filtro gli appartamenti senza sponsor
    $apartmentWithoutSponsor = $this->filterApartmentWithoutSponsor($apartments);

    return view('my_apartments', compact('apartmentWithSponsor', 'apartmentWithoutSponsor'));
  }



  // PAGINA DI EDITING APPARTAMENTO(edit)[visibile]---------------------------------------------------------------
  public function edit($id) {
    // prendo l'appartamento specifico che l'utente vuole modificare, tramite il richiamo del suo id
    $apartment = Apartment::findOrFail($id);
    // prendo tutti gli optional del database per permettere all'utente di aggiungerli o toglierli
    $optionals = Optional::all();

    // controllo per impedire a uno che non sia l'utente proprietario, di interagire e modificare l'apppartamento
    if($apartment->user->id !== Auth::user()->id) {
      return redirect()->route('home');
    } else {
      return view('edit_apartment', compact('apartment', 'optionals'));
    }

  }

  // PAGINA DI UPLOAD NUOVI DATI APPARTAMENTO MODIFICATI(upload)[non visibile]-----------------------------------------------
                      // request da edit.blade.php
  public function update(Request $request, $id) {

    // validazione dati presi dal form in create.blade.php, e slavataggio in variabile di dati validati
    $validate_data = $request->validate([
      'title' => 'required|alpha_num',
      'address' => 'required',
      'city' => 'required|alpha',
      'civicNumber' => 'required',
      'postCode' => 'required|integer',
      'room_number' => 'required|integer',
      'bath_number' => 'required|integer',
      'beds' => 'required|integer',
      'area' => 'required|integer',
      'price' => 'required|integer',
      'lat' => 'required',
      'lon' => 'required',
      'image' => 'mimes:jpeg,jpg,bmp,png|max:8000',
      'photos' => 'array|max:4',
      'photos.*' => 'mimes:jpeg,jpg,bmp,png|max:8000',
      'optionals' => 'array',
      'description' => 'required|string'
    ]);

    // creazione nuovo modello appartamento
    $apartment = Apartment::findOrFail($id);

    // compilazione  dei valori del nuovo modello tramite valori presi dal form
    $apartment -> title = $validate_data['title'];
    $apartment -> address = $validate_data['address'];
    $apartment -> city = $validate_data['city'];
    $apartment -> civicNumber = $validate_data['civicNumber'];
    $apartment -> postCode = $validate_data['postCode'];
    $apartment -> room_number = $validate_data['room_number'];
    $apartment -> bath_number = $validate_data['bath_number'];
    $apartment -> beds = $validate_data['beds'];
    $apartment -> area = $validate_data['area'];
    $apartment -> price = $validate_data['price'];
    $apartment -> description = $validate_data['description'];
    $apartment -> latitude = $validate_data['lat'];
    $apartment -> longitude = $validate_data['lon'];

      // salvataggio dati
    $apartment -> save();

    // sincronizzazione nuovi optionals
    $apartment -> optionals() -> sync($validate_data['optionals']);

    if ($request->hasFile('image')) {
      $img = $request->file('image');

      if ($img->isValid()) {                                                            // da dove viene la funzione isValid???????????????????????????????????????????????????
        $img_ext = $img->extension();                                                  // da dove viene la funzione extension???????????????????????????????????????????????????
        $img_name = Str::slug($apartment -> id . "-" . $apartment -> title);
        $img_name_with_ext = $img_name . "." . $img_ext;
        Storage::disk('public') -> deleteDirectory('apartments/copertina/' . $apartment -> id);
        $img -> storeAs('apartments/copertina/' . $apartment -> id, $img_name_with_ext, 'public');
        $img_path = 'apartments/copertina/' . $apartment -> id . "/" . $img_name_with_ext;
        $apartment -> image = $img_path;
        $apartment->save();
      }
    }


    if ($request->hasFile('photos')) {

      $images = $request->file('photos');
      foreach ($images as $image) {
        if ($image -> isValid()) {
          $photo = new Photo();
          $image_ext = $image->extension();
          $image_name = Str::slug($photo -> id . "-" . $apartment -> title . "-" . bin2hex(random_bytes(10)));
          $image_name_with_ext = $image_name . "." . $image_ext;
          $image -> storeAs('apartments/photos/' . $apartment -> id, $image_name_with_ext, 'public');
          $image_path = 'apartments/photos/' . $apartment -> id . "/" . $image_name_with_ext;

          $photo -> img_path = $image_path;
          $photo -> apartment_id = $apartment -> id;
          $photo -> save();
        }
      }
    }

    return redirect() -> route('show', $apartment -> id) -> withSuccess('Appartamento ' . $apartment -> title . ' modificato con successo');
  }

  // PAGINA DI CANCELLAZIONE APPARTAMENTO (delete)[non visibile] ---------------------------------------------------------------------------------------
  public function delete($id) {

    $apartment = Apartment::findOrFail($id);
    $img = $apartment -> image;

    if($apartment->user->id !== Auth::user()->id) {
      return redirect()->route('home');
    } else {
        if (Storage::disk('public') -> exists($img)) {
          Storage::disk('public') -> deleteDirectory('apartments/copertina/' . $apartment -> id);
          Storage::disk('public') -> deleteDirectory('apartments/photos/' . $apartment -> id);
        }
      $apartment -> delete();
      return redirect() -> route('my_apartments');
    }

  }

  // FUNZIONI DA RICHIAMARE ----------------------------------------------------------------------------------------------------------------

  // funzione per filtrare gli appartamenti con sponsor
  public function filterApartmentWithSponsor($apartments) {
    $apartmentWithSponsor = [];
    foreach ($apartments as $apartment) {
      if (count($apartment -> sponsors) > 0) {
        $apartmentWithSponsor[] = $apartment;
      }
    }
    return $apartmentWithSponsor;
  }

  // funzione per filtrare gli appartamenti senza sponsor
  public function filterApartmentWithoutSponsor($apartments) {
    $apartmentWithoutSponsor = [];
    foreach ($apartments as $apartment) {
      if (count($apartment -> sponsors) < 1) {
        $apartmentWithoutSponsor[] = $apartment;
      }
    }
    return $apartmentWithoutSponsor;
  }

  // funzione per salvare le informazioni del messaggio
  public function saveInformations(Request $request, $id) {

    $validate_data = $request->validate([
      'email' => 'required|email',
      'informations' => 'required|string'
    ]);

    $message = new Message();
    $message -> email = $validate_data['email'];
    $message -> text = $validate_data['informations'];
    $message -> apartment_id = $id;
    $message -> save();

    return redirect() -> route('show', $id) -> withSuccess('Messaggio inviato correttamente, riceverai una risposta a breve');

  }

  // FUNZIONE MATEMATICA PER RICAVARE UN RAGGIO DI AZIONE DELLA RICERCA TOM TOM
  protected function findNearestHouse($latitude, $longitude, $radius = 20) {

    $apartments = DB::table('apartments') -> selectRaw("id, title, description, price, room_number, bath_number, beds, address, image, latitude, longitude, user_id ,
                     ( 6371 * acos( cos( radians(?) ) *
                       cos( radians( latitude ) )
                       * cos( radians( longitude ) - radians(?)
                       ) + sin( radians(?) ) *
                       sin( radians( latitude ) ) )
                     ) AS distance", [$latitude, $longitude, $latitude])
        ->having("distance", "<", $radius)
        ->orderBy("distance",'asc')
        ->get();

    return $apartments;
  }

  public function searchFilter(Request $request) {
    
  }



}
