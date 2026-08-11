@props(['headers' => []])

<div class="overflow-x-auto rounded-xl border border-slate-200 bg-white shadow-soft">
    <table class="w-full text-sm text-left text-slate-600">
        <thead class="text-xs text-slate-700 uppercase bg-slate-50/80 border-b border-slate-200 sticky top-0 backdrop-blur-sm z-10">
            <tr>
                @foreach($headers as $header)
                    <th scope="col" class="px-6 py-4 font-semibold tracking-wider">
                        {{ $header }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            {{ $slot }}
        </tbody>
    </table>
</div>
