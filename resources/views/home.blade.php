@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Welcome</div>

                    <div class="card-body">
                        <h1>Welcome to Our Application</h1>
                        <p>Thank you for visiting our site. We're glad you're here!</p>

                        @guest
                            <p>Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a>
                                to get started.</p>
                        @else
                            <p>Hello, {{ Auth::user()->name }}! We hope you enjoy using our application.</p>
                        @endguest

                        <div class="mt-4">
                            <h2>Features</h2>
                            <ul>
                                <li>Easy to use interface</li>
                                <li>Secure user authentication</li>
                                <li>Responsive design</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
