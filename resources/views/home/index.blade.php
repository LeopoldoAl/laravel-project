   @extends('layouts.base') <!-- We extend from the base layout -->
   @section('styles') <!-- We put the styles -->
    <link rel="stylesheet" href="{{ asset('css/manage_post/categories/css/article_category.css') }}">
   @endsection
   @section('title', 'Blog') <!-- We put the title -->

   @section('content') <!-- We define the content block -->

   <!-- We include the navbar under the content block -->
   @include('layouts.navbar')
   
<div class="slogan">
    <div class="column1">
        <h2>BLOG PART 2</h2>
    </div>
    <div class="column2">
        <p>	We have hepled to more tha 1 million of people to grow
	professionally. These articles share advices in order to get a job,, the productivity
	and laboral success in different areas of the knowledge.</p>
    </div>
</div>

<div class="article-container">
    <!-- Listar artículos -->
    @foreach($articles as $article)
    <article class="article">
        <img src="{{ asset('storage/'.$article->image) }}" class="img">
        <div class="card-body">
            <a href="{{ route('articles.show', $article->slug) }}">
                <h2 class="title">{{ Str::limit($article->title, 60, '...') }}</h2>
            </a>
            <p class="introduction">{{ Str::limit($article->introduction, 100, '...') }}</p>
        </div>
    </article>
    @endforeach
</div>
<div class="links-paginate">
    {{ $articles->links() }}
</div>
@endsection('content') <!-- We close the content block -->