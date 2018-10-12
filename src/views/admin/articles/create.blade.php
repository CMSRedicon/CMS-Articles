@extends('layouts.app')
@include('cms_articles_partials::head')
@include('cms_articles_partials::javascripts')
@section('content')
    <h3 class="page-title">Dodaj nowy wpis</h3>

   <div class="panel panel-default">
    <div class="panel panel-body">
    
        
        {!! Form::open(['method' => 'POST', 'route' => ['admin.articles.store'], 'files' => true]) !!}
        

         <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('articles_description_name', 'Tytuł*', ['class' => 'control-label']) !!}
                     {!! Form::text('articles_description_name', old('articles_description_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('articles_description_name'))
                        <p class="help-block">
                            {{ $errors->first('articles_description_name') }}
                        </p>
                    @endif
                </div>
            </div>

            
           
            


        
        {!! Form::submit('Zapisz',  ['class' => 'btn btn-danger']) !!}
        

        
        {!! Form::close() !!}
        
    
    
    </div>

   </div>


    @endsection