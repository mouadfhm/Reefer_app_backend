<?php

namespace App\Modules\IssueType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class IssueType extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name'
    ];
}
