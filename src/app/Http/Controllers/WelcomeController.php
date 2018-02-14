<?php

namespace Devfactory\Elshop\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class WelcomeController extends Controller
{
  public function index() {
    return view('elshop::index');
  }
  public function logout() {
    Auth::logout(); // log the user out of our application
    return view('elshop::index');
  }
}
