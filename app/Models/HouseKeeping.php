<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HouseKeeping extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'HK_id',
        'reefer_id',
        'plan_position',
        'HK_time',
    ];
    public function reefer()
    {
        return $this->belongsTo(Reefer::class);
    }
}
