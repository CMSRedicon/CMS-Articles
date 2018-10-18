@extends('layouts.app')
@include('cms_articles_partials::head')
@include('cms_articles_partials::javascripts')
@section('content')
    <h3 class="page-title">Kategorie Artykułów</h3>
 
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
                        <th>Opisy</th>
              
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($articlesCategories) > 0)
                        @foreach ($articlesCategories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->position}}</td>
                            <td>{{$category->created_at}}</td>              
                            <tr>
                               
                                    @if(!empty($category->ArticlesCategoriesDescription))
                                        @foreach ($category->ArticlesCategoriesDescription as $categoryDescription)
                                            <tr>
                                                <td colspan="3">
                                                <td>{{$categoryDescription->id}}</td>
                                                <td>{{$categoryDescription->name}}</td>
                                                <td>{{$categoryDescription->lang}}</td>            
                                                <td><a href="{{route('admin.articles.categories.edit',[$categoryDescription->id])}}">Edytuj</a></td>                            
                                            </tr>
                                        @endforeach
                                    @endif
             
                            </tr>
                        </tr>
                        @endforeach
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
 
 