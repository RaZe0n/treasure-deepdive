<header class="hidden md:block h-full bg-slate-100 border-r-2 border-slate-200" id="sidebar">
    <div class="flex justify-center">
        <ul class="m-5 w-full flex flex-col gap-5">
            <li class="text-4xl font-bold text-center"><a href="/coach" class="hover:text-blue-500">Treasure Hunt</a></li>
            <li class="flex items-center gap-2 relative ml-10">
                <span class="absolute h-3 w-3 opacity-75 animate-ping rounded-full bg-green-500"></span>
                <span class="w-3 h-3 rounded-full bg-green-500"></span>
                <p class="text-xl font-medium text-green-500">Actief</p>
            </li>
            <ul class="list-disc flex flex-col mx-auto w-1/2 gap-2">
                <li><a href="{{ route('coach.group', ['team' => 1]) }}" class="hover:text-blue-500">Groep 1</a></li>
                <li><a href="{{ route('coach.group', ['team' => 2]) }}" class="hover:text-blue-500">Groep 2</a></li>
                <li><a href="{{ route('coach.group', ['team' => 3]) }}" class="hover:text-blue-500">Groep 3</a></li>
                <li><a href="{{ route('coach.group', ['team' => 4]) }}" class="hover:text-blue-500">Groep 4</a></li>
                <li><a href="{{ route('coach.group', ['team' => 5]) }}" class="hover:text-blue-500">Groep 5</a></li>
                <li><a href="{{ route('coach.group', ['team' => 6]) }}" class="hover:text-blue-500">Groep 6</a></li>
                <li><a href="{{ route('coach.group', ['team' => 7]) }}" class="hover:text-blue-500">Groep 7</a></li>
                <li><a href="{{ route('coach.group', ['team' => 8]) }}" class="hover:text-blue-500">Groep 8</a></li>
                <li><a href="{{ route('coach.group', ['team' => 9]) }}" class="hover:text-blue-500">Groep 9</a></li>
                <li><a href="{{ route('coach.group', ['team' => 10]) }}" class="hover:text-blue-500">Groep 10</a></li>
                <li><a href="{{ route('coach.group', ['team' => 11]) }}" class="hover:text-blue-500">Groep 11</a></li>
                <li><a href="{{ route('coach.group', ['team' => 12]) }}" class="hover:text-blue-500">Groep 12</a></li>
                <li><a href="{{ route('coach.group', ['team' => 13]) }}" class="hover:text-blue-500">Groep 13</a></li>
            </ul>
            <li class="flex items-center gap-2 relative ml-10">
                <span class="absolute h-3 w-3 opacity-75 animate-ping rounded-full bg-red-500"></span>
                <span class="w-3 h-3 rounded-full bg-red-500"></span>
                <p class="text-xl font-medium text-red-500">Wachtend</p>
            </li>
            <ul class="list-disc flex flex-col mx-auto w-1/2 gap-2">
                <li><a href="{{ route('coach.group', ['team' => 1]) }}" class="hover:text-blue-500">Groep 1</a></li>
                <li><a href="{{ route('coach.group', ['team' => 2]) }}" class="hover:text-blue-500">Groep 2</a></li>
                <li><a href="{{ route('coach.group', ['team' => 3]) }}" class="hover:text-blue-500">Groep 3</a></li>
                <li><a href="{{ route('coach.group', ['team' => 4]) }}" class="hover:text-blue-500">Groep 4</a></li>
                <li><a href="{{ route('coach.group', ['team' => 5]) }}" class="hover:text-blue-500">Groep 5</a></li>
                <li><a href="{{ route('coach.group', ['team' => 6]) }}" class="hover:text-blue-500">Groep 6</a></li>
                <li><a href="{{ route('coach.group', ['team' => 7]) }}" class="hover:text-blue-500">Groep 7</a></li>
                <li><a href="{{ route('coach.group', ['team' => 8]) }}" class="hover:text-blue-500">Groep 8</a></li>
                <li><a href="{{ route('coach.group', ['team' => 9]) }}" class="hover:text-blue-500">Groep 9</a></li>
                <li><a href="{{ route('coach.group', ['team' => 10]) }}" class="hover:text-blue-500">Groep 10</a></li>
                <li><a href="{{ route('coach.group', ['team' => 11]) }}" class="hover:text-blue-500">Groep 11</a></li>
                <li><a href="{{ route('coach.group', ['team' => 12]) }}" class="hover:text-blue-500">Groep 12</a></li>
                <li><a href="{{ route('coach.group', ['team' => 13]) }}" class="hover:text-blue-500">Groep 13</a></li>
            </ul>

        </ul>
    </div>
</header>

<aside class="block md:hidden">
    <div class="flex flex-col gap-1 group absolute top-3 right-3" id="hamburger">
        <div
            class="bg-black w-7 h-1 group-data-[active]:translate-y-2 group-data-[active]:rotate-45 group-data-[active]:transition-all group-data-[active]:duration-200 group-data-[active]:ease-out
        translate-y-0 rotate-0 transition-all duration-200 ease-out">
        </div>
        <div
            class="bg-black w-7 h-1 group-data-[active]:opacity-0 group-data-[active]:transition-all group-data-[active]:duration-100 group-data-[active]:ease-out
        transition-all duration-100 ease-out">
        </div>
        <div
            class="bg-black w-7 h-1 group-data-[active]:-translate-y-2 group-data-[active]:-rotate-45 group-data-[active]:transition-all group-data-[active]:duration-200 group-data-[active]:ease-out
        translate-y-0 rotate-0 transition-all duration-200 ease-out">
        </div>
    </div>
    <div class="overflow-y-auto data-[active]:flex justify-center absolute top-0 -left-0 -translate-x-[101%] transition-all duration-200 ease-out h-screen bg-primary w-[75vw] z-10 data-[active]:translate-x-0 data-[active]:transition-all data-[active]:duration-200 data-[active]:ease-out"
        id="sidebar-mb">
        <ul class="m-5 w-full flex flex-col gap-3">
            <li class="text-2xl font-bold">Groups</li>
            <li class="flex items-center gap-2 relative">
                <span class="absolute h-3 w-3 opacity-75 animate-ping rounded-full bg-green-500"></span>
                <span class="w-3 h-3 rounded-full bg-green-500"></span>
                <p class="text-xl font-medium text-green-500">Active</p>
            </li>
            <ul class="list-disc flex flex-col mx-auto w-3/4 gap-2">
                <li><a href="{{ route('coach.group', ['team' => 1]) }}" class="hover:text-blue-500">group 1</a></li>
                <li><a href="{{ route('coach.group', ['team' => 2]) }}" class="hover:text-blue-500">group 2</a></li>
                <li><a href="{{ route('coach.group', ['team' => 3]) }}" class="hover:text-blue-500">group 3</a></li>
                <li><a href="{{ route('coach.group', ['team' => 4]) }}" class="hover:text-blue-500">group 4</a></li>
                <li><a href="{{ route('coach.group', ['team' => 5]) }}" class="hover:text-blue-500">group 5</a></li>
                <li><a href="{{ route('coach.group', ['team' => 6]) }}" class="hover:text-blue-500">group 6</a></li>
                <li><a href="{{ route('coach.group', ['team' => 7]) }}" class="hover:text-blue-500">group 7</a></li>
                <li><a href="{{ route('coach.group', ['team' => 8]) }}" class="hover:text-blue-500">group 8</a></li>
                <li><a href="{{ route('coach.group', ['team' => 9]) }}" class="hover:text-blue-500">group 9</a></li>
                <li><a href="{{ route('coach.group', ['team' => 10]) }}" class="hover:text-blue-500">group 10</a></li>
                <li><a href="{{ route('coach.group', ['team' => 11]) }}" class="hover:text-blue-500">group 11</a></li>
                <li><a href="{{ route('coach.group', ['team' => 12]) }}" class="hover:text-blue-500">group 12</a></li>
                <li><a href="{{ route('coach.group', ['team' => 13]) }}" class="hover:text-blue-500">group 13</a></li>
            </ul>
            <li class="flex items-center gap-2 relative">
                <span class="absolute h-3 w-3 opacity-75 animate-ping rounded-full bg-red-500"></span>
                <span class="w-3 h-3 rounded-full bg-red-500"></span>
                <p class="text-xl font-medium text-red-500">Waiting</p>
            </li>
            <ul class="list-disc flex flex-col mx-auto w-3/4 gap-2">
                <li><a href="{{ route('coach.group', ['team' => 1]) }}" class="hover:text-blue-500">group 1</a></li>
                <li><a href="{{ route('coach.group', ['team' => 2]) }}" class="hover:text-blue-500">group 2</a></li>
                <li><a href="{{ route('coach.group', ['team' => 3]) }}" class="hover:text-blue-500">group 3</a></li>
                <li><a href="{{ route('coach.group', ['team' => 4]) }}" class="hover:text-blue-500">group 4</a></li>
                <li><a href="{{ route('coach.group', ['team' => 5]) }}" class="hover:text-blue-500">group 5</a></li>
                <li><a href="{{ route('coach.group', ['team' => 6]) }}" class="hover:text-blue-500">group 6</a></li>
                <li><a href="{{ route('coach.group', ['team' => 7]) }}" class="hover:text-blue-500">group 7</a></li>
                <li><a href="{{ route('coach.group', ['team' => 8]) }}" class="hover:text-blue-500">group 8</a></li>
                <li><a href="{{ route('coach.group', ['team' => 9]) }}" class="hover:text-blue-500">group 9</a></li>
                <li><a href="{{ route('coach.group', ['team' => 10]) }}" class="hover:text-blue-500">group 10</a></li>
                <li><a href="{{ route('coach.group', ['team' => 11]) }}" class="hover:text-blue-500">group 11</a></li>
                <li><a href="{{ route('coach.group', ['team' => 12]) }}" class="hover:text-blue-500">group 12</a></li>
                <li><a href="{{ route('coach.group', ['team' => 13]) }}" class="hover:text-blue-500">group 13</a></li>
                <div class="h-10 w-full"></div>
            </ul>
        </ul>
    </div>
</aside>

@vite('resources/js/header.js')
