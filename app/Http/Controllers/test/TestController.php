<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pusher\Pusher;

class TestController extends Controller
{
    public function index()
    {
        $options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );

        $pusher = new Pusher(
            '8ccdf0a85be94898fe3f',
            '930c5b09be452c643ec2',
            '1715363',
            $options
        );

        $data['message'] = 'hello world';
        $pusher->trigger('my-channel', 'my-event', $data);
        return view('test.index');
    }
}
