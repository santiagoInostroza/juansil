<div>
    <div class="fixed inset-0 rounded-xl  shadow-2xl bg-white z-10  h-screen w-screen">
        <section class="bg-white w-screen h-screen">
            
            @isset($header)
                <header class="header fixed top-0  w-screen h-15">
                    {{$header}}
                </header>
            @endisset
           
            
            <main class="p-4 bg-white overflow-auto"  
                style="
                    @if( isset($footer) && isset($header) ) max-height: calc(100vh - 112px); my-15 @endif>
                    @if( isset($footer) ) max-height: calc(100vh - 56px); mb-8 @endif>
                    @if( isset($header) ) max-height: calc(100vh - 56px); mt-8 @endif>
                "
            >
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
