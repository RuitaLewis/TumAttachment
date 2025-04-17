<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttachmentApplication extends Model
{
    protected $fillable = [
        'user_id',
        'attachment_id',
        'status',
        'comment',
        'fit_why',
        'additional_info',
        'accurate_info'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function attachment()
    {
        return $this->belongsTo(Attachment::class);
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
    public function attachmentPosting()
    {
        return $this->hasMany(Attachment::class);
    }
    public function attachmentApplication()
    {
        return $this->hasMany(AttachmentApplication::class);
    }
    public function studentDocument()
    {
        return $this->hasMany(StudentDocument::class);
    }
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
