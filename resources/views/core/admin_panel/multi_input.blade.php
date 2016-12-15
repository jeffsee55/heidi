<ul class="arguments">

    @if($row->value)

        @foreach($row->value as $key => $value)

            <li>
                <input name={{ $row->option }}[] type="text" value={{ $key }}>
                <input name={{ $row->option }}[] type="text" value={{ $value }}>
                <span data-remove="" class="q4vr-icon q4vr-minus"></span>
                <span data-add="" class="q4vr-icon q4vr-plus"></span>
            </li>

        @endforeach

    @else

        <li>
            <input name={{ $row->option }}[] type="text">
            <input name={{ $row->option }}[] type="text">
            <span data-remove="" class="q4vr-icon q4vr-minus"></span>
            <span data-add="" class="q4vr-icon q4vr-plus"></span>
        </li>

    @endif

</ul>
