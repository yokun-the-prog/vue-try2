<div class="table-responsive">
    <table class="table" id="tours-table">
        <thead>
        <tr>
            <th>ユーザー名</th>
            <th>観光計画日</th>
            <th>交通手段</th>
            <th>出発地</th>
            <th>帰宅地</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tours as $tour)
            <tr>
                <td>{{ $tour->user->name }}</td>
                <td>{{ $tour->schedule }}</td>
                <td>{{ $tour->transport_division->name }}</td>
                <td>{{ $tour->departure_spot }}</td>
                <td>{{ $tour->return_spot }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['tours.destroy', $tour->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tours.show', [$tour->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <!-- <a href="{{ route('tours.edit', [$tour->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a> -->
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
