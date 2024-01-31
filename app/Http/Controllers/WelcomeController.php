<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\TruckType;
use App\Models\Page;
use App\Models\Item;

class WelcomeController extends Controller
{
    public function index($slug = null, $subslug = null)
    {
        $pages = Page::whereNull('parent_id')->get();
        if($slug == 'about' && $subslug == null) {
            $abouts = Item::where('type', 'about-us')->get();
            return view('about', compact('pages', 'abouts'));
        } 
        return view('welcome', compact('pages'));

    }// end of index

}//end of controller
