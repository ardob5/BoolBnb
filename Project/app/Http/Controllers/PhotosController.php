<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Apartment;
use Storage;

class PhotosController extends Controller
{
    // funzione per cancellare la foto selezionata
  public function delete($id) {
    $photo = Photo::findOrFail($id);
    $photo -> delete();
    Storage::disk('public') -> delete($photo -> img_path);

    return redirect() -> route('edit', $photo -> apartment -> id);
  }
}
