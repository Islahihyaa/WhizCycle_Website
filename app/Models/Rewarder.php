<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rewarder extends Model
{
    use HasFactory;

    protected $table = 'redeem_point';

    protected $primaryKey = 'redeem_id';

    protected $fillable = [
        'name_rewarder',
        'logo_rewarder',
        'title_rewarder',
        'point_rewarder',
        'description_rewarder',
    ];
}
