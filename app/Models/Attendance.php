<?php

namespace App\Models;

use App\Models\Scan;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;
    protected $filable =
    [
        'participant_id',
        'id_scan',
        'scan_at',
        'scan_by',
    ];

    public function participant()
    {
        return $this->beLongsTo(Participant::class, "particiapant_id", "id");
    }

    public function scan()
    {
        return $this->beLongsTo(Scan::class, "id_sacn", "id");
    }
}
