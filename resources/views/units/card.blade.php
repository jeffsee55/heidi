<div class="card">
    <div class="image-container">
        <a class="image-link" href="{{ $unit->get_permalink() }}">
            <img class="unit-card-image" src="{{ $unit->getImage() }}">
        </a>
        <span class="unit-rate"><em><strong>{{ $unit->displayRate() }}</em></strong></span>
    </div>
    <div class="unit-card-details">
        <h4>{{ $unit->name }}</h4>
        <h5>{{ $unit->address->city }}</h5>
        <h5>Bedrooms: {{ $unit->getBedrooms() }} | Bathrooms: {{ $unit->getBathrooms() }}</h5>
    </div>
    <a href="{{ $unit->get_permalink() }}" class="btn btn-primary btn-block">Check Availability</a>
</div>
