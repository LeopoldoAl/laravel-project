@extends('layouts.base') <!-- We extend from the base layout -->
   @section('styles') <!-- We put the styles -->
    <link rel="stylesheet" href="{{ asset('css/manage_post/categories/css/article_category.css') }}">
   @endsection
   @section('title', 'Blog') <!-- We put the title -->

   @section('content') <!-- We define the content block -->

   <!-- We include the navbar under the content block -->
   @include('layouts.navbar')
 

<div class="text-primary">
    <h2>ALL OF THE CATEGORIES</h2>
</div>

<div class="article-container">
    <!-- Listar categorías -->
    @foreach($categories as $category)
    <article class="article category">
        <img src="{{ asset('storage/'.$category->image) }}" class="img">
        <div class="card-body">
            <a href="{{ route('categories.detail', $category->slug) }}">
                <h2 class="title category fs-4">{{ $category->name }}</h2>
            </a>
        </div>
    </article>
    @endforeach
</div>

<div class="links-paginate">    
    {{ $categories->links() }}
</div>
@endsection