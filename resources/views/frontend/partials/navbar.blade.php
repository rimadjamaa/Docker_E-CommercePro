<header class="header_section">
   <div class="container">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
         <a class="navbar-brand" href="index.html"><img width="250" src="{{asset('frontend/images/logo.png')}}" alt="#" /></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class=""> </span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
               <li class="nav-item active">
                  <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                     <li><a href="{{ route('about') }}">About</a></li>
                     <li><a href="{{ route('testmonials') }}">Testimonial</a></li>
                  </ul>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('product') }}">Products</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('blog') }}">Blog</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('contact') }}">Contact</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('show_cart') }}">
                  <i class="fas fa-shopping-cart"></i>
                  </a>
               </li>
               <form class="form-inline">
                  <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                  </button>
               </form>
               @if (Route::has('login'))
               <div class="ml-auto">
                  @auth
                  <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                           @if (Auth::user()->isAdmin())
                              <a class="dropdown-item" href="{{ url('/admin/dashboard') }}">Dashboard</a>
                           @else
                              <a class="dropdown-item" href="#">Profile</a>
                           @endif
                           <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                           </form>
                        </div>
                  </div>
                  @else
                  <a href="{{ route('login') }}" class="btn btn-primary" style="background-color: #f7444e;">Log in</a>
                  @if (Route::has('register'))
                  <a href="{{ route('register') }}" class="btn btn-secondary ml-2" style="background-color: black;">Register</a>
                  @endif
                  @endauth
               </div>
               @endif
            </ul>
           
         </div>
      </nav>
   </div>
</header>
