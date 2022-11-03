@extends('layouts.app')

@section('title' . ' - ' . $user->name)

@section('content')
    <section>
        <div class="container my-4">
            <div class="card my-3 shadow bg-white rounded">
                <div class="card-body">
                    <h1 class="card-title"> {{ $user->first_name.' '.$user->last_name    }}</h1>
                </div>
            </div>
            <div class="card mb-3">

                <div class="card-body">
                    <h1 class="card-title text-primary"> User Info </h1>
                    <p class="card-text">
                    <h4>First Name :</h4> {{ $user->first_name }} <br>
                    <h4>Last Name :</h4> {{ $user->last_name }} <br>
                    <h4>Email Address :</h4> {{ $user->email }} <br>
                    <h4>Phone Number :</h4> {{ $user->phone_number }} <br>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
<style scoped>
    h4 {
        display: inline;
    }

</style>
