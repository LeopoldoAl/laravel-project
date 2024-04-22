<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function __construct(){
        // Protecting the routes
        $this->middleware('can:categories.index')->only('index');
        $this->middleware('can:categories.create')->only('create', 'store');
        $this->middleware('can:categories.edit')->only('edit','update');
        $this->middleware('can:categories.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Show categories in the admin
        $categories = Category::orderBy('id', 'desc')
                            ->simplePaginate(8);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // We return the view that we redirect us to the form by creating categories.
        /*
            admin is a folder what it will be named like this 
            and inside this folder it will be other one folder it will be named categories
            create goes to be the view.
        */
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        // 
        $category = $request->all();

        /* We validate if there is one file on the request */
        if($request->hasFile('image')){
            $category['image'] = $request->file('image')->store('categories');
        }
        /* We save information */
        Category::create($category);
        /* Now we go to redirect to index in order to show me 'category created succsssfully' */
        return redirect()->action([CategoryController::class, 'index'])
                        ->with('success-create', 'Category was created successfully!');

    }

    /**
     * Display the specified resource.
     */
    /*
    public function show(Category $category)
    {
        //
    }
    */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // It returns the admin.categories.edit view.
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        /* We basically go to do like we did on the ArticleController */
        // If the user uploaded an image we do this.
        if($request->hasFile('image')){
            // We remove the before image and import the 'use Illuminate\Support\Facades\File;' at the beginning 
            // from this file
            File::delete(public_path('storage/' . $category->image));
            // We assign the new image
            $category['image'] = $request->file('image')->store('categories');
        }
        /* Upadate data */
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
            'is_featured' => $request->is_featured
        ]);
        /* Now, we redirect to index */
        return redirect()->action([CategoryController::class, 'index'], compact('category'))
                        ->with('success-update', 'Category was created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // It removes image from the category in order to delete obsolete file
        if($category->image){
            File::delete(public_path('storage/' . $category->image));
        }
        // Now, we remove the category
        $category->delete();
        // Lasting we return to index
        return redirect()->action([CategoryController::class, 'index'], compact('category'))
                        ->with('success-delete', 'Category was deleted successfully!');
    }
    /* To filter atricles by categories */
    public function detail(Category $category){

        $this->authorize('published', $category);
        /* 
            It stores those article that matches with one category, 
            it wil be the category that we are passing it, that be publics. 
        */
        $articles = Article::where([
            ['category_id', $category->id],
            ['status', '1'],
        ])
            ->orderBy('id', 'desc')
            ->simplePaginate(5);
       /* Also I'm going to program the $navbar variable, and will go HomeController.php */
       $navbar = Category::where([
        ['status', '1'],
        ['is_featured', '1'],
        ])->paginate(3);

        return view('subscriber.categories.detail', compact('articles', 'category', 'navbar'));
    }
}
