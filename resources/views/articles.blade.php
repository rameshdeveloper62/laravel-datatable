@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">Articles</div>
                        <div class="col-md-4 text-right"><a href="{{url('articles/create')}}" class="btn btn-sm btn-primary">Add</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @foreach($articles as $article )
                        <div class="row">
                            <div class="col-md-12">
                                <h4>{{$article->title}}</h4>
                                <div class="row">
                                    <div class="col-md-8">
                                        {{$article->body}}
                                    </div>
                                    <div class="col-md-4">
                                        <img src="{{$article->image_url}}" class="img-thumbnail img-circle" />
                                    </div>
                                </div>
                                <div class="text-right">
                                    <small>Created By {{$article->user()->value('name')}}
                                    On {{$article->created_at->diffForHumans()}}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{$articles->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
