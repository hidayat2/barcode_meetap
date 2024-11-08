<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasFactory;



    protected $filable =
    [
        'name',
        'email',
        'phone',
        'qr_content',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class, "participant_id", "id");
    }

    public function scan()
    {
        return $this->belongsTo(Scan::class, "id_scan", "id");
    }
}
