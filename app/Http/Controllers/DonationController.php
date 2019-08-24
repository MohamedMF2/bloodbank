<?php

namespace App\Http\Controllers;

use App\DonationRequest;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donations = DonationRequest::paginate();
        return view('donations.index',compact('donations'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DonationRequest  $donationRequest
     * @return \Illuminate\Http\Response
     */
    public function show(DonationRequest $donation)
    {
        return view('donations.show',compact('donation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DonationRequest  $donationRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(DonationRequest $donationRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DonationRequest  $donationRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DonationRequest $donation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DonationRequest  $donationRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonationRequest $donation)
    {
        //$donationRequest =DonationRequest::findOrFail($id);
        $donation->delete();
       flash()->success(' Donation Request Deleted Successfully');
       return redirect(route('donation.index'));
    }

    public function search(Request $request){
        $request->validate([
            'query' =>'required'
        ]);
        $query = $request ->input('query');
        $donations = DonationRequest::where('patient_name','like','%'.$query.'%')
                                    ->orWhere('hospital_name','like','%'.$query.'%')
                                    ->orWhere('hospital_address','like','%'.$query.'%')
                                    ->orWhere('bags_number','like','%'.$query.'%')
                                    ->orWhere('phone','like','%'.$query.'%')
                                  ->get();
        return view('donations.search',compact('donations'));

    }

}
