<?php

namespace Illuminate\Broadcasting;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Broadcast;

class BroadcastController extends Controller
{
    /**
     * Authenticate the request for channel access.
     *
     * @param Request $request
     * @return Response
     */
    public function authenticate(Request $request)
    {
        return Broadcast::auth($request);
    }
}
