@props(['post' => null, 'films' => null, 'categories' => null, 'btnText' => 'Выполнить'])

{{-- {{ session('message') }} --}}

<x-form {{ $attributes }}>
    <x-form-item>
        <x-label required>{{ __('Название статьи') }}</x-label>
        <x-input name="title" value="{{ $post->title ?? '' }}" autofocus />

        <x-error name='title' />
    </x-form-item>

    <div class="row">
        <div class="col-md-6 col-12 mb-3">
            <x-label required>{{ __('Категория') }}</x-label>
            <select name="category" class="form-select">
                <option value="">{{ __('Выберите категорию') }}</option>
                @foreach ($categories as $category)
                    {{ $selected = null }}

                    @isset($post->category_id)
                        {{ $selected = $post->category_id == $category->id ? 'selected' : null }}
                    @endisset

                    <option {{ $selected }} value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <x-error name='category' />
        </div>

        <div class="col-md-6 col-12 mb-3">
            <x-label required>{{ __('Фильм') }}</x-label>
            <select name="film" class="form-select">
                <option value="">{{ __('Выберите фильм') }}</option>
                @foreach ($films as $film)
                    {{ $selected = null }}

                    @isset($post->film_id)
                        {{ $selected = $post->film_id == $film->id ? 'selected' : null }}
                    @endisset

                    <option {{ $selected }} value="{{ $film->id }}">
                        {{ $film->name }}
                    </option>
                @endforeach
            </select>

            <x-error name='film' />
        </div>
    </div>

    <x-form-item>
        <x-label required>{{ __('Сообщение') }}</x-label>
        <x-trix name="content" value="{{ $message->text ?? '' }}" />

        <x-error name='content' />
    </x-form-item>

    {{ $slot }}
</x-form>
