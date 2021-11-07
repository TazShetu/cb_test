<?php

namespace App\Http\Controllers;

use App\Models\{Page,Post,User,UserRelation};
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
            $token = $user->createToken('passport_' . $user->id)->accessToken;
            $responseArray['user'] = $user;
            $responseArray['token'] = $token;
            return response()->json($responseArray, 200);
        } else {
            return response()->json(['error' => 'Email or Password invalid'], 401);
        }
    }


    public function page_create(Request $request): \Illuminate\Http\JsonResponse
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


    public function follow_person($personId, Request $request): \Illuminate\Http\JsonResponse
    {
        $follow_user = User::findOrFail($personId);
        $user_relation = new UserRelation;
        abort_if($personId == $request->user()->id, 403, 'You can not follow yourself');
        $user_relation->user_id = $personId;
        $user_relation->follower_id = $request->user()->id;
        $user_relation->save();
        return response()->json(['success' => "You are following  $follow_user->first_name"], 200);
    }


    public function follow_page($pageId, Request $request): \Illuminate\Http\JsonResponse
    {
        $follow_page = Page::findOrFail($pageId);
        abort_if($follow_page->creator_id == $request->user()->id, 403, 'You are the creator of the page');
        $follow_page->followers()->attach([$request->user()->id]);
        return response()->json(['success' => "You are following  $follow_page->name"], 200);
    }


    public function attach_post(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'post_content' => 'required|string|min:1|max:65535',
        ]);
        $post = new Post;
        $post->creator_id = $request->user()->id;
        $post->content = $request->post_content;
        $post->save();
        return response()->json(['success' => "Your post has been published"], 200);
    }


    public function attach_post_in_page($pageId, Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'post_content' => 'required|string|min:1|max:65535',
        ]);
        $page = Page::findOrFail($pageId);
        abort_unless($request->user()->id == $page->creator_id, 403, "You do not own the page");
        $post = new Post;
        $post->creator_id = $request->user()->id;
        $post->page_id = $pageId;
        $post->content = $request->post_content;
        $post->save();
        return response()->json(['success' => "Your post has been published on your page"], 200);
    }


}
