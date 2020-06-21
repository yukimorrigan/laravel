{{-- Общая форма для добавления и обновления категорий --}}
<label for="published">Статус</label>
<select class="form-control" name="published" id="published">
    {{-- Если ключ id существует - то это обновление записи, и нужно проверить состояние категории --}}
    @if (isset($article->id))
        <option value="0" @if ($article->published == 0) selected="" @endif>Не опубликовано</option>
        <option value="1" @if ($article->published == 1) selected="" @endif>Опубликовано</option>
    @else
        <option value="0">Не опубликовано</option>
        <option value="1">Опубликовано</option>
    @endif
</select>

<label for="title">Заголовок</label>
<input type="text" class="form-control" name="title" id="title" placeholder="Заголовок новости"
       value="{{$article->title or ""}}" required>

<label for="slug">Slug</label>
<input type="text" class="form-control" id="slug" name="slug" placeholder="Автоматическая генерация"
       value="{{$article->slug or ""}}" readonly="">

<label for="categories">Родительская категория</label>
{{-- multiple - атрибут множественного выбора--}}
<select class="form-control" name="categories[]" id="categories" multiple="">
    {{-- Подключение опций с катеориями, которые могут быть выбраны в качестве родительских --}}
    {{-- $categories - переменная с коллекцией родительских элементов, передаваемая с контроллера --}}
    @include('admin.articles.partials.categories', ['categories' => $categories])
</select>

<label for="description_short">Краткое описание</label>
{{-- К идинтификатору description_short будет привязан визуальный редактор--}}
<textarea name="description_short" id="description_short" class="form-control">{{$article->description_short or ''}}</textarea>

<label for="description">Полное описание</label>
<textarea name="description" id="description" class="form-control">{{$article->description or ''}}</textarea>

<hr />

<label for="meta_title">Мета заголовок</label>
<input type="text" id="meta_title" name="meta_title" class="form-control" placeholder="Мета заголовок" value="{{$article->meta_title or ''}}">

<label for="meta_description">Мета описание</label>
<input type="text" id="meta_description" name="meta_description" class="form-control" placeholder="Мета описание" value="{{$article->meta_description or ''}}">

<label for="meta_keyword">Мета слова</label>
<input type="text" id="meta_keyword" name="meta_keyword" class="form-control" placeholder="Ключевые слова, через запятую" value="{{$article->meta_keyword or ''}}">

<hr />

<input type="submit" class="btn btn-primary" value="Сохранить">
