<option value="">Phường/Xã</option>
@foreach($options as $ward)
<option value="{{ $ward->id.'.'.$ward->name }}"
@if(isset($admin) && $admin->ward_id == $ward->id)
    selected="selected"
@endif
>{{ $ward->name }}</option>
@endforeach
