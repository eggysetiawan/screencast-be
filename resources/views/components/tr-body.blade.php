<tr {{ $attributes->merge([
    'class' => $loop->iteration % 2 == 0 ? 'bg-gray-200 ' : 'bg-white ',
]) }}>
    {{ $slot }}</tr>
