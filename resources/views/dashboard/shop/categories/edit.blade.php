@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Редактирование категории</h4>
                    {{ Form::open(['route' => ['categories.update', $category], 'method' => 'put', 'class' => 'forms-sample']) }}

                    <div class="form-group">
                        <label>Название категории</label>
                        {{ Form::text('title', $category->title, ['class' => 'form-control', 'required' => 'required']) }}

                        @if ($errors->has('title'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="parent">Родительская категория</label>
                        <select  name="parent" class="form-control {{ $errors->has('parent') ? ' is-invalid' : '' }}" id="parent">
                            <option value="">Нет</option>
                            @foreach ($parents as $parent)
                                <option {{ $parent->id == $category->parent_id ? ' selected' : '' }} value="{{ $parent->id }}">
                                    @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                                    {{ $parent->title }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('parent'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('parent') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::textarea('content', $category->content, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>
    <script>
        $('textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
        /*CKEDITOR.replace( 'description', {
            filebrowserUploadUrl: "route('upload', ['_token' => csrf_token() ])",
            filebrowserUploadMethod: 'form'
        });*/

    </script>
@endsection
