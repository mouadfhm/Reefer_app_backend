<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Reefer extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reefer_id',
        'ctr_id',
        'vessel_id',
        'ISO',
        'temperature',
        'LOP',
        'current_LOC',
        'plug_status'
    ];
    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }
    public function loads()
    {
        return $this->hasMany(Load::class);
    }
    public function disch()
    {
        return $this->hasMany(Discharge::class);
    }
    public function housekeeping()
    {
        return $this->hasMany(Housekeeping::class);
    }
    public function gate()
    {
        return $this->hasMany(Gate::class);
    }
}
