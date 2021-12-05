

    <x-guest-layout>
   
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            店舗情報
        </h2>

<section class="text-gray-600 body-font">
<div class="container px-5　mx-auto">
  
    <div class="lg:w-2/3 0w-full mx-auto overflow-auto">
      
    @foreach($shops as $shop)
                  <div class="w-1/2 p-4">
                    <a href="{{route('shops.edit',['shop'=>$shop->id])}}">
                      <div class="border rounded-md p-4">
                        <div class="md-4">
                          @if($shop->is_selling)
                            <span class="border p-2 rounded-md bg-blue-400 text-white">販売中</span>
                          @else
                          <span class="border p-2 rounded-md bg-red-400 text-white">販売停止中</span>
                         
                          @endif
                        </div>
                          <br/>
                          <div class="text-xl">{{ $shop->name }}</div>

                          <!--サムネイル-->
                          <x-shop-thumbnail :filename="$shop->filename"/>
                    </a>
                </div>
                  @endforeach

      
    </div>
  </div>
</section>


</x-guest-layout>

  