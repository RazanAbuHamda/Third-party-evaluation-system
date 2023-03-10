<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
   public function index()
   {
   return view('forms.index');
   }
    public function create(Request $request)
    {
        return view('forms.create');
    }

    public function try(Request $request)
    {
        return view('tryingAtForms.create');
    }

    public function survey () {
        return view('forms.survey');
    }
}
