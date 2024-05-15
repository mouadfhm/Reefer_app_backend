<?php

namespace App\Modules\Gate\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Modules\Reefer\Models\Reefer;


class Gate extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'gate_id',
        'reefer_id',
        'arrival_time',
        'type',
    ];
    public function reefer()
    {
        return $this->belongsTo(Reefer::class);
    }
}
