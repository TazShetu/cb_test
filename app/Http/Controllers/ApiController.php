<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{

    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'first_name' => 'required|string|min:1|max:191',
            'last_name' => 'required|string|min:1|max:191',
            'email' => 'required|email|unique:mysql.users,email',
            'password' => 'required|string|min:1|max:191',
        ]);
        $person = new User;
        $person->first_name = $request->first_name;
        $person->last_name = $request->last_name;
        $person->email = $request->email;
        $person->password = bcrypt($request->password);
        $person->save();
        return response()->json($person, 200);
    }


    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:1|max:191',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('passport_'.$user->id)->accessToken;
            $responseArray['user'] = $user;
            $responseArray['token'] = $token;
            return response()->json($responseArray, 200);
        } else {
            return response()->json(['error' => 'Email or Password invalid'], 401);
        }
    }


    public function page_create(Request $request)
    {
        $request->validate([
            'page_title' => 'required|string|min:1|max:191',
        ]);
        $page = new Page;
        $page->creator_id = $request->user()->id;
        $page->name = $request->page_title;
        $page->save();
        return response()->json(['success' => "Page '$page->name' has been created successfully"], 200);
    }


}
