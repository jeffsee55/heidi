<ul class="arguments">

    @if($row->value)

        <?php $index = 0; ?>
        
        @foreach($row->value as $key => $value)

            <li>
                <input name={{ $row->option }}[{{ $index }}][key] type="text" value={{ $key }}>
                <input name={{ $row->option }}[{{ $index }}][value] type="text" value={{ $value }}>
                <span data-remove="" class="q4vr-icon q4vr-minus"></span>
                <span data-add="" class="q4vr-icon q4vr-plus"></span>
            </li>

            <?php $index++; ?>
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
