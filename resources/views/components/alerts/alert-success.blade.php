<div x-data="{isOpenAlert:true}" class=" shadow">
    <div  x-show="isOpenAlert" class="animate-bounce flex justify-between items-center alert alert-success w-full p-4 bg-green-500 text-white font-bold">
        {{$slot}}
        <div class="p-2 cursor-pointer text-white" x-on:click="isOpenAlert=false">
            <i class="fas fa-times"></i>
        </div>
    </div>  
</div>