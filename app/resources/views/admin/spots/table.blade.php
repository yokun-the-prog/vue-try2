<div class="table-responsive">
    <table class="table" id="spots-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>住所</th>
            <th>TEL</th>
            <th>目安観光時間</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($spots as $spot)
            <tr>
                <td>{{ $spot->id }}</td>
                <td>{{ $spot->name }}</td>
                <td>{{ $spot->address }}</td>
                <td>{{ $spot->tel }}</td>
                <td>{{ $spot->standard_term }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['spots.destroy', $spot->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('spots.show', [$spot->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('spots.edit', [$spot->id]) }}"
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
