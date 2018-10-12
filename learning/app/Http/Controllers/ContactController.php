<?php

namespace App\Http\Controllers;

use App\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $contacts = new Contact();
//        return $allContacts;

//        $recentEmails = Contact::RecentEmails()->get();
//        echo "<pre>";
//        foreach ($recentEmails as $key) {
//            echo $key->email;
//        }
//        echo "</pre>";
        
        var_dump($contacts->amount = 15);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contact = new Contact([
            'email' => 'daniel@mutwiri.com',
            'name' => 'Daniel Mutwiri',
            'message' => "Est qui quia nulla voluptatem minus debitis. Et cum et omnis architecto. Et unde quis adipisci beatae qui blanditiis alias deleniti."
        ]);

        $contact->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sumId = Contact::sum('id');
        var_dump($sumId);
        return view('contact.show')
            ->with('contact', Contact::findorFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);
        $contact->email = "natalie@partkfamily.com";
        $contact->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();

        //or

        Contact::destroy(1);
        // delete multiple

        Contact::destroy([1, 3, 4,5]);

        //or

        Contact::where('updated_at', '<', Carbon::now()->subYear()->delete());
    }

    public function listing()
    {
        $contact = Contact::firstorCreate(['name' => 'James Controller','email' => 'jamescontroller@doe.com', 'message' => 'qwertyui 345678 345678 lkjnb fghn jkj']);

        dd($contact);
    }

    public function softDeletes()
    {
        $allHistoricContacts = Contact::withTrashed()->get();

        dd($allHistoricContacts);
    }
}
