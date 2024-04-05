<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\Material;
use App\Models\Maintenance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    
    public function index()
    {
        $hour = now()->hour;
        if ($hour >= 5 && $hour < 12) {
            $greeding = 'Good morning! ';
        } elseif ($hour >= 12 && $hour < 17) {
            $greeding = 'Good afternoon! ';
        } elseif ($hour >= 17 && $hour < 24) {
            $greeding =  'Good evening! ';
        } 
        $greeding .= Auth::user()->name;
        return view('dashboard',compact('greeding'));
    }

}
