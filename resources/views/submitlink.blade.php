@forelse($data as $d)

<div>
    <a href="{{$d->link}}">{{$d->title}}</a>
</div>




@empty
<div>No data</div>

@endforelse
