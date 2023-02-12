@dd($items)
<table class="table-auto">
    <thead class="border-b">
        <tr>
            @foreach ($items as $item)
                <th class="px-3">{{ $item }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($values as $value)
            <tr class="border-b">
                <td class="px-3">{{ $value->title }}</td>
                <td class="px-3">{{ Str::limit($value->text) }}</td>
                <td class="px-3"><a href="{{ $value->site }}"> site</a></td>
                <td class="px-3"><a href="{{ $value->github }}"> github</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
