<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class WebController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Sign Assign',
            'page_heading' => 'Sign Assign'
        ];

        return view('web/home', $data);
    }
}
