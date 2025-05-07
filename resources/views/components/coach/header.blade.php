<header class="hidden md:block h-full bg-slate-100 border-r-2 border-slate-200" id="sidebar">
    <div class="flex justify-center">
        <ul class="m-5 w-full text-center flex flex-col gap-5">
            <li class="text-2xl font-bold">Groups</li>
            <li class="flex items-center gap-2 relative">
                <span class="absolute h-3 w-3 opacity-75 animate-ping rounded-full bg-green-500"></span>
                <span class="w-3 h-3 rounded-full bg-green-500"></span>
                <p class="text-xl font-medium text-green-500">Active</p>
            </li>
            <ul class="list-disc flex flex-col mx-auto w-3/4 gap-2">
                <li>group 1</li>
                <li>group 2</li>
                <li>group 3</li>
                <li>group 4</li>
                <li>group 5</li>
                <li>group 6</li>
                <li>group 7</li>
                <li>group 8</li>
                <li>group 9</li>
                <li>group 10</li>
                <li>group 11</li>
                <li>group 12</li>
                <li>group 13</li>
            </ul>
            <li class="flex items-center gap-2 relative">
                <span class="absolute h-3 w-3 opacity-75 animate-ping rounded-full bg-red-500"></span>
                <span class="w-3 h-3 rounded-full bg-red-500"></span>
                <p class="text-xl font-medium text-red-500">Waiting</p>
            </li>
            <ul class="list-disc flex flex-col mx-auto w-3/4 gap-2">
                <li>group 1</li>
                <li>group 2</li>
                <li>group 3</li>
                <li>group 4</li>
                <li>group 5</li>
                <li>group 6</li>
                <li>group 7</li>
                <li>group 8</li>
                <li>group 9</li>
                <li>group 10</li>
                <li>group 11</li>
                <li>group 12</li>
                <li>group 13</li>
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
                <li>group 1</li>
                <li>group 2</li>
                <li>group 3</li>
                <li>group 4</li>
                <li>group 5</li>
                <li>group 6</li>
                <li>group 7</li>
                <li>group 8</li>
                <li>group 9</li>
                <li>group 10</li>
                <li>group 11</li>
                <li>group 12</li>
                <li>group 13</li>
            </ul>
            <li class="flex items-center gap-2 relative">
                <span class="absolute h-3 w-3 opacity-75 animate-ping rounded-full bg-red-500"></span>
                <span class="w-3 h-3 rounded-full bg-red-500"></span>
                <p class="text-xl font-medium text-red-500">Waiting</p>
            </li>
            <ul class="list-disc flex flex-col mx-auto w-3/4 gap-2">
                <li>group 1</li>
                <li>group 2</li>
                <li>group 3</li>
                <li>group 4</li>
                <li>group 5</li>
                <li>group 6</li>
                <li>group 7</li>
                <li>group 8</li>
                <li>group 9</li>
                <li>group 10</li>
                <li>group 11</li>
                <li>group 12</li>
                <li>group 13</li>
                <div class="h-10 w-full"></div>
            </ul>
        </ul>
    </div>
</aside>

@vite('resources/js/header.js')
