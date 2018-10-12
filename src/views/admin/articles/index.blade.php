@extends('layouts.app')
@include('cms_articles_partials::head')
@include('cms_articles_partials::javascripts')
@section('content')
    <h3 class="page-title">@lang('cms_articles_lang::articles.articles_title')</h3>
    {{--  <p>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>  --}}

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
                                <td>{!! getArticleLanguageLinks($article->id) !!}</td>
                                <td>
                                {!! Form::text('order['.$article->id.']', old('order.' . $article->id) ? old('order.' . $article->id) : $article->order, []) !!}
                                </td>
                                <td>@include('cms_articles_partials::is_public_radio', ['article_id' => $article->id, 'checked' => $article->is_public])</td>
                            </tr>
                        @endforeach

                        {!! Form::submit('Zapisz kolejność', []) !!}
                        
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
 
 