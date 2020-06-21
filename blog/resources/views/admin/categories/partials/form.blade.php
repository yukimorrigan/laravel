{{-- Общая форма для добавления и обновления категорий --}}
<label for="published">Статус</label>
<select class="form-control" name="published" id="published">
    {{-- Если ключ id существует - то это обновление записи, и нужно проверить состояние категории --}}
    @if (isset($caregory->id))
        <option value="0" @if ($category->published == 0) selected="" @endif>Не опубликовано</option>
        <option value="1" @if ($category->published == 1) selected="" @endif>Опубликовано</option>
    @else
        <option value="0">Не опубликовано</option>
        <option value="1">Опубликовано</option>
    @endif
</select>

<label for="title">Наименование</label>
<input type="text" class="form-control" name="title" id="title" placeholder="Заголовок категории"
       value="{{$category->title or ""}}" required>

<label for="slug">Slug</label>
<input type="text" class="form-control" id="slug" name="slug" placeholder="Автоматическая генерация"
       value="{{$category->slug or ""}}" readonly="">

<label for="parent_id">Родительская категория</label>
<select class="form-control" name="parent_id" id="parent_id">
    <option value="0">-- без родительской категории --</option>
    {{-- Подключение опций с катеориями, которые могут быть выбраны в качестве родительских --}}
    {{-- $categories - переменная с коллекцией родительских элементов, передаваемая с контроллера --}}
    @include('admin.categories.partials.categories', ['categories' => $categories])
</select>

<hr />

<input type="submit" class="btn btn-primary" value="Сохранить">
