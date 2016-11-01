@extends('admin::auth.layout')

@section('form_content')
    <div class="columns is-vcentered">
        <div class="column is-4 is-offset-4">
            <h1 class="title">
                Register an Account
            </h1>
            <div class="box">
                <label class="label">Name</label>
                <p class="control">
                    <input class="input" type="text" placeholder="John Smith">
                </p>
                <label class="label">Username</label>
                <p class="control">
                    <input class="input" type="text" placeholder="jsmith">
                </p>
                <label class="label">Email</label>
                <p class="control">
                    <input class="input" type="text" placeholder="jsmith@example.org">
                </p>
                <hr>
                <label class="label">Password</label>
                <p class="control">
                    <input class="input" type="password" placeholder="●●●●●●●">
                </p>
                <label class="label">Confirm Password</label>
                <p class="control">
                    <input class="input" type="password" placeholder="●●●●●●●">
                </p>
                <hr>
                <p class="control">
                    <button class="button is-primary">Register</button>
                </p>
            </div>
            <p class="has-text-centered">
                <a href="login.html">Login</a>|<a href="#">Need help?</a>
            </p>
        </div>
    </div>
@endsection