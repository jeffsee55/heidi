<div class="clearfix unit-header box">
    <div class="col-md-8">
        <h2 class="entry-title">{{ $unit->name }} <span>|</span> <small>{{ $unit->address->city }}</small></h2>
    </div>
    <div class="col-md-4 text-right"><a href="{{ $unit->directionsUrl }}" target="_blank" class="btn btn-primary">Get Directions</a></div>
</div>
