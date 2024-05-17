<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;
    protected $table = 'parcels';
    protected $fillable = [
        'sender_name', 'sender_address', 'sender_contact',
        'recipient_name', 'recipient_address', 'recipient_contact',
        'type', 'from_branch_id', 'to_branch_id', 
        'weight', 'height', 'length', 'width', 'price','status'
    ];
}
