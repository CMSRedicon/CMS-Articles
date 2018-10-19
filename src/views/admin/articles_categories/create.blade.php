@extends('layouts.app')
@include('cms_articles_partials::head')
@include('cms_articles_partials::javascripts')
@section('content')
    <h3 class="page-title">Dodaj kategorię</h3>

    <div class="panel panel-default col-md-8">
        <div class="panel panel-body">
            
        {!! Form::open(['method' => 'POST', 'route' => ['admin.articles.categories.description.store',  $articleCategory->id]]) !!}
                
        {!! Form::hidden('lang', $lang, []) !!}
        
        <div class="row">
            <div class="col-xs-12 form-group">
                <span class="form-control">{{$articleCategory->id}}</span>
            </div>
        </div>
        <div class="row">
                <div class="col-xs-12 form-group">
                    <span class="form-control">{{$lang}}</span>
                </div>
        </div>
         <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Tytuł*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>       
       </div>
    </div>
    @include('cms_articles_partials::articles_category_sidebar')
        
        {!! Form::submit('Zapisz',  ['class' => 'btn btn-danger']) !!}        
        {!! Form::close() !!}
        
    @endsection