@if($investor->parent_id != null)
    <span>{{$investor->parent_id()->name}}</span>
@else
   <span>Master</span> 
@endif