<table class="form-table q4vr-settings">
    <colgroup>
        <col span="1" style="width: 20%;">
        <col span="1" style="width: 80%;">
    </colgroup>
    <tbody>
        @foreach($panel->rows as $row)
        <tr>
            <th>{{ $row->name }}</th>
            <td>{{ $row->layout() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
