
<div class="font-sans leading-normal tracking-normal bg-grey-100">
    <script>
        var storagePath = "{!! storage_path() !!}"; 
    </script>
    <div x-data="dropdown({{$items}})" class="mx-auto" @click.away="show=false">    
       
        <x-jet-input x-ref="searchField" x-model="search" x-on:keydown.window.prevent.slash="$refs.searchField.focus()" placeholder="{{$placeholder}}" type="search"
            class="block w-full px-4 py-3 font-bold text-gray-700  rounded-lg focus:outline-none  focus:shadow" @focus="show= true"
        />
        <x-jet-input  type="hidden" id="{{ $id }}"  x-ref="buscador" />
       
        <div class="shadow absolute bg-white" :class=" show ? '':'hidden'">
            <template x-for="item in filtrado" :key="item">
              <div  @click="selected(item.id)" x-ref="item.name" class="flex items-center p-4 transition duration-150 ease-in-out transform cursor-pointer hover:bg-indigo-100 hover:shadow-lg hover:rounded hover:scale-100">       
                <template x-if="item.image">
                    <img class="w-10 h-10 rounded-full mr-4" :src="`/storage/${item.image.url}`" />
                </template>
                <p class="leading-none text-gray-900" x-text="item.name" ></p>
              </div>
            </template>
          </div>
    </div>  


        <script>
            function dropdown(items){
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
  
  </div>