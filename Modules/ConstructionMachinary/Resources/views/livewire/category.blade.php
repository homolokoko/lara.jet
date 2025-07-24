
<ul class="menu">
    @foreach ($categories as $category)
    <li><a href="{{route('constructionmachinary::category.show',$category->id)}}"><x-heroicon-o-folder class="w-5" /> {{$category->name}}</a></li>
    @endforeach
</ul>
