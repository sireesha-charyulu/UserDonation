<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Donation;
use App\Charity;
use App\User;
use Response;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //return view('donation.search');
    }

    public function create( Request $request )
    {

    }

    public function store( Request $request )
    {
        //Validate the input parameters before creating billing and donation objects.
        $validator  = Validator::make($request->all(), [
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zip' => 'required | numeric'
        ]);

        if ($validator->fails()) {

            return Response::json(
                [ 'success'=> false,
                  'exception_code' => '6666',
                  'payload'=> array("error" => $validator->messages() )
                ]
            );
        }

        $user = User::find($request['user_id']);

        try{

            $billing = new Billing();
            $billing->address_street = $request['street'];
            $billing->address_city = $request['city'];
            $billing->address_state = $request['state'];
            $billing->address_country = $request['country'];
            $billing->address_zip = $request['zip'];
            $billing->user_id = $request['user_id'];
            $billing->save();

            $donation = new Donation();
            $donation->charity_id = $request['charity_id'];
            $donation->amount = $request['amount'];
            $donation->user_id = $request['user_id'];
            $donation->billing_id =$billing->id;
            $donation->save();

            //$donation->charity()->associate($donation);
            //$donation->user()->associate($user);


            if( $donation->id ) {

                $donations = DB::table("donations")
                            ->selectRaw('SUM(amount) as total_pledged, count(distinct(user_id)) as donors')
                            ->where('charity_id',$request['charity_id'])
                            ->get()->first();

                $charity = Charity::find($request['charity_id']);
                $charity->pledged = $donations->total_pledged;
                $charity->donors = $donations->donors;
                $charity->save();

                if($request['is_view']) {
                    //return view('charities.show', ['charity' => $charity ]);
                    //return redirect('charities/'.$charity->id)
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('message', 'Thank you for your donation!')
                        ->with('charity', $charity );

                }

                return Response::json(
                    [ 'success'=> true,
                        'payload'=> array('donation_id' => $donation->id)
                    ]
                );

            } else {

                return Response::json(
                    [ 'success'=> false,
                        'exception_code' => '6667',
                        'payload'=> array("error" => "Donation could not be added to the charity" )
                    ]
                );

            }

        }
        catch(\Exception $e)
        {
            //failed logic here
            return Response::json(
                [ 'success'=> false,
                    'payload'=> array("error" => $e )
                ]
            );
        }



    }

    public function load ( ) {

        $searchDetails = \Illuminate\Support\Facades\DB::table('donations')
            ->join('users', 'users.id', '=', 'donations.user_id')
            ->join('charities', 'donations.charity_id', '=', 'charities.id')
            ->select('donations.amount as amount','donations.created_at as created_at','users.name as user_name','charities.name as charity_name')
            ->get();

        $charities = \Illuminate\Support\Facades\DB::table('charities')
                    ->select('charities.id','charities.name')
                    ->get();

        $users = \Illuminate\Support\Facades\DB::table('users')
            ->select('users.id','users.name')
            ->get();

        //return view ( 'donation.search' )->with($searchDetails);
        return view('donation.search', [  'donations' => $searchDetails,
                                                'charities' => $charities,
                                                'users' => $users]);

    }

    public function filter  ( Request $request ) {

        /*$searchDetails = \Illuminate\Support\Facades\DB::table('donations')
            ->join('users', 'users.id', '=', 'donations.user_id')
            ->join('charities', 'donations.charity_id', '=', 'charities.id')
            ->select('donations.amount as amount','donations.created_at as created_at','users.name as user_name','charities.name as charity_name')
            ->get();*/

        $query = Donation::query();

        $query->when(request('charity_id', false), function ($q, $charity_id) {
            return $q->where('charities.id', $charity_id);
        });

        $query->when(request('user_id', false), function ($q, $user_id) {
            return $q->where('users.id', $user_id);
        });

        $query->leftJoin('users', 'users.id', '=', 'donations.user_id');
        $query->leftJoin('charities', 'donations.charity_id', '=', 'charities.id');
        $query->select('donations.amount as amount','donations.created_at as created_at','users.name as user_name','charities.name as charity_name');

        $searchDetails = $query->get();

        $charities = \Illuminate\Support\Facades\DB::table('charities')
            ->select('charities.id','charities.name')
            ->get();

        $users = \Illuminate\Support\Facades\DB::table('users')
            ->select('users.id','users.name')
            ->get();

        return view('donation.search', [  'donations' => $searchDetails,
            'charity_id' => request('charity_id'),
            'user_id' => request('user_id'),
            'charities' => $charities,
            'users' => $users]);
    }
}
