<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('front.contacts');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        Contact::create($request->all());
        session()->flash('success','Message sent successfully');
        return view('front.contacts');
    }

    public function index(Request $request){
        $contacts= Contact::latest();

        if(!empty($request->get('keyword'))){
            $contacts= $contacts->where('name','like','%'.$request->get('keyword').'%');
            $contacts= $contacts->orwhere('email','like','%'.$request->get('keyword').'%');
            $contacts= $contacts->orwhere('subject','like','%'.$request->get('keyword').'%');
            $contacts= $contacts->orwhere('message','like','%'.$request->get('keyword').'%');
        }
$contacts=  $contacts->paginate(10);


 return view('admin.contact.contact',compact('contacts'));

    }
}
