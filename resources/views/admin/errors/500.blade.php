 @extends('admin.layouts.base')
 @section('content')
     <div class="w-100 banner-404 d-flex align-items-center justify-content-center">
         <div class="container-fluid">
             <div class="row no-gutters">
                 <div class="col-lg-9 col-12 mt-5 mx-auto text-center bg-white py-5">
                     <h1 class="font-weight-bold display-3 mb-0">500</h1>
                     <h2 class="mb-3 mt-2 ">oops! Server Error.</h2>
                     <h5 class="m-auto">Oops! The page you are looking for does not exist. It might have been moved
                         or
                         deleted.</h5>
                     <div class="d-flex justify-content-center flex-wrap mt-3">
                         <a href="{{ route('admin.dashboard') }}" class="home-404 py-2 rounded px-3 d-block mx-3 mt-2">Go
                             To Home Page</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
