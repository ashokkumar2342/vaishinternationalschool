@foreach ($classes as $classe)
    <option value="{{ $classe->id }}" {{$rs_class_id== $classe->id?"selected":""}}>{{ $classe->name }}</option> 
@endforeach

