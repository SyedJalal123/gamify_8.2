<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    protected $fillable = [ 'ticket_id', 'user_id', 'issue', 'email_username', 'wallet_address', 'order_ids', 'order_id', 'dispute_duration', 'dispute_refund_orignal_account', 'evidence_path', 'evidence', 'reported_person', 'category'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
