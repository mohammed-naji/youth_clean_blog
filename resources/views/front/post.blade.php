@extends('front.master')
@section('content')
<!-- Page Header-->
<?php
    $image = 'fronasset/assets/img/post-bg.jpg';
    if($post->image) {
        $image = 'uploads/'.$post->image;
    }
?>
<header class="masthead" style="background-image: url({{ asset($image) }})">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1>{{ $post->title }}</h1>
                    <h2 class="subheading">{{ $post->excerpt }}</h2>
                    <span class="meta">
                        Posted by
                        <a href="#!">{{ $post->author->name }}</a>
                        on {{ $post->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                {!! $post->body !!}
                <br>
                {{ $post->body }}
            </div>
        </div>
    </div>
</article>
@stop
