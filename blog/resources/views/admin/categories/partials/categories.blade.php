@foreach ($categories as $category_list)
    <option value="{{$category_list->id or ""}}"
        {{-- Проверка для формы редактирования категории --}}
        @isset($category->id)
            {{-- Выбрать родительскую категорию для данной категории --}}
            @if ($category->parent_id == $category_list->id)
                selected=""
            @endif
            {{-- Убрать из списка выбора текущую категорию --}}
            @if ($category->id == $category_list->id)
                hidden=""
            @endif
        @endisset
    >
        {{-- Воскл. знаки помогут сохранить html-разметку --}}
        {!! $delimiter or "" !!}{{$category_list->title or ""}}
    </option>

    {{-- Вывод бесконечной вложенности категорий --}}
    {{-- Если есть вложенные категории --}}
    @if (count($category_list->children) > 0)
        {{-- Подключить данный шаблон --}}
        @include('admin.categories.partials.categories', [
            'categories' => $category_list->children,
            'delimiter' => ' - ' . $delimiter
        ])
    @endif
@endforeach
