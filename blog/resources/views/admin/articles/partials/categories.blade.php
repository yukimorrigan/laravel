@foreach ($categories as $category)
    <option value="{{$category->id or ''}}"
        {{-- Если существует новость (если мы ее редактируем) --}}
        @isset($article->id)
            {{-- Перебор категорий новости --}}
            @foreach ($article->categories as $category_article)
                {{-- Если категория из общего списка привязана к новости, тогда она должна быть выбрана --}}
                @if ($category->id == $category_article->id)
                    selected="selected"
                @endif
            @endforeach
        @endisset
    >
        {{-- Воскл. знаки помогут сохранить html-разметку --}}
        {!! $delimiter or "" !!}{{$category->title or ""}}
    </option>

    {{-- Вывод бесконечной вложенности категорий --}}
    {{-- Если есть вложенные категории --}}
    @if (count($category->children) > 0)
        {{-- Подключить данный шаблон --}}
        @include('admin.articles.partials.categories', [
            'categories' => $category->children,
            'delimiter' => ' - ' . $delimiter
        ])
    @endif
@endforeach
