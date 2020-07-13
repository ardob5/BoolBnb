<?php
namespace App\Http\Controllers;
use App\Apartment;
use App\Sponsor;
use App\Photo;
use App\Optional;
use App\Message;
use App\View;

use DB;
use Storage;
use Str;
use Auth;
use Illuminate\Http\Request;
class ApartmentsController extends Controller
{
  // INDEX
  public function index() {
    $apartments = Apartment::all();
    $apartmentWithSponsor = $this->filterApartmentWithSponsor($apartments);
    $apartments_sponsor = collect($apartmentWithSponsor) -> paginate(4);
    return view('home', compact('apartments_sponsor'));
  }
  // SEARCH
  public function search(Request $request){
    $latitude = $request -> lat;
    $longitude = $request -> lon;
    $apartments = Apartment::all();
    $apartmentWithSponsor = $this->filterApartmentWithSponsor($apartments);
    $apartmentsRadius20 = $this -> findNearestHouse($latitude , $longitude);
    $apartments_no_sponsor = collect($apartmentsRadius20) -> paginate(12);
    // dd($apartments_no_sponsor);
    return view('search', compact('apartmentWithSponsor', 'apartments_no_sponsor', 'latitude', 'longitude'));
  }
  // SHOW
  public function show($id) {
    $apartment = Apartment::findOrFail($id);
    $photos = $apartment -> photos;
    $optionals = $apartment -> optionals;
    $views = $apartment -> views;
    // dd($views);

    $view = new View();
    foreach ($views as $view) {
      $view -> apartment_id = $id;
      $view -> views_IP = $_SERVER['REMOTE_ADDR'];
      if ($view -> views_IP !== $_SERVER['REMOTE_ADDR']) {
        $view -> save();
      }
    }
    return view('show', compact('apartment', 'photos', 'optionals', 'view'));
  }
  // CREATE
  public function create() {
    return view('create_apartment');
  }
  public function store(Request $request) {
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
    $apartment = new Apartment();
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
    $apartment -> user_id = auth()->user()->id;
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
  // MY APARTMENTS
  public function myApartments() {
    $apartments = Auth::user()->apartments;
    $apartmentWithSponsor = $this->filterApartmentWithSponsor($apartments);
    $apartmentWithoutSponsor = $this->filterApartmentWithoutSponsor($apartments);
    return view('my_apartments', compact('apartmentWithSponsor', 'apartmentWithoutSponsor'));
  }
  // EDIT
  public function edit($id) {
    $apartment = Apartment::findOrFail($id);
    $optionals = Optional::all();
    if($apartment->user->id !== Auth::user()->id) {
      return redirect()->route('home');
    } else {
      return view('edit_apartment', compact('apartment', 'optionals'));
    }
  }
  // UPDATE
  public function update(Request $request, $id) {
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
    $apartment = Apartment::findOrFail($id);
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
    $apartment -> save();
    $apartment -> optionals() -> sync($validate_data['optionals']);
    if ($request->hasFile('image')) {
      $img = $request->file('image');
      if ($img->isValid()) {
        $img_ext = $img->extension();
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

  public function stats($id) {
    $apartment = Apartment::findOrFail($id);
    if($apartment->user->id !== Auth::id()) {
      return redirect()->route('home')->withSuccess('Non sei autorizzato');
    } else {
      return view('stats', compact('id'));
    }
  }

  // API
  public function statsResults(Request $request) {
    $id = $request -> id;
    $totalViews = [];
    $views_months = [];
    for ($i=1; $i < 13; $i++) {
      $views = DB::table('views')
                        ->select(DB::raw('ifnull(count(id), 0) as viewsCounter', 'created_at'), DB::raw('MONTH(created_at) month'))
                        ->where('apartment_id', '=', $id)
                        ->groupBy('month')
                        ->having('month', '=', $i)
                        ->get();
      $totalViews[] = $views;
    }
    foreach ($totalViews as $viewsArr) {
      if (count($viewsArr) < 1 ) {
        $views_months[] = 0;
      }

      foreach ($viewsArr as $i) {
        $views_months[] = $i-> viewsCounter;
      }
    }
    return $views_months;
  }

  // API
  public function messagesApt(Request $request) {
    $id = $request -> id;
    $totalMsg = [];
    $messages_months = [];

    for ($i=1; $i < 13; $i++) {
      $msg = DB::table('messages')
                        ->select(DB::raw('ifnull(count(id), 0) as messagesCounter', 'created_at'), DB::raw('MONTH(created_at) month'))
                        ->where('apartment_id', '=', $id)
                        ->groupBy('month')
                        ->having('month', '=', $i)
                        ->get();
      $totalMsg[] = $msg;
    }
    foreach ($totalMsg as $msgArr) {
      if (count($msgArr) < 1 ) {
        $messages_months[] = 0;
      }

      foreach ($msgArr as $i) {
        $messages_months[] = $i-> messagesCounter;
      }
    }
    return $messages_months;
  }

  // FUNZIONI DA RICHIAMARE
  public function filterApartmentWithSponsor($apartments) {
    $apartmentWithSponsor = [];
    foreach ($apartments as $apartment) {
      if (count($apartment -> sponsors) > 0) {
        $apartmentWithSponsor[] = $apartment;
      }
    }
    return $apartmentWithSponsor;
  }

  public function filterApartmentWithoutSponsor($apartments) {
    $apartmentWithoutSponsor = [];
    foreach ($apartments as $apartment) {
      if (count($apartment -> sponsors) < 1) {
        $apartmentWithoutSponsor[] = $apartment;
      }
    }
    return $apartmentWithoutSponsor;
  }
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

  protected function findNearestHouse($latitude, $longitude, $radius = 20) {
    $apartments = DB::table('apartments') -> selectRaw("id, title, description, price, room_number, bath_number, beds, address, image, latitude, longitude, user_id , created_at,
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
}
