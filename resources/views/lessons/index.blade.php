<?php
use Backpack\CRUD\CrudTrait; // <------------------------------- this one
use Spatie\Permission\Traits\HasRoles;// <---------------------- and this one
use Illuminate\Foundation\Auth\User as Authenticatable;

?>

@extends('layouts.app')

{{--@section('title', $page->title)--}}

@section('content')

    <h3>Lessons</h3>

    @if(count($lessons) > 0)

		@php($i = 0)

        <div id="lessons">
            <div class="row">

                @foreach ($lessons as $lesson)

                    @if($i == 3)

                        </div> {{--end row--}}
                        <div class="row">{{--start new row--}}

				        @php ($i = 0)

                    @endif

                    <div class="col-4">

                        <a class="d-block" href="/lessons/{{$lesson->id}}">
                            <img style="width:100%;" class="thumbnail" src="uploads/lesson-images/{{$lesson->og_image}}" alt="">
                        </a>
                        <h5>{{ $lesson->title }}</h5>
                        <p>{{ $lesson->created_at }}</p>

                    </div>

				    @php ($i++)

                @endforeach

            </div>
        </div>

    @endif

@endsection