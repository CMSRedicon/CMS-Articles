
    <div class="panel panel-default col-md-4">
        <div class="panel-heading">
            Opcje
        </div>
        <div class="panel panel-body">
         <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('articles_is_public', 'Strona publiczna ?', ['class' => 'control-label']) !!}
                    {!! Form::radio('articles_is_public', 1, $article->is_public == 1 ? true : false) !!}
                    {!! Form::radio('articles_is_public', 0, $article->is_public == 0 ? true : false) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('articles_is_public'))
                        <p class="help-block">
                            {{ $errors->first('articles_is_public') }}
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
                                {!! Form::radio('article_category_id', $id, $article->article_category_id == $id ? true : false) !!}
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
                       Podgląd <br>
                       //todo
                    </div>
                </div>           
        </div>
    </div>