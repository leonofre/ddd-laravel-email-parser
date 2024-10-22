<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuccessfulEmail extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $table = 'successful_emails';

    protected $fillable = [
        'affiliate_id',
        'envelope',
        'from',
        'subject',
        'dkim',
        'SPF',
        'spam_score',
        'email',
        'raw_text',
        'sender_ip',
        'to',
        'timestamp',
    ];

    protected $hidden = ['deleted_at'];

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($successfulEmail) {
            $successfulEmail->raw_text = self::parseEmail($successfulEmail->email);
        });

        static::updating(function ($successfulEmail) {
            $successfulEmail->raw_text = self::parseEmail($successfulEmail->email);
        });
    }

    /**
     * Email content parser.
     *
     * @param string $email
     * @return string
     */
    protected static function parseEmail(string $email): string
    {
        $emailContent = strip_tags($email);
        
        return $emailContent;
    }
}
