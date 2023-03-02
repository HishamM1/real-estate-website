<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function index(Request $request)
    {
        return inertia('Notification/Index', [
            'notifications' => $request->user()->notifications()->paginate(10),
        ]);
    }
}
