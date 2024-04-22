<div class="category-container">
    <ul>
        <li class="nav-item {{ request()->routeIs('home.index') ? 'active' : '' }}">
            <a href="{{ route('home.index') }}">All</a></li>         
            
        <!-- navbar is a variable that we send us the HomeControler from the index method -->
        @foreach ($navbar as $category)
        <!-- 
            In here we go to do something called how to escape data
            For escape data we use double open curly brakets!!  !!close curly brakets
            Escape data means that we help us to prevent attact xss, and the person won't can modified 
            from the front this .
            And this code means, it's if match the category for example Redes is equal to the slug category
            then under Redes will look like a blue bar
        -->
        <li class="nav-item {{!! (Request::path()) == 'category/'.$category->slug ? 'active' : '' !!}}">
            <!-- 
                We want that when the person does click in a category look like all of the articles
                filtered by categories. This method was that we create 
                in app>Http>Controllers>CategoryController.php
            -->
            <a href="{{ route('categories.detail', $category->slug) }}">{{ $category->name }}</a>
        </li>
        @endforeach

        <!--
            If he's in all of the categories then that it's active on the other hand we left empty
        -->
        <li class="nav-item {{ request()->routeIs('home.all') ? 'active' : '' }}">
            <!-- 
                We define the route
            -->
            <a href="{{ route('home.all') }}">All of the categories</a>
        </li>

    </ul>
</div>