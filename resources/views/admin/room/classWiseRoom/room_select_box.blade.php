<label>Room Name/No.</label>
<select name="room_id" class="form-control">
    <option selected disabled>Select Room Name/No.</option>
 	@foreach ($roomTypes as $roomType)
  		<option value="{{ $roomType->id }}">{{ $roomType->name }}</option>  
 	@endforeach
</select>