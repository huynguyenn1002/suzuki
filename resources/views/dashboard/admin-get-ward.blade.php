<option value="">Phường/Xã</option>
@foreach($options as $ward)
<option value="{{ $ward->id.'.'.$ward->name }}"
@if($user->infoDetail->ward_id == $ward->id)
    selected="selected"
@endif
>{{ $ward->name }}</option>
@endforeach
