
@props(['label','placeholder'])
<div class="flex  w-full  ">
    @php
        // Determine the placeholder text


        // Define default classes for consistent styling
        $defaultClasses = [
            'form-input',
            'rounded-r-md',
            'flex-1',
            'shadow-sm',
            'block',
            'text-center',
            'p-2',
            'border-2'
        ];
    @endphp
    <input
        {{ $attributes ?? '' }}
        class="{{ implode(' ', $defaultClasses) }}"
        placeholder="{{  $label ??  $placeholder ?? '' }}"
    >

</div>
