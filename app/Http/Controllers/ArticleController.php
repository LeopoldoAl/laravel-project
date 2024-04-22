<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    public function __construct(){
        // Protecting the routes
        $this->middleware('can:articles.index')->only('index');
        $this->middleware('can:articles.create')->only('create', 'store');
        $this->middleware('can:articles.edit')->only('edit','update');
        $this->middleware('can:articles.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Show the article in the admin
        /* 
            Auth: brings me the information about authenticated user how 'id' 'name' 'last name'
            'email' and so on.
            All of these is saved in a varable because now we go to do one condition.
        */
        $user = Auth::user();
        /* 
            This says that brings me all of the articles but if you are author, should you see my articles? 
            No, I should not.
            Then only goes to display the articles from the user that is authenticated
        */
        /* 
            The user_id is a field  with foreign key that is we define previously when we did our
            migration and we remember that article has relation with users.
        */
        $articles = Article::where('user_id', $user->id)
                        ->orderBy('id', 'desc')
                        ->simplePaginate(10);

        return view('admin.articles.index', compact('articles')); // This we go to create in hte future
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //https://laravel.com/docs/10.x/controllers#actions-handled-by-resource-controller
        /* To get categories that be publics */
        /* 
            It returns the 'id' and 'name' from the categories
            with status 1 and we must import Category
        */
        $categories = Category::select(['id', 'name'])
                                ->where('status', '1')
                                ->get();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        /*
            Form
            1. Title = 'Article 1'
            2. Slug  = 'article-1'
            3. Introduction = 'This is the first article'
            4. Image = 'photo.png'
            5. Body = 'First article in the course'
            6. Status = 1
            7. Category_id = 2
            When we send our form in the title is send it, for instead 'Article 1'
            and the slug is created from the title 'article-1', the introduction,
            the image and so on.
            we would not have the user_id but the person simply can come in here 
            and do right click, select 'inspect' and could change the id, for example 
            if he is the one user he can send what that article was created by the two user 
            and that'll be a security problem, because a person will be accessing to data 
            data from the other people. Then I will get all of the data before, 
            if we go to the Article model, I'm saying that all of the fields from 
            the form be picked up except the 'id', 'create_at', 'update_at'.
            All of these fields before will be send how a request less the id 
            and that I'm going to combine with the 'merge'. The merge is used 
            for combine the data that comes from the request with the data that I want.
        */
        /* It means where it goes the user_id, I'm going to put Auth::user and 
            access to its id, this I'm doing from the backend, not the user from
            the frontend
        */
            $request->merge([
                'user_id'=>Auth::user()->id,
            ]);
            /* 
                We save the request in a variable.
                all() is a form to get data in complete way.
                for that the models are useful or they protect us, and in this case, 
                I'm going to get the before data in complete way 
                except 'the 'id', 'create_at', 'update_at'
            */
            $article = $request->all();

            /* I'm going to validate if on the request comes any file or image */
            if($request->hasFile('image')){
                /* 
                    If the request has an imge I want to save it, in the store folder 
                    and, what is that folder? if let's go to 'public' directory 
                    to public\storage\articles, in there the image would be save it.
                */
                $article['image'] = $request->file('image')->store('articles');
            }
            
            /* Now, to save all of these information we put: */
            Article::create($article);
            
            // Now, then we redirect to index
            return redirect()->action([ArticleController::class, 'index'])
                                ->with('success-create', ' Article was created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {

        $this->authorize('published', $article); // we call the policy created
        // That only shows me five comments buf if there is more then that shows the paginator
        /* 
            Where does comments() come from? 
            If we go to the Article model is the comments() function
        */
        
        $comments = $article->comments()->simplePaginate(5);
        
        return view('subscriber.articles.show', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $this->authorize('view', $article);
        /* 
            It returns the 'id' and 'name' from the categories
            with status 1 and we must import Category
        */
        $categories = Category::select(['id', 'name'])
                                ->where('status', '1')
                                ->get();
        return view('admin.articles.edit', compact('categories', 'article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);
        // We change Request by ArticleRequest because we go to use the same rules of validation
        /* 
            What do I want to happen if the user uploads a new image? 
            I want to remove the before and to asign the new image in order to fill the folder that
            I have in here on storage directory
        */
        if($request->hasFile('image')){
            // To remove the before image
            // We import File with 'use Illuminate\Support\Facades\File;
            File::delete(public_path('storage/'.$article->image));
            //Now we asign the new image
            $article['image'] = $request->file('image')->store('articles');
        }
        // Update data
        $article->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'introduction' => $request->introduction,
            'body' => $request->body,
            'user_id' => Auth::user()->id, // we asign the id internally
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);
        /* Now redirect us to the user to the index and the copy up there */
        return redirect()->action([ArticleController::class, 'index'])
                                ->with('success-update', ' Article was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        /* I want that if I remove  an article then also to delete its image */
        /* Delete image from the article */
        if($article->image){
            File::delete(public_path('storage/' . $article->image));
        }
        /* We remove the article */
        $article->delete();
        /* Let's go to the user to index page */
        return redirect()->action([ArticleController::class, 'index'])
                                ->with('success-delete', ' Article was deleted successfully!');

    }
}
