<div>
    <div x-data="searcher({{$items}})" class="">

        <x-jet-input type="search" class="w-full" x-model="search"></x-jet-input>
        <x-jet-input type="hidden" id="{{$idSearch}}" x-model="value"></x-jet-input>
        <div class="absolute shadow w-full bg-white">
            <ul>
                <template x-for="(item,index) in filtrado" :key="index">
                    <div>
                     
                        <template x-if="(item.image != undefined)">
                            tiene imagen
                        </template>
                        <li  class="p-4 cursor-pointer" x-text="item.name"></li>
                    </div>
                </template>
               
            </ul>
        </div>
    </div>
    @push('js')
        <script>
            function searcher(items){
                return{
                    search: '' ,
                    value: '',
                    items :items,
                    get filtrado() {
                        if (this.search === "") {
                            return this.items;
                        }
                        return this.items.filter((item) => {
                        return item.name
                            .toLowerCase()
                            .includes(this.search.toLowerCase());
                        });
                    },
                   
                }
            }
        </script>
    @endpush
  
</div>
