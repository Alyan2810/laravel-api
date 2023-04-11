<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
        {
            return view('frontend.contact');
        }
        public function upload(Request $request)
        {
            //p( $request->all());
            $file_name = time()."-WD.".$request->file('upload_file')->getClientOriginalExtension();
            echo $request->file('upload_file')->storeAs('public/uploads', $file_name);
        }
}
