<div>
    <div class="flex flex-col">
         @livewire('admin.home.totals', ['month' => $month, 'year' => $year]) 
         @livewire('admin.home.daily-details', ['month' => $month, 'year' => $year])  

    </div> 
</div>
