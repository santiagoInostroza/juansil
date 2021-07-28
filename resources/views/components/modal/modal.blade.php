<div  class="hidden" :class="{hidden:!modal}">
    <div class="inset-0 fixed opacity-75 bg-gray-800 flex justify-center items-center z-10"></div>
    <div class="inset-0 fixed  flex justify-center items-center z-10">
        <section class="bg-gray-200 rounded-lg shadow max-w-screen-sm w-full">
            <header class="header  p-4 ">
                {{$titulo}}
            </header>
            <main class="p-4 bg-white">
                {{$slot}}
            </main>
            <footer class="header p-4">
                {{$footer}}
                
            </footer>
        </section>
    </div>
</div>