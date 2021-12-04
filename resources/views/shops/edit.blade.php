

    <x-guest-layout>
   
   <h2 class="font-semibold text-xl text-gray-800 leading-tight">
       店舗編集
   </h2>

<section class="text-gray-600 body-font">
<div class="container px-5　mx-auto">

<div class="lg:w-2/3 0w-full mx-auto overflow-auto">

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />
  <form method="post" action="{{route('shops.update',['shop'=>$shop->id])}}" enctype="multipart/form-data">
  @csrf
      <div class="-m-2">
        <div class="p-2 w-1/2 mx-auto">
          <div class="relative">
            <label for="image" class="leading-7 text-sm text-gray-600">画像</label>
            <input type="file" id="image" name="image" accept="image/png,image/jpeg,image/jpg" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-pink-500 focus:bg-white focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-full flex justify-around mt-4">
          <button type="button" onclick="location.href='{{route('shops.index')}}'" class=" bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
          <button type="submit" class=" text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded text-lg">画像アップロード</button>
        </div>
      </div>
  </form>

</div>
</div>
</section>


</x-guest-layout>

