<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use App\Helpers\AuthHelper;


class SetUserSession
{
    /**
     * Event Listener for user session
     *
     * @return Response
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    /**
     * Handler for user sesssions, get the user data out of the DB and save it into a session
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $userid = $event->user->id;

        // Now that we have all the subsequent data, now we can set the base users data.

        session(
            [
                'user.id' => $userid
            ]);
    }
}
