<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SellerVerification;
use App\Notifications\OrderDisputedNotification;
use Illuminate\Support\Facades\Notification;

class SellerController extends Controller
{
    public function verification(Request $request){
        // dd($request->all());
        $request->validate([
            'selling_option' => 'required',
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'dob'            => 'required|date',
            'nationality'    => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'city'           => 'required|string|max:255',
            'country'        => 'required|string|max:255',
            'postal_code'    => 'required|string|max:20',
            'main_photo_1'   => 'required|image|mimes:jpeg,png,jpg',
            'main_photo_2'   => 'required|image|mimes:jpeg,png,jpg',
        ]);
    
        // Store files
        $filename_1 = time() . '.' . rand(1, 99999) . '.' . pathinfo($request->file('main_photo_1')->getClientOriginalName(), PATHINFO_EXTENSION);
        $path_1 = 'uploads/seller_verification/' . $filename_1;
        $request->file('main_photo_1')->move(public_path('uploads/seller_verification'), $filename_1);

        $filename = time() . '.' . rand(1, 99999) . '.' . pathinfo($request->file('main_photo_2')->getClientOriginalName(), PATHINFO_EXTENSION);
        $path_2 = 'uploads/seller_verification/' . $filename;
        $request->file('main_photo_2')->move(public_path('uploads/seller_verification'), $filename);

        // $path_1 = $request->file('main_photo_1')->store('seller_verification', 'public');
        // $path_2 = $request->file('main_photo_2')->store('seller_verification', 'public');
    
        // Save seller details
        $seller = Seller::where('user_id', auth()->user()->id)->first();

        if($seller == null) {
            $seller = new Seller;
        }else {
            $filePath = public_path($seller->main_photo_1);
            if ($seller->main_photo_1 && file_exists($filePath)) {
                unlink($filePath);
            }

            $filePath = public_path($seller->main_photo_2);
            if ($seller->main_photo_2 && file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $seller->user_id        = auth()->user()->id;
        $seller->selling_option = $request->selling_option;
        $seller->first_name     = $request->first_name;
        $seller->middle_name    = $request->middle_name;
        $seller->verified       = 0;
        $seller->last_name      = $request->last_name;
        $seller->dob            = $request->dob;
        $seller->nationality    = $request->nationality;
        $seller->street_address = $request->street_address;
        $seller->city           = $request->city;
        $seller->country        = $request->country;
        $seller->postal_code    = $request->postal_code;
        $seller->main_photo_1   = $path_1;
        $seller->main_photo_2   = $path_2;
        $seller->save();



        $sellerData = [
            'name'    => "{$seller->first_name} {$seller->last_name}",
            'status'  => 'Pending',
            'email'   => auth()->user()->email,
            'photo_1' => asset("$path_1"),
            'photo_2' => asset("$path_2"),
        ];

        
        // Queue Emails
        Mail::to(auth()->user()->email)->send(new SellerVerification($sellerData));
        Mail::to('gamify295@gmail.com')->send(new SellerVerification($sellerData));

        $data = [
            'title'     => 'Request',
            'data1'     => 'Seller Request(<span class="fs-11">'.$seller->user->username.'</span>)',
            'reason'     => 0,
            'link'      => url('admin/sellerRequests'),
            'admin'     => '1',
        ];

        $admins = User::where('role','admin')->get();
        Notification::send($admins, new OrderDisputedNotification($data));
        
        return redirect('/')->with('success', 'Verification submitted! Email is being processed.');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
