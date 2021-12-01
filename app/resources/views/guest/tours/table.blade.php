<div class="table-responsive">
    <table class="table" id="tours-table">
        <thead>
        <tr>
            <th>Schedule</th>
            <th>Departure Spot</th>
            <th>Departure At</th>
            <th>Return Spot</th>
            <th>Return At</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($plans ?? '' as $plan)
            <tr>
                <td>{{ $tour->schedule }}</td>
                <td>{{ $tour->departure_spot }}</td>
                <td>{{ $tour->departure_at }}</td>
                <td>{{ $tour->return_spot }}</td>
                <td>{{ $tour->return_at }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['tours.destroy', $tour->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tours.show', [$tour->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('tours.edit', [$tour->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
