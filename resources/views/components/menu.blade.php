@props(['isResponsive' => false])

@foreach($menus as $menu)
    @if($menu->hasPermissionToView())
        @if($isResponsive)
            <x-responsive-nav-link :href="$menu->route ? route($menu->route) : '#'" :active="$menu->route ? request()->routeIs($menu->route) : false">
                @if($menu->icon)
                    <i class="{{ $menu->icon }} mr-2"></i>
                @endif
                {{ __($menu->name) }}
            </x-responsive-nav-link>

            @if($menu->children->count() > 0)
                <div class="pl-4">
                    <x-menu :menu="$menu" :is-responsive="true"/>
                </div>
            @endif
        @else
            @if($menu->children->count() > 0)
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            @if($menu->icon)
                                <i class="{{ $menu->icon }} mr-2"></i>
                            @endif
                            {{ __($menu->name) }}
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-menu :menu="$menu"/>
                    </x-slot>
                </x-dropdown>
            @else
                <x-nav-link :href="$menu->route ? route($menu->route) : '#'" :active="$menu->route ? request()->routeIs($menu->route) : false">
                    @if($menu->icon)
                        <i class="{{ $menu->icon }} mr-2"></i>
                    @endif
                    {{ __($menu->name) }}
                </x-nav-link>
            @endif
        @endif
    @endif
@endforeach
