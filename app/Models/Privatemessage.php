<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Transport\TransportException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Privatemessage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'subject',
        'message',
        'sent_message',
        'is_read',
    ];

    protected $casts = [
        'sent_message' => 'array',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function getCreatedAtHumanAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->uuid) {
                $model->uuid = (string) Str::uuid();
            }
        });


        static::created(function ($model) {

            $message = "Hi Dev,\n\n";
            $message .= "Great news! You have a new private message.\n\n";
            $message .= "Message Details:\n";
            $message .= "- Name: {$model->name}\n";
            $message .= "- Email: {$model->email}\n";
            $message .= "- Subject: {$model->subject}\n";
            $message .= "- Message: {$model->message}\n\n";
            $message .= "Please check the admin dashboard to view and manage this message.\n\n";
            $message .= "Best regards,\n";
            $message .= "Co-Pilot";

            $message_for_sender = "Hi {$model->name},\n\n";
            $message_for_sender .= "Thank you for your message. I will get back to you soon.\n\n";
            $message_for_sender .= "Best regards,\n";
            $message_for_sender .= "Yousuf Shimul, \n\n";
            $message_for_sender .= "Laravel Backend Developer, \n\n";
            $message_for_sender .= "Mail: me@yousufshimul.com, \n";
            $message_for_sender .= "WhatsApp: +8801992292589, \n";
            $message_for_sender .= "Github: https://github.com/themespure, \n";
            $message_for_sender .= "Linkedin: https://www.linkedin.com/in/yousufshimul/, \n";
            $message_for_sender .= "Stackoverflow: https://stackoverflow.com/users/5550898/yousuf-shimul, \n";
            $message_for_sender .= "Facebook: https://www.facebook.com/usfshimul.me, \n";
            $message_for_sender .= "Instagram: https://www.instagram.com/yousufshimul.89, \n";

            self::SendToDeveloper($message, $model);
            self::SendToDeveloper2($message, $model);

            self::SendToSender($message_for_sender, $model);
        });

        static::updated(function ($model) {});
    }

    private static function SendToDeveloper($message, $model)
    {
        $config = [
            'driver'     => 'sendmail',
            'sendmail'   => '/usr/sbin/sendmail -bs',
        ];

        Config::set('mail', $config);

        $smsinfo = [
            'name'          => 'Yousuf',
            'email'         => 'megetinfo24@gmail.com',
            'from'          => 'me@yousufshimul.com',
            'sender_name'   => 'Notification',
            'subject'       => $model->subject,
            'message'       => $message,
        ];


        try {
            Mail::send('emails.email_template', [
                'subject'       => $smsinfo['subject'],
                'customer_name'  => $smsinfo['name'],
                'email_message' => $smsinfo['message'],
            ], function ($message) use ($smsinfo) {
                $message->from($smsinfo['from'], $smsinfo['sender_name']);
                $message->to($smsinfo['email'], $smsinfo['sender_name']);
                $message->subject($smsinfo['subject']);
            });
        } catch (\Exception $e) {
            //
        }
    }

    private static function SendToDeveloper2($message, $model)
    {
        $config = [
            'driver'     => 'sendmail',
            'sendmail'   => '/usr/sbin/sendmail -bs',
        ];

        Config::set('mail', $config);

        $smsinfo = [
            'name'          => 'Yousuf',
            'email'         => 'me@yousufshimul.com',
            'from'          => 'co-pilot@yousufshimul.com',
            'sender_name'   => 'Notification',
            'subject'       => $model->subject,
            'message'       => $message,
        ];


        try {
            Mail::send('emails.email_template', [
                'subject'       => $smsinfo['subject'],
                'customer_name'  => $smsinfo['name'],
                'email_message' => $smsinfo['message'],
            ], function ($message) use ($smsinfo) {
                $message->from($smsinfo['from'], $smsinfo['sender_name']);
                $message->to($smsinfo['email'], $smsinfo['sender_name']);
                $message->subject($smsinfo['subject']);
            });
        } catch (\Exception $e) {
            //
        }
    }

    private static function SendToSender($message, $model)
    {
        $config = [
            'driver'     => 'sendmail',
            'sendmail'   => '/usr/sbin/sendmail -bs',
        ];

        Config::set('mail', $config);

        $smsinfo = [
            'name'          => $model->name,
            'email'         => $model->email,
            'from'          => 'me@yousufshimul.com',
            'sender_name'   => 'Yousuf Shimul',
            'subject'       => 'Thank you for your message - Yousuf Shimul',
            'message'       => $message,
        ];

        try {
            Mail::send('emails.email_template', [
                'subject'       => $smsinfo['subject'],
                'customer_name'  => $smsinfo['name'],
                'email_message' => $smsinfo['message'],
            ], function ($message) use ($smsinfo) {
                $message->from($smsinfo['from'], $smsinfo['sender_name']);
                $message->to($smsinfo['email'], $smsinfo['sender_name']);
                $message->subject($smsinfo['subject']);
            });
        } catch (\Exception $e) {
            //
        }
    }


}
