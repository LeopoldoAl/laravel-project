<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
//use App\Http\Controllers\CommmentController;
//use App\Http\Controllers\ArticleController;

class ControllerComment extends Controller
{
    public function __construct(){
        // Protecting the routes
        $this->middleware('can:comments.index')->only('index');
        $this->middleware('can:comments.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // comments.article_id is the alias
        // articles.id is the relation
        // But the alias c is equals to the alias comments
        // articles.title gets article title
        // users.full_name gets user name of the user that commented
        // Auth::user()->id  we get the articles from a user authenticated
        /*
            We import the class both DB as Auth with:
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Auth;
        */
        $comments = DB::table('comments')
                ->join('articles', 'comments.article_id', '=', 'articles.id')
                ->join('users', 'comments.user_id', '=', 'users.id')
                ->select('comments.id','comments.value', 'comments.description', 
                'articles.title', 'users.full_name')
                ->where('articles.user_id', '=', Auth::user()->id)
                ->orderBy('articles.id', 'desc')
                ->get();

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    /*
    public function create()
    {
        //
    }
    */
    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        /* Let's go to verify if in the article there is a comment of us. */
        // This gives us true or false depending if the user has commented wheater or not.
        $result = Comment::where('user_id', Auth::user()->id)
                            ->where('article_id', $request->article_id)
                            ->exists(); 
        /* I'm going to do a query in order to get the slud and status from the article commented */
        $article = Article::select('status', 'slug')->find($request->article_id);
        /* If it doesn't exist and if the article is public , to comment. */
        if(!$result and $article->status == 1){
            Comment::create([
                'value' => $request->value,
                'description' => $request->description,
                'user_id' => Auth::user()->id,
                'article_id' => $request->article_id,
            ]);
            return redirect()->action([ArticleController::class, 'show'], [$article->slug]);
        }else{
            return redirect()->action([ArticleController::class, 'show'], [$article->slug])
                                ->with('success-error', 'Only can comment one time!');
        }
    }

    /**
     * Display the specified resource.
     */
    /*
    public function show(Comment $comment)
    {
        //
    }
    */
    /**
     * Show the form for editing the specified resource.
     */
    /*
    public function edit(Comment $comment)
    {
        //
    }
    */
    /**
     * Update the specified resource in storage.
     */
    /*
    public function update(Request $request, Comment $comment)
    {
        //
    }
    */
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->action([ControllerComment::class, 'index'], compact('comment'))
                            ->with('success-delete', 'The comment has been removed successfully!');
    }
}
