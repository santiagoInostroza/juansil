<div>
    <style>
        body {
            overflow: hidden; /* Hide scrollbars */
        }

        .modalMain::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .modalMain {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        .max_z{
            z-index: 999999999999999;
        }


    </style>
    <div class="fixed inset-0 rounded-xl  shadow-2xl bg-white  max_z">
        <section class="bg-white flex flex-col justify-between items-end">
            
            @isset($header)
                <header class="">
                    {{$header}}
                </header>
            @endisset
            
            <main class="modalMain p-4 bg-white overflow-y-auto overflow-x-hidden w-full" >
                {{$slot}}
            </main>

            @isset($footer)
                <footer class="bg-gray-200 h-15 ">
                    {{$footer}}
                </footer>
            @endisset
            
        </section>
    </div>
</div>
