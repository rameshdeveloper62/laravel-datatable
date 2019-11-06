@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Article</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                                        
                        @if(isset($article))
                            {!! Form::model($article,array('route' => ['articles.update', $article->id], 'method' => 'PUT', "enctype"=>"multipart/form-data",'class'=>'form-horizontal','id'=>'form_validate', 'autocomplete'=>'off')) !!}
                        @else
                            {!! Form::open(['url' => url('articles/'), 'method' => 'POST', "enctype"=>"multipart/form-data",'class'=>'form-horizontal','id'=>'form_validate', 'autocomplete'=>'off']) !!}
                        @endif
                    
                        {!! Form::token() !!}

                        <fieldset class="form-group">
                            <label for="title">Title</label>
                             {{ Form::text('title', null, ['id'=>'title','class'=>$errors->has('title')?"form-control is-invalid":"form-control","placeholder"=>"Title"]) }}
                            @if($errors->has('title'))
                                <div class="text-danger small">{{$errors->first('title')}}</div>
                            @endif
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="Body">Description</label>
                            {{ Form::textarea('body', null, ['id'=>'body','class'=>$errors->has('body')?"form-control is-invalid":"form-control","placeholder"=>"Description"]) }}
                            @if($errors->has('body'))
                                <div class="text-danger small">{{$errors->first('body')}}</div>
                            @endif
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="image">Image</label>
                            <div class="custom-file">
                                {{ Form::file('image', null, ['id'=>'image','class'=>$errors->has('image')?"custom-file-input is-invalid":"form-control","placeholder"=>"Description"]) }}
                              <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            @if($errors->has('image'))
                                <div class="text-danger small">{{$errors->first('image')}}</div>
                            @endif
                        </fieldset>
                        <fieldset class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit"/>
                        </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
