<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Suggestion;
use App\Models\User;
use App\Models\Ticket;
use App\Notifications\OrderDisputedNotification;
use Illuminate\Support\Facades\Notification;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($tag)
    {
        return view('frontend.create_ticket', compact('tag'));
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
        if ($request->hasFile('evidence')) {
            $image = $request->file('evidence');

            // Generate unique filename
            $randomNumber = rand(1, 99999);
            $filename = time() . '.' . $randomNumber . '.' . $image->getClientOriginalExtension();

            // Original upload path
            $filePath = 'uploads/ticket/';
            $originalPath = public_path('uploads/ticket/' . $filename);
            $image->move(public_path('uploads/ticket'), $filename);
        }

        try {
            // Ticket::create([
            //     'ticket_id' => Str::uuid()->toString(),
            //     'user_id' => auth()->id(),
            //     'issue' => $request->issue,
            //     'email_username' => $request->email_username,
            //     'wallet_address' => $request->wallet_address,
            //     'order_ids' => $request->order_ids,
            //     'order_id' => $request->order_id,
            //     'dispute_duration' => $request->dispute_duration,
            //     'dispute_refund_orignal_account' => $request->dispute_refund_orignal_account,
            //     'evidence_path' => $filePath ?? null,
            //     'evidence' => $filename ?? null,
            //     'reported_person' => $request->reported_person,
            //     'category' => $request->tag,
            // ]);

            $data = [
                'title'     => 'Ticket',
                'data1'     => Str::headline($request->tag).' (<span class="fs-11">'.auth()->user()->username.'</span>)',
                'reason'     => '',
                'link'      => url('admin/tickets/'),
                'admin'     => '1',
            ];
            $admins = User::where('role','admin')->get();
            Notification::send($admins, new OrderDisputedNotification($data));
            
            return redirect()->back()->with('success', 'Ticket created successfully');
        } catch (\Exception $e) {
            Log::error('Ticket add failed: '.$e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while adding the ticket.');
        }
    }
    
    public function store_suggestion(Request $request) {
        try {
            Suggestion::create([
                'user_id' => auth()->id(),
                'suggestion' => $request->suggestion,
            ]);
            
            return redirect()->back()->with('success', 'Feedback added successfully');
        } catch (\Exception $e) {
            Log::error('Feedback add failed: '.$e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while adding the feedback.');
        }
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
