@extends('layouts.app')

@section('content')
    <nav class="flex p-4">
        @if(auth('api')->user())
            <router-link to="/form" class="text-xl text-white mx-3 p-2" active-class="font-bold" exact>
                Add task
            </router-link>
    
            <router-link to="/" class="text-xl text-white mx-3 p-2" active-class="font-bold" exact>
                Tasks lists
            </router-link>

        @endif


        <router-link to="/login" class="text-xl text-white mx-3 p-2" active-class="font-bold" exact>
            Login
        </router-link>

        <router-link to="/register" class="text-xl text-white mx-3 p-2" active-class="font-bold" exact>
            Register
        </router-link>

    </nav>

    <div>
        <router-view></router-view>
    </div>
@endsection
