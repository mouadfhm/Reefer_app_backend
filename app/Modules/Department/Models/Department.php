<?php

namespace App\Modules\Department\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Modules\Fonction\Models\Fonction;

class Department extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'department_id',
        'name',
    ];
    public function fonction()
    {
        return $this->hasMany(Fonction::class);
    }
}
