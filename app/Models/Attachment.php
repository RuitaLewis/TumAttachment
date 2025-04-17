<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['position_id', 'description', 'organization_id'];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
