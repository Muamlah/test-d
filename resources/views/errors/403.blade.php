@extends('errors.errorLayout')
@section('content')
    <div class="section section-404 p-0 m-0 height-100vh">
        <div class="row">
            <!-- 404 -->
            <div class="col s12 center-align white">
                <img src="https://demo.hermosaapp.com/images/gallery/error-2.png?v_day=20pm" class="bg-image-404" alt="">
                <h1 class="error-code m-0"> 403</h1>
                <h6 class="mb-2">ACCESS FORBIDDEN</h6>

                <a class="btn waves-effect waves-light gradient-45deg-deep-purple-blue gradient-shadow mb-4"
                   href="{{route('website.home')}}">
                    GO Home
                </a>
            </div>
        </div>
    </div>
@endsection

