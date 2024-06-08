<?php

namespace App\Modules\Issue\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Modules\Reefer\Models\Reefer;


class Issue extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reefer_id',
        'type'
    ];
    public function reefer()
    {
        return $this->belongsTo(Reefer::class);
    }
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
    ];
}
