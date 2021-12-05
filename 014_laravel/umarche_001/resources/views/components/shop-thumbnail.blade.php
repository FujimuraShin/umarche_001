<div>
    

    @if(empty($filename))
        <img src="{{asset('images/noimage.png')}}">
    @else
        <img src="{{asset('storage/shops/'.$filename)}}">
    @endif
</div>