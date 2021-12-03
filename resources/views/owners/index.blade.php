{{--
001_エロクアント
    @foreach($e_all as $e_owner)
        {{ $e_owner-> name }}               
        {{ $e_owner->created_at->diffForHumans() }}
    @endforeach
<br/>

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}"></script>

 002_クエリビルダ
     @foreach($q_get as $q_owner)
        {{ $q_owner->name }}              
        {{ $q_owner->created_at }}
     @endforeach
--}}

    <x-guest-layout>
   
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            オーナ一覧
        </h2>
    

<section class="text-gray-600 body-font">
<div class="container px-5　mx-auto">
  <x-flash-message status="info"/>
<div class="flex justify-end mb-4" >
  <button onclick="location.href='{{route('owners.create')}}'" class=" text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded text-lg">新規登録する</button>
</div>    
    <div class="lg:w-2/3 0w-full mx-auto overflow-auto">
      <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
          <tr>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">制作日</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($owners as $owner)
          <tr>
            <td class="px-4 py-3">{{ $owner-> name }}  </td>
            <td class="px-4 py-3">{{ $owner-> email }}  </td>(
            <td class="px-4 py-3">{{ $owner-> created_at->diffForHumans() }}  </td>
            <td class="px-4 py-3">
            <button onclick="location.href='{{route('owners.edit',['owner'=>$owner->id])}}'" type="submit" class=" text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded">編集する</button>
            </td>
          </tr>
        @endforeach 
        </tbody>
      </table>
    </div>
  </div>
</section>
  
</x-guest-layout>

  