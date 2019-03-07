@if (count(Nova::availableResources(request())))
    @foreach($navigation as $group => $resources)
        @foreach($resources as $resource)
            <router-link exact tag="h3" :to="{
                name: 'index',
                params: {
                    resourceName: '{{ $resource::uriKey() }}'
                }
            }" class="cursor-pointer flex items-center font-normal dim text-white mb-8 text-base no-underline">
                @if ($resource::svgIcon())
                    {!!$resource::svgIcon()!!}
                @else
                <svg class="sidebar-icon icon-location" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill="var(--sidebar-icon)" d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"
                    />
                </svg>
                @endif
                {{ $resource::label() }}
                @if ($resource::countBadge())
                    <span class="rounded-full bg-primary uppercase px-1 py-0 text-xs font-bold ml-2">
                        {{ $resource::countBadge() }}
                    </span>
                @endif
            </router-link>               
        @endforeach
    @endforeach
@endif


{{-- 

<svg class="sidebar-icon icon-map" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    <path fill="var(--sidebar-icon)" d="M14 5.62l-4 2v10.76l4-2V5.62zm2 0v10.76l4 2V7.62l-4-2zm-8 2l-4-2v10.76l4 2V7.62zm7 10.5L9.45 20.9a1 1 0 0 1-.9 0l-6-3A1 1 0 0 1 2 17V4a1 1 0 0 1 1.45-.9L9 5.89l5.55-2.77a1 1 0 0 1 .9 0l6 3A1 1 0 0 1 22 7v13a1 1 0 0 1-1.45.89L15 18.12z"
    />
</svg>

<svg class="sidebar-icon icon-download" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    <path fill="var(--sidebar-icon)" d="M11 14.59V3a1 1 0 0 1 2 0v11.59l3.3-3.3a1 1 0 0 1 1.4 1.42l-5 5a1 1 0 0 1-1.4 0l-5-5a1 1 0 0 1 1.4-1.42l3.3 3.3zM3 17a1 1 0 0 1 2 0v3h14v-3a1 1 0 0 1 2 0v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3z"
    />
</svg>

<svg class="sidebar-icon icon-notification" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    <path fill="var(--sidebar-icon)" d="M15 19a3 3 0 0 1-6 0H4a1 1 0 0 1 0-2h1v-6a7 7 0 0 1 4.02-6.34 3 3 0 0 1 5.96 0A7 7 0 0 1 19 11v6h1a1 1 0 0 1 0 2h-5zm-4 0a1 1 0 0 0 2 0h-2zm0-12.9A5 5 0 0 0 7 11v6h10v-6a5 5 0 0 0-4-4.9V5a1 1 0 0 0-2 0v1.1z"
    />
</svg>

<svg class="sidebar-icon icon-location" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    <path fill="var(--sidebar-icon)" d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"
    />
</svg>

<svg class="sidebar-icon icon-user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    <path fill="var(--sidebar-icon)" d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v2z"
    />
</svg>


--}}