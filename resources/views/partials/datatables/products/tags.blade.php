<div>
    @foreach ($product->tags as $tag)
        <div class="text-xs rounded shadow px-1 mb-2 text-gray" style="width:max-content;background: {{$tag->color}}">{{$tag->name}}</div>
    @endforeach
</div>