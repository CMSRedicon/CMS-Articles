@extends('layouts.app')
@include('cms_articles_partials::head')
@include('cms_articles_partials::javascripts')
@section('content')
    <h3 class="page-title">Edytuj kategorię</h3>

    <div class="panel panel-default col-md-8">
        <div class="panel panel-body">
            
        {!! Form::model($articleCategoryDescription, ['method' => 'POST', 'route' => ['admin.articles.categories.update', 'article_category_desc_id' => $articleCategoryDescription->id]]) !!}

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