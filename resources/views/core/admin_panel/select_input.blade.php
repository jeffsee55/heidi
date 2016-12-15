<select data-select name="<?= $row->option ?>">
    <?php $currentValue = $row->value; ?>
    @foreach($row->arguments as $argumentKey => $argumentValue)
        <?php $selected = $currentValue == $argumentKey ? 'selected' : ''; ?>
        <option {{ $selected }} value="{{ $argumentKey }}">{{ $argumentValue }}</option>
    @endforeach
</select>
