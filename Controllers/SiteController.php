<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Controller;

class SiteController extends Controller
{
    public function home()
    {
        return new View('home');
    }

    public function contact()
    {
        return new View('contact');
    }

    public function about()
    {
        return new View('about');
    }
}