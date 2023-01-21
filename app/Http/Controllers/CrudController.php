<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;

class CrudController extends Controller
{
    public function index(){
        return view('index');
    }

    public function register(Request $request){
        $request -> validate(
            [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]
            );
            $reg = new Registration;
            $reg->name = $request['name'];
            $reg->email = $request['email'];
            $reg->password = md5($request['password']);
            $reg->save();

            if($request){
                return redirect('/view');
            }
    }

    public function view(){
        $views = Registration::all();
        $data = compact('views');
        return view('people-view')->with($data);

    }

    public function delete($id){
        $deleting = Registration::find($id)->delete();
        return redirect()->back();

    }
}
