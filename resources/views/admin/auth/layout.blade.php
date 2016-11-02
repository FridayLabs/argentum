@extends('admin::layout')

@section('content')
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container">
                @yield('form_content')
            </div>
        </div>
    </section>
@endsection