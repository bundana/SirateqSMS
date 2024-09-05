<?php

namespace App\Http\Controllers;

use Bundana\Services\Messaging\Mnotify;
use Illuminate\Http\Request;

class SMS extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'phone' => 'required|string'
        ]);

        $input = $request->phone;

        // Split the input by new line or space
        $result = preg_split('/[\s,]+/', $input);

        // Remove any empty values if present
        $results = array_filter($result);

        // Output the result
        $recipients = [];

        foreach ($results as $phone) {
            $recipients[$phone] = $request->message;

        }
        $response = Mnotify::sendBulk($recipients);

        foreach ($response as $phone) {
            $data = json_decode($phone, true);
            if ($data && $data['success']) {
                return back()->with('success', 'Message has been sent to '.count($results).' Phone numbers');
            }
        }

        return back()->with('error', 'Fail to send sms to '.count($results).' Phone numbers, please try again later');


    }
}
