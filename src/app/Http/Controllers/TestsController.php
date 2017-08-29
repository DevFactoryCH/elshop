<?php

namespace Devfactory\Elshop\app\Http\Controllers;

use Illuminate\Http\Request;

class TestsController extends Controller
{
  public function index()
  {
    return view('elshop::test');
  }
}
