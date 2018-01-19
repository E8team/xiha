<?php

namespace App\Http\Controllers;


use App\Support\Response\Response;

class APIController extends Controller
{
    /**
     * @return Response
     */
    public function response(){
        return app(Response::class);
    }
}
