<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Privatemessage;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Transport\TransportException;

class BackendController extends Controller
{
    public function privateMessages()
    {
        $messages = Privatemessage::latest()->paginate(10);

        $messages->getCollection()->transform(function ($message) {
            $message->created_at_human = $message->created_at->diffForHumans();
            return $message;
        });

        return Inertia::render('PrivateMessages', [
            'messages' => $messages
        ]);
    }

    public function showPrivateMessage($uuid)
    {
        $message = Privatemessage::where('uuid', $uuid)->firstOrFail();

        if (!$message->is_read) {
            $message->is_read = true;
            $message->save();
        }

        return Inertia::render('PrivateMessageDetail', [
            'message' => $message
        ]);
    }

    public function replyToMessage(Request $request, $uuid)
    {
        $message = Privatemessage::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'reply' => 'required|string',
        ]);

        if (!$message->is_read) {
            $message->is_read = true;
            $message->save();
        }
        
        $new_reply = $request->input('reply');
        $replies = $message->sent_message ?? [];
        $replies[] = [
            'reply' => $new_reply,
            'replied_at' => now()->toDateTimeString(),
        ];


        // email data
        $new_reply .= "\n\n - Best regards,\n";
        $new_reply .= "Yousuf Shimul, \n\n";
        $new_reply .= "Laravel Backend Developer, \n\n";
        $new_reply .= "Mail: me@yousufshimul.com, \n";
        $new_reply .= "WhatsApp: +8801992292589, \n";
        $new_reply .= "Github: https://github.com/themespure, \n";
        $new_reply .= "Linkedin: https://www.linkedin.com/in/yousufshimul/, \n";
        $new_reply .= "Stackoverflow: https://stackoverflow.com/users/5550898/yousuf-shimul, \n";
        $new_reply .= "Facebook: https://www.facebook.com/usfshimul.me, \n";
        $new_reply .= "Instagram: https://www.instagram.com/yousufshimul.89, \n";
        

        DB::transaction(function () use ($message, $replies, $new_reply) {

            // Here you can also send the email to the user using Laravel's Mail facade
            $config = [
                'driver'     => 'sendmail',
                'sendmail'   => '/usr/sbin/sendmail -bs',
            ];

            Config::set('mail', $config);

            $smsinfo = [
                'name'          => $message->name,
                'email'         => $message->email,
                'from'          => 'me@yousufshimul.com',
                'sender_name'   => 'Yousuf Shimul',
                'subject'       => 'Reply from Developer',
                'message'       => $new_reply,
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

            // save reply to database
            $message->sent_message = $replies;
            $message->save();
        });
        

        return redirect()->route('private-messages.show', $uuid)->with('success', 'Reply sent successfully!');
    }


    // new message count
    public function newMessages()
    {
        $newMessageCount = Privatemessage::where('is_read', false)->count();

        return response()->json(['new_message_count' => $newMessageCount]);
    }


    // user
    public function showUser()
    {
        $user = auth()->user();
        return response()->json(['user' => $user]);
    }
}
