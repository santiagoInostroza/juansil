<div class="">
    <div class="fixed inset-0 w-full h-full bg-gray-900 opacity-25 z-10"></div>
    <div class="fixed inset-0 rounded-xl  shadow-2xl bg-white z-10  h-screen w-screen">
        <section class="bg-white rounded-lg w-screen h-screen">
            
            @isset($titulo)
                <header class="header fixed top-0  w-screen h-15">
                    {{$titulo}}
                </header>
            @endisset
            
            <main class="p-4 bg-white my-15 overflow-auto" style="max-height: calc(100vh - 112px);">
                {{$slot}}
            </main>
            @isset($footer)
                <footer class="header fixed bottom-0 w-screen bg-gray-200 h-15">
                    {{$footer}}
                </footer>
            @endisset
            
        </section>
    </div>
</div>
