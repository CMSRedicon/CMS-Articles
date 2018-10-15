@extends('layouts.app')
@include('cms_articles_partials::head')
@include('cms_articles_partials::javascripts')
@section('content')
    <h3 class="page-title">Dodaj nowy wpis</h3>

    <div class="panel panel-default col-md-8">
        <div class="panel panel-body">
            
        {!! Form::open(['method' => 'POST', 'route' => ['admin.articles.store'], 'files' => true]) !!}

         <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('articles_description_name', 'Tytuł*', ['class' => 'control-label']) !!}
                     {!! Form::text('articles_description_name', old('articles_description_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'data-cmsr-trigger' => 'updateSlugArticle']) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('articles_description_name'))
                        <p class="help-block">
                            {{ $errors->first('articles_description_name') }}
                        </p>
                    @endif
                </div>
            </div>
         <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('articles_description_lead', 'Wstęp', ['class' => 'control-label']) !!}
                     {!! Form::text('articles_description_lead', old('articles_description_lead'), ['class' => 'form-control', 'placeholder' => '']) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('articles_description_lead'))
                        <p class="help-block">
                            {{ $errors->first('articles_description_lead') }}
                        </p>
                    @endif
                </div>
            </div>
         <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('articles_description_img_src', 'Zdjęcie główne', ['class' => 'control-label']) !!}
                    {!! Form::file('articles_description_img_src', ['class' => 'form-control', 'accept'=>'image/*']) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('articles_description_img_src'))
                        <p class="help-block">
                            {{ $errors->first('articles_description_img_src') }}
                        </p>
                    @endif
                </div>
            </div>
         <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('articles_order', 'Kolejność', ['class' => 'control-label']) !!}
                    {!! Form::number('articles_order', old('articles_order') ,['class' => 'form-control','min' => 0]) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('articles_order'))
                        <p class="help-block">
                            {{ $errors->first('articles_order') }}
                        </p>
                    @endif
                </div>
            </div>
         <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('articles_description_description', 'Treść*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('articles_description_description',old('articles_description_description') ,['class' => 'form-control', 'required'=>'', 'rows' => 5]) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('articles_description_description'))
                        <p class="help-block">
                            {{ $errors->first('articles_description_description') }}
                        </p>
                    @endif
                </div>
            </div>

            <h4 class="page-title">SEO</h3>

              <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('articles_description_seo_content[title]', 'Title(tytuł linka)*', ['class' => 'control-label']) !!}
                    {!! Form::text('articles_description_seo_content[title]',old('articles_description_seo_content.title') ,['class' => 'form-control']) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('articles_description_seo_content.title'))
                        <p class="help-block">
                            {{ $errors->first('articles_description_seo_content.title') }}
                        </p>
                    @endif
                </div>
            </div>
              <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('articles_description_seo_content[meta]', 'Meta (tagi)*', ['class' => 'control-label']) !!}
                    {!! Form::text('articles_description_seo_content[meta]',old('articles_description_seo_content.meta') ,['class' => 'form-control']) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('articles_description_seo_content.meta'))
                        <p class="help-block">
                            {{ $errors->first('articles_description_seo_content.meta') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('articles_description_seo_content[keywords]', 'Słowa kluczowe*', ['class' => 'control-label']) !!}
                    {!! Form::text('articles_description_seo_content[keywords]',old('articles_description_seo_content.keywords') ,['class' => 'form-control']) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('articles_description_seo_content.keywords'))
                        <p class="help-block">
                            {{ $errors->first('articles_description_seo_content.keywords') }}
                        </p>
                    @endif
                </div>
            </div>
            //todo podgląd
            <br>  
        </div>
    </div>

    <div class="panel panel-default col-md-4">
        <div class="panel-heading">
            Opcje
        </div>
        <div class="panel panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    
                    {!! Form::label('articles_is_public', 'Strona publiczna ?', ['class' => 'control-label']) !!}
                    {!! Form::radio('articles_is_public', 1, true) !!}
                    {!! Form::radio('articles_is_public', 0, false) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('articles_is_public'))
                        <p class="help-block">
                            {{ $errors->first('articles_is_public') }}
                        </p>
                    @endif
                   
                </div>
            </div>

        <div class="panel panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    
                    {!! Form::label('article_category_id', 'Wybierz kategorię', ['class' => 'control-label']) !!}
                    <br>
                        @if(!empty($articlesCategories))
                            @foreach ($articlesCategories as $id => $name)
                                <label class="control-label">{{$name}}</label>
                                {!! Form::radio('article_category_id', $id, $loop->first ? true : false) !!}
                                <br>
                            @endforeach

                        @endif

                        <a href="{{route('admin.articles.categories.create')}}">Dodaj nową kategorię</a>
                 
                    <p class="help-block"></p>
                    @if($errors->has('article_category_id'))
                        <p class="help-block">
                            {{ $errors->first('article_category_id') }}
                        </p>
                    @endif
                   
                </div>
            </div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        Wersja językowa
                        <br>
                        {!! getArticleLanguageCreateLinks($lang) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        Link do wpisu
                        <br>
                        
                        {!! Form::text('articles_seo_slug', old('articles_seo_slug'), ['class' => 'form-control', 'id' => 'articles_seo_slug','data-choosed-lang' => $lang]) !!}
                        @if($errors->has('articles_seo_slug'))
                            <p class="help-block">
                                {{ $errors->first('articles_seo_slug') }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 form-group">
                       Podgląd <br>
                       //todo
                    </div>
                </div>           
        </div>
    </div>
 
        {!! Form::submit('Zapisz',  ['class' => 'btn btn-danger']) !!}        
        {!! Form::close() !!}
        
    @endsection