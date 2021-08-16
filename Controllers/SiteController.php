<?php

namespace App\Controllers;

use Mohamed179\Core\View;
use Mohamed179\Core\Controllers\Controller;

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