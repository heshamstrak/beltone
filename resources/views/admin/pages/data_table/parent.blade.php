@if($page->parent_id != null)
    <span>{{$page->parent_id()->title}}</span>
@else
   <span>Master</span> 
@endif