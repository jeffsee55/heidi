<div class="col-xs-12 col-sm-7">
    @include('units.header', compact('unit'))
    <hr>
</div>
<div class="col-xs-12 col-sm-5">
    @include('searchform', ['searchForm' => $unit->getSearchForm()])
</div>

<div class="col-xs-12 col-sm-7">
    {{ $unit->headline }}
    <hr>
    {{ $unit->description }}
    <hr>
    @include('units.map', compact('unit'))
    <hr>
    Reviews
</div>


<div class="col-xs-12 col-sm-5">
    More Information

    <div class="col-sm-12">
        <?php dynamic_sidebar('sidebar-primary'); ?>
    </div>
</div>
