@extends('layouts.app')
@include('cms_articles_partials::head')
@include('cms_articles_partials::javascripts')
@section('content')
    <h3 class="page-title">Edytuj wpis</h3>

    <div class="panel panel-default col-md-8">
        <div class="panel panel-body">
            
        {!! Form::model($articlesDescription, ['method' => 'POST', 'route' => ['admin.articles.update', 'article_id' => $article->id, 'articles_description_id' => $articlesDescription->id], 'files' => true]) !!}

         <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Tytuł*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-cmsr-trigger' => 'updateSlugArticle']) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
         <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('lead', 'Wstęp', ['class' => 'control-label']) !!}
                    {!! Form::text('lead', old('lead'), ['class' => 'form-control', 'placeholder' => '']) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('lead'))
                        <p class="help-block">
                            {{ $errors->first('lead') }}
                        </p>
                    @endif
                </div>
            </div>
         <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('img_src', 'Zdjęcie główne', ['class' => 'control-label']) !!}

                    @if(!empty($articlesDescription->img_src))
                        <img src="/articles/{{$articlesDescription->img_src}}" style="max-height:50px;"/>
                    @endif

                    {!! Form::file('img_src', ['class' => 'form-control', 'accept'=>'image/*']) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('img_src'))
                        <p class="help-block">
                            {{ $errors->first('img_src') }}
                        </p>
                    @endif
                </div>
            </div>

         <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', 'Treść*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description',old('description') ,['class' => 'form-control', 'required'=>'', 'rows' => 5]) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>


            <h4 class="page-title">SEO</h3>

            <div class="row">
                <div class="col-xs-12 form-group">
                    Link do wpisu
                    <br>                    
                    {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'id' => 'articles_description_slug','data-choosed-lang' => $lang]) !!}
                    @if($errors->has('slug'))
                        <p class="help-block">
                            {{ $errors->first('slug') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('articles_seo_title', 'Title(tytuł linka)', ['class' => 'control-label']) !!}
                    {!! Form::text('articles_seo_title',old('articles_seo_title') ? old('articles_seo_title') : $articlesSeo['title'] ?? null,['class' => 'form-control']) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('articles_seo_title'))
                        <p class="help-block">
                            {{ $errors->first('articles_seo_title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('articles_seo_meta', 'Meta', ['class' => 'control-label']) !!}
                    {!! Form::text('articles_seo_meta',old('articles_seo_meta') ? old('articles_seo_meta') : $articlesSeo['meta'] ?? null,['class' => 'form-control']) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('articles_seo_meta'))
                        <p class="help-block">
                            {{ $errors->first('articles_seo_meta') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('articles_seo_keywords', 'Słowa kluczowe', ['class' => 'control-label']) !!}
                    {!! Form::text('articles_seo_keywords',old('articles_seo_keywords') ? old('articles_seo_keywords') : $articlesSeo['keywords'] ?? null,['class' => 'form-control']) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('articles_seo_keywords'))
                        <p class="help-block">
                            {{ $errors->first('articles_seo_keywords') }}
                        </p>
                    @endif
                </div>
            </div>
            //todo podgląd
            <br>  
        </div>
      
      </div>
        @include('cms_articles_partials::articles_sidebar')
        
        {!! Form::hidden('articles_lang', $lang, []) !!}
        {!! Form::hidden('articles_description_id', $article['articles_description_id'], []) !!}
        
        {!! Form::submit('Zapisz',  ['class' => 'btn btn-danger']) !!}        
        {!! Form::close() !!}
       
    @endsection