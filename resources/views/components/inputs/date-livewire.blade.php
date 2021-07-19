@props(['options' => []])

@php
    $options = array_merge([
            'dateFormat' => 'd-m-Y',
            'enableTime' => false,
            'allowInput' => true
        ], $options);
@endphp

<div wire:ignore>
    <input
        x-data="{
            value: @entangle($attributes->wire('model')),
            instance: undefined
        }"
        x-init="() => {
            $watch('value', value => instance.setDate(value, true));
            instance = flatpickr($refs.input, {{ json_encode((object)$options) }});
        }"
        x-ref="input"
        x-bind:value="value"
        type="text"
        placeholder="DD-MM-YYYY"
        @if (Gate::denies('not-read-only')) disabled @endif
        {{ $attributes->merge(['class' => 'mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md']) }}
    />
</div>
