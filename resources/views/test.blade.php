    <div class="col-sm-6">
      <div class="box box-primary">
        <h3 class="box-title"><i class="fa fa-newspaper-o" aria-hidden="true"></i> News</h3>
      </div>
      <div class="box-body">
        <ul class="todo-list">
          @foreach ($news as $news1)
       
          {{-- --}}
          <li style="list-style-type:disc">
            <span class="text"><a href="{{ route('dashboard.show', $news1->id ) }}"><b>{{ $news1->title }}<br> {{$news1->created_at }} | Admin</b>
                </a></span>
                
          </li>
      </div>
      @endforeach
      </ul>
 </div>
    <div style="bottom: 63px; position: relative">
      {{$news->links()}}
    </div>
  </div>