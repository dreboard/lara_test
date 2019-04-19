<?php

namespace App\Http\Controllers;

use App\Notifications\SiteNotification;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        cache()->put( 'cachekey', 'I am in the cache baby!', 1 );
        $posts = Post::with('tags')->orderBy('id', 'asc')->paginate();// protected $perPage = 5;
        $archives = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year','month')
            ->orderByRaw('min(created_at) desc')
            ->get();
        //dd($posts);
        //$user = auth()->user();
        //$user->notify(new SiteNotification($user));
        return view('home', ['posts' => $posts, 'archives' => $archives]);
    }
}
