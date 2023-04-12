<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Webpage;

class WebContentFilter extends Controller
{
    //
    public function index (){
        $webpages = Webpage::all();
        return response(['webpages' => $webpages], 200);
    }

    public function addWebsite (Request $request){

        $webpage = Webpage::create([
            'url' => $request->url,
            'name' => $request->name,
            'category' => $request->category,
        ]);
        
        return response(['message' => 'Website added successfully'], 200);

    }

        public function deleteWebsite ($id){
            $webpage = Webpage::where('id', $id)->first();
            $webpage->delete();
            return response(['message' => 'Website with id ('. $id . ') was deleted successfully'], 200);
        
        }
}
