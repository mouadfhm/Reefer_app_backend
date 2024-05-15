<?php

namespace App\Modules\Load\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Modules\Reefer\Models\Reefer;
use App\Modules\Vessel\Models\Vessel;

class Load extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'load_id',
        'vessel_id',
        'reefer_id',
        'vessel_plan_position',
        'estimated_load_time',
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
