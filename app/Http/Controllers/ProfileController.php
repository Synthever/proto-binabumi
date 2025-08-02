<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Logic to display the profile page
        return view('/profile/profile_main');
    }

     public function detail()
    {
        // Logic to display the profile page
        return view('/profile/profile_detail');
    }

     public function changepass()
    {
        // Logic to display the profile page
        return view('/profile/profile_changepass');
    }

    public function changerekening()
    {
        // Logic to display the profile page
        return view('/profile/profile_changerekening');
    }

    public function kebijakanprivasi()
    {
        // Logic to display the profile page
        return view('/profile/profile_kebijakan_privasi');
    }

    public function syaratketentuan()
    {
        // Logic to display the profile page
        return view('/profile/profile_syarat_ketentuan');
    }
}
