<h4>Map</h4>

@if(! $unit->mapUrl)
  No position information provided.
@else
    <iframe
      width="100%"
      height="450"
      frameborder="0" style="border:0"
      src="{{ $unit->mapUrl }}" allowfullscreen>
    </iframe>
@endif
