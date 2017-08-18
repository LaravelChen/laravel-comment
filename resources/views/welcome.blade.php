<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset(mix('css/app.css'))}}">
</head>
<style>
</style>
<body style="background: #fff;">
<div id="app">
    <div class="col-md-8 col-md-offset-2" style="margin-bottom: 50px">
        <div class="row">
            <div class="col-md-12" style="margin-top: 60px">
                <div class="panel panel-default">
                    <h2 style="padding: 0 20px">{{$post->title}}</h2>
                    <div class="panel-body">
                        <h4>{{$post->content}}</h4>
                    </div>
                </div>
            </div>
        </div>
        <h4>评论列表:</h4>
        <div class="row">
            <div class="col-md-12">
                <comment_post :user_id="{{\Auth::id()}}" :comments="{{$collections}}" :post_id="{{$post->id}}" :collections="{{$collections['root']}}"></comment_post>
            </div>
        </div>
    </div>
</div>
<script src="{{asset(mix('js/app.js'))}}"></script>
</body>
</html>