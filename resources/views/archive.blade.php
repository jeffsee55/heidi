<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="grid">
        @foreach($units as $unit)
            <div class="col-sm-4">
                @include('units.card', compact('unit'))
            </div>
        @endforeach
    </div>
<div role="tabpanel" class="tab-pane" id="map">Map</div>
</div>
