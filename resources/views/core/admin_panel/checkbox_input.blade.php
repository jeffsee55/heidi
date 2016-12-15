
@foreach($row->arguments as $name => $label)
    <?php
        $checked = '';
        if(isset($row->value[$name]))
        {
            $checked = array_filter($row->value[$name]) ? 'checked' : '';
        }
    ?>
    <div class="checkbox">
        <label>
            <input type="checkbox" {{ $checked }}> {{ $label }}
        </label>
        @foreach($row->argumentOptions as $argumentOption)
            <?php $argumentName = $row->option . '[' . $name . '][' . $argumentOption->option . ']'; ?>
            <label>{{ $argumentOption->name }}</label>
            <select name="{{ $argumentName }}">
                <option></option>
                @foreach($argumentOption->arguments as $argumentOptionName => $label)
                    <?php
                    $selected = '';
                    if(isset($row->value[$name][$argumentOption->option]))
                    {
                        if((int) $row->value[$name][$argumentOption->option] == $argumentOptionName)
                            $selected = 'selected';
                    }
                     ?>
                    <option {{ $selected }} value="{{ $argumentOptionName }}">{{ $label }}</option>
                @endforeach
            </select>
        @endforeach
    </div>
@endforeach
