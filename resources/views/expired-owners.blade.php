

    <x-guest-layout>
   
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            期限切れオーナ一覧
        </h2>
    

<section class="text-gray-600 body-font">
<div class="container px-5　mx-auto">
  <x-flash-message status="session('status')"/>
<div class="flex justify-end mb-4" >
  <button onclick="location.href='{{route('owners.create')}}'" class=" text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded text-lg">新規登録する</button>
</div>    
    <div class="lg:w-2/3 0w-full mx-auto overflow-auto">
      <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
          <tr>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">期限が切れた日</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($expiredOwners as $owner)
          <tr>
            <td class="px-4 py-3">{{ $owner-> name }}  </td>
            <td class="px-4 py-3">{{ $owner-> email }}  </td>
            <td class="px-4 py-3">{{ $owner-> deleted_at->diffForHumans() }}  </td>
            
            <form id="delete_{{$owner->id}}" method="post" action="{{route('expired-owners.destroy',['owner'=>$owner->id])}}">
              @csrf 
              
              <td class="px-4 py-3">
                <a href="#" data-id="{{$owner->id}}" onclick="deletePost(this)" type="submit" class=" text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded">完全に削除する</a>
              </td>
            </form>
          </tr>
        @endforeach 
        </tbody>
      </table>
    </div>
  </div>
</section>

<script>
  function deletePost(e){
    'use strict';
    if(confirm('本当に削除してもいいですか？')){
      document.getElementById('delete_'+e.dataset.id).submit();
    }
  }
</script>

</x-guest-layout>

  