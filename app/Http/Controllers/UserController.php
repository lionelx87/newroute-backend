<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user_service;

    public function __construct()
    {
        $this->user_service = new UserService();
    }

    public function recommend(Request $request)
    {
        $this->user_service->recommend($request->spot);
    }

    public function rate(Request $request)
    {
        $this->user_service->rate($request->spot, $request->valoration);
    }

    public function comment(Request $request)
    {
        $this->user_service->comment($request->spot, $request->message);
    }  

    public function getOpinions(Request $request)
    {
        return $this->user_service->getOpinions($request->spot);
    }

    public function visits(Request $request)
    {
        return $this->user_service->visits($request->visits);
    }

    public function getVisits(Request $request)
    {
        return $this->user_service->getVisits();
    }
}
