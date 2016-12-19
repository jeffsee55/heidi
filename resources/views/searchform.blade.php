<div class="{{ $searchForm->wrapperClass }}">
    <div class="{{ $searchForm->innerClass }}">
        <form class="searchform" id="{{ $searchForm->callType }}" action="{{ $searchForm->formAction }}">
            <input type="hidden" name="post_type" value="vacation_rental">
            <input type="hidden" name="s" value="">
            <input type="hidden" name="action" value="{{ $searchForm->action }}">
            <input id="unitCode" type="hidden" name="unit_code" value="{{ $searchForm->unitCode }}">

            @foreach($searchForm->regularItems as $item)
                {{ $item->render() }}
            @endforeach

            <?php if($searchForm->advancedItems) { ?>
                <div id="advancedSearch" class="col-xs-12 advanced-search collapse">
                    <div class="advanced-fields col-xs-12">
                        <div class="row">
                            @foreach($searchForm->advancedItems as $item)
                                {{ $item->render() }}
                            @endforeach
                            <input class="visible-xs-block btn btn-primary btn-block" type="submit" value="Search">
                        </div>
                    </div>
                </div>
            <?php } ?>
        </form>
        <div id="results"></div>
    </div>
</div>
