<?php

namespace App\Modules\Vessel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Modules\Reefer\Models\Reefer;

class Vessel extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vessel_id',
        'voyage_id',
        'ETD',
        'ETA',
    ];
    public function reefer()
    {
        return $this->hasMany(Reefer::class);
    }}
