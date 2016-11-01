@extends('admin::auth.layout')

@section('form_content')
    <div class="columns is-vcentered">
        <div class="column is-4 is-offset-4">
            <form method="POST">
                <h1 class="title">Login</h1>
                <div class="box">
                    <label class="label">Email</label>
                    <p class="control">
                        <input class="input" name="email" type="text" placeholder="jsmith@example.org">
                    </p>
                    <label class="label">Password</label>
                    <p class="control">
                        <input class="input" name="password" type="password" placeholder="●●●●●●●">
                    </p>
                    <hr>
                    <p class="control">
                        <button class="button is-primary">Login</button>
                    </p>
                </div>
                <p class="has-text-centered">
                    <a href="register.html">Register an Account</a> | <a href="#">Forgot password</a>
                </p>
            </form>
        </div>
    </div>
@endsection