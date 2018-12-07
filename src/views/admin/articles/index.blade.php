@extends('layouts.app')
@include('cms_articles_partials::head')
@include('cms_articles_partials::javascripts')
@section('content')
    <h3 class="page-title">@lang('cms_articles_lang::articles.articles_title')</h3>

    <div class="panel panel-default">
        <div class="panel panel-heading">
            Dodaj Artykuł
        </div>
        <div class="panel-body">
            
            {!! Form::open(['method' => 'POST', 'route' => 'admin.articles.store']) !!}

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
 
             <div class="row">
                <div class="col-xs-12 form-group">
                    
                    {!! Form::label('is_public', 'Strona publiczna ?', ['class' => 'control-label']) !!}
                    {!! Form::radio('is_public', 1, true) !!}
                    {!! Form::radio('is_public', 0, false) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('is_public'))
                        <p class="help-block">
                            {{ $errors->first('is_public') }}
                        </p>
                    @endif
                   
                </div>
            </div>

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

                             <label class="control-label">Brak</label>
                              {!! Form::radio('article_category_id', false, false) !!}
                              <br>

                        @endif

                        <a href="{{route('admin.articles.categories.index')}}">Dodaj nową kategorię</a>
                        <br>
                        <a href="{{route('admin.articles.categories.index')}}">Zobacz wszystkie kategorie</a>
                 
                    <p class="help-block"></p>
                    @if($errors->has('article_category_id'))
                        <p class="help-block">
                            {{ $errors->first('article_category_id') }}
                        </p>
                    @endif
                   
                </div>
            </div>          
                
            {!! Form::submit('Zapisz', ['class' => 'btn btn-danger']) !!}           
            
            {!! Form::close() !!}
            

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nazwa</th>
                        <th>Edycja języka</th>
                        <th>Kolejność</th>
                        <th>Widoczność</th>
                        <th>Opcje</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($articles) > 0)
                    
                    {!! Form::open(['method' => 'POST', 'route' => ['admin.articles.order.store']]) !!}
                    
                        @foreach ($articles as $article)
                            <tr>
                                <td>{{$article->id}}</td>
                                <td>{{$article->PolishArticlesDescription->name}}</td>
                                <td>{!! getArticleLanguageEditLinks($article->id) !!}</td>
                                <td>
                                {!! Form::text('order['.$article->id.']', old('order.' . $article->id) ? old('order.' . $article->id) : $article->order, []) !!}
                                </td>
                                <td>@include('cms_articles_partials::is_public_radio', ['article_id' => $article->id, 'checked' => $article->is_public])</td>
                                <td>        
                                    <a href="{{route('admin.articles.edit', [$article->id, 'pl'])}}">Edytuj</a>
                                    <a href="{{route('admin.articles.delete', [$article->id])}}">Usuń</a>
                                    <br>
                                   //todo popup do usunięcia
                                </td>
                            </tr>
                        @endforeach

                        {!! Form::submit('Zapisz kolejność', []) !!}
                        
                        {!! Form::close() !!}
                        
                        
                    @else
                        <tr>
                            <td colspan="9">Brak danych</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
 
 