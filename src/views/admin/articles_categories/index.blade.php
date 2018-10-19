@extends('layouts.app')
@include('cms_articles_partials::head')
@include('cms_articles_partials::javascripts')
@section('content')
    <h3 class="page-title">Kategorie Artykułów</h3>
 
 <div class="panel panel-default">
        <div class="panel panel-heading">
            Dodaj Artykuł
        </div>
        <div class="panel-body">
            
            {!! Form::open(['method' => 'POST', 'route' => 'admin.articles.categories.store']) !!}

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('position', 'Pozycja*', ['class' => 'control-label']) !!}
                     {!! Form::text('position', old('position'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('position'))
                        <p class="help-block">
                            {{ $errors->first('position') }}
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
            Wszystkie Kategorie
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Pozycja</th>
                        <th>Dodana</th>
                        <th>Akcja</th>
              
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($articlesCategories) > 0)
                       {!! Form::open(['method' => 'POST', 'route' => ['admin.articles.categories.position.update']]) !!}
                        @foreach ($articlesCategories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{!! Form::text('position['.$category->id.']', old('position.' . $category->id) ? old('position.' . $category->id) : $category->position, []) !!}
                            <td>{{$category->created_at}}</td>            
                            <td>
                                <a href="{{route('admin.articles.categories.delete',[$category->id])}}">Usuń</a>
                                    {!! getArticleCategoryLanguageCreateLinks($category) !!}
                                    
                            </td>
                            <tr>
                                @if(!empty($category->ArticlesCategoriesDescription->isNotEmpty()))
                                    @foreach ($category->ArticlesCategoriesDescription as $categoryDescription)
                                        <tr>
                                            <td colspan="3">
                                            <td>{{$categoryDescription->id}}</td>
                                            <td>{{$categoryDescription->name}}</td>
                                            <td>{{$categoryDescription->lang}}</td>            
                                            <td><a href="{{route('admin.articles.categories.edit',[$categoryDescription->id])}}">Edytuj</a></td>                            
                                            <td><a href="{{route('admin.articles.categories.description.delete',[$categoryDescription->id])}}">Usuń</a></td>                            
                                        </tr>
                                    @endforeach
                                    
                                @endif
                            </tr>
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
 
 