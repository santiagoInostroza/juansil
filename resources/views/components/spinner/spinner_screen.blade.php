@props(['size'=>'12'])

    <div class="fixed inset-0 bg-gray-800 opacity-25"></div>
    <div class="fixed inset-0 flex justify-center items-center z-40">
        <div {{$attributes->merge([
            'class' =>"loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-$size w-$size"
        ])}} >
        </div>
    </div>