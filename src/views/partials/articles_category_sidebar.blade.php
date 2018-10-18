
    <div class="panel panel-default col-md-4">
        <div class="panel-heading">
            Opcje Kategori Artykułu
        </div>
        <div class="panel panel-body">
         <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('position', 'Pozycja', ['class' => 'control-label']) !!}
                    {!! Form::number('position', old('position') ? old('position') : $articleCategoryDescription->ArticlesCategories->position ?? 0, ['class' => 'form-control', 'required' => '', 'min' => 1]) !!}
                                      
                    <p class="help-block"></p>
                    @if($errors->has('position'))
                        <p class="help-block">
                            {{ $errors->first('position') }}
                        </p>
                    @endif
                   
                </div>
            </div>
           
        </div>
    </div>