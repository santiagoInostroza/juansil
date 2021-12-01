<div>
        <div class="inset-0 fixed opacity-75 bg-gray-800 flex justify-center items-center z-10"></div>
        
        <div class="inset-0 fixed   flex justify-center items-center z-20  max-w-sm md:max-w-full">
            <section class="bg-gray-200 rounded-lg shadow min-w-max-content max-w-screen-xl w-screen sm:w-max-content " style="max-height: calc(100vh - 160px)">
               
                @isset($titulo)
                    <header class="p-4">
                        {{$titulo}}
                    </header>
                @endisset
                
                <main class="p-2 bg-white overflow-y-auto overflow-x-hidden" 
                style="max-height: calc(100vh - 160px)"
               {{-- style="
                    @if( isset($footer) && isset($titulo) ) max-height: calc(100vh - 112px); margin-bottom: 4rem;margin-top: 4rem; @endif
                    @if( isset($footer) ) max-height: calc(100vh - 56px); margin-bottom: 4rem @endif
                    @if( isset($titulo) ) max-height: calc(100vh - 56px); @endif
                "  --}}
                >
                    {{$slot}}
                </main>
                @isset($footer)
                    <footer class="header p-4">
                        {{$footer}}
                        
                    </footer>
                @endisset
                
            </section>
        </div>
  
   
</div>