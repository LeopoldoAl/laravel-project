<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
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
        // Get the public articles (1)
        // We create the $article what is going to content the query
        // Article = is the model
        /* 
            This query translated is:
            Bring me, all of the articles with the status 1
            or with public status and order it, in descendent way, by id
            and only show me 10, on the main page.
            With simplePaginate: we say what shows 10 and if there is more 
            then shows me a arrow that says 'next'
        */
        $articles = Article::where('status', '1')
                    ->orderBy('id', 'desc')
                    ->simplePaginate(10);
        /* 
            Also let's go to get the categories with public satatus (1) and featured (1)
            We go to create a variable called $navbar.
            We the alternative way in order to pass the query like this:
        */
        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1'],
            ])->paginate(3);
         /* 
            Now, How do I do in order to send the information contained in the $articles  and $navbar
            to the view, in this case the view is 'home', I have two ways: 
                1) The one is return view('home')->with('artilcles', $aticles);
                2) The other one is return view('home', compact('articles', 'navbar'));
        */    
        return view('home.index', compact('articles', 'navbar'));
    }

    /*
        All the categories
        This method is not provided by laravel I am createing it, 
        but following the conventions with all in lowercase
    */
    public function all()
    {
        /*
            In here I'm going to show all the categories with the variable $categories
        */
        $categories = Category::where('status', '1')
                        ->simplePaginate(20);
        /* 
            Also let's go to get the categories with public satatus (1) and featured (1)
            We go to create a variable called $navbar.
            We the alternative way in order to pass the query like this:
        */
        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1'],
            ])->paginate(3);
        /* 
            In here let's go those variable to a view what we call it, 'home.all-categories'
            This view, we still are not created
        */
        //return view('home.all-categories', compact('categories', 'navbar'));
        return view('home.all-categories', compact('categories', 'navbar'));
    }
}
