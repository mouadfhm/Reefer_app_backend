<?php

namespace App\Modules\Discharge\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Modules\Reefer\Models\Reefer;
use App\Modules\Vessel\Models\Vessel;

class Discharge extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'discharge_id',
        'vessel_id',
        'reefer_id',
        'arrival_time',
    ];
    public function vessel() 
    {
        return $this->belongsTo(Vessel::class);
    }
    public function reefer()
    {
        return $this->belongsTo(Reefer::class);
    }

}
