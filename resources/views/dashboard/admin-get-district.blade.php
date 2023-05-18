<option value="">Quận/Huyện</option>
@foreach($options as $district)
<option value="{{ $district->id.'.'.$district->name }}"
@if(isset($user->infoDetail->district_id) && $user->infoDetail->district_id == $district->id)
    selected="selected"
@endif
>{{ $district->name }}</option>
@endforeach
