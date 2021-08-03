<div class="font-sans leading-normal tracking-normal bg-grey-100">
    <div x-data="dropdown()" class="mx-auto" @click.away="show=false">    
       
        <input
            x-ref="searchField"
            x-model="search"
            x-on:keydown.window.prevent.slash="$refs.searchField.focus()"
            placeholder="{{$placeholder}}"
            type="search"
            class="block w-full px-4 py-3 font-bold text-gray-700 bg-gray-200 rounded-lg focus:outline-none focus:bg-white focus:shadow"
            @focus="show= true"
            
            
        />
        <input type="hidden" name="" id="{{ $id }}" x-ref="buscador">
        <div class="" :class=" show ? '':'hidden'">
            <template x-for="item in filtrado" :key="item">
              <div  @click="selected(item.id)" x-ref="item.name" class="flex items-center p-3 transition duration-150 ease-in-out transform shadow cursor-pointer hover:bg-indigo-100 hover:shadow-lg hover:rounded hover:scale-105">
                
                  <p class="leading-none text-gray-900" x-text="item.name" ></p>
               
              
              </div>
            </template>
          </div>
    </div>  

    @push('js')
        <script>
            var items = @json($items);
            
            function dropdown(){
                return {
                    search: "",
                    id : "",
                    name : "",
                    show: false,
                    myForData: items,
                    get filtrado() {
                        if (this.search === "") {
                            return this.myForData;
                        }
                        return this.myForData.filter((item) => {
                        return item.name
                            .toLowerCase()
                            .includes(this.search.toLowerCase());
                        });
                    },
                    selected: function(id){
                       
                        item =  items.filter(item => id == item.id);
                       
                        this.name=item[0].name;
                        this.id=id;
                        this.search = this.name;
                        this.show=false;
                        this.$refs.buscador.value=id;
                    }

                }
            }
         
            
        </script>
    @endpush 
  </div>