<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;


class SearchController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index () {

        $searchDetails = DB::table('donations')
            ->join('users', 'users.id', '=', 'donations.user_id')
            ->join('charities', 'donations.charity_id', '=', 'charities.id')
            ->select('donations.amount as amount','donations.created_at as created_at','users.name as user_name','charities.name as charity_name')
            ->get();
        return view ( 'donation.search' )->withDonations($searchDetails);
    }

    public function filter( Request $request )
    {
        /*$charity_id = $request['charity_id'];

        $donations = Donation::select()
            ->when($charity_id, function ($query) use ($request) {
                return $query->where(function( $query ) use( $request ) {
                    $query->where('charity_id', $request->get('charity_id'));
                    if( $request->has('user_id') ) {
                        $query->where('user_id', $request->get('user_id'));
                    }
                });
            })->get();

        return Response::json(
            [ 'success'=> true,
              'payload'=> array('donations' => $donations)
            ]
        );*/

        //$searchDetails = Donation::paginate(25);
        $searchDetails = DB::table('donations')
            ->join('users', 'users.id', '=', 'donations.user_id')
            ->join('charities', 'donations.charity_id', '=', 'charities.id')
            ->select('donations.amount as amount','donations.created_at as created_at','users.name as user_name','charities.name as charity_name')
            ->get();
        return view ( 'donation.search' )->withDonations($searchDetails);
    }
}
