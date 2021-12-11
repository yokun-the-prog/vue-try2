@extends('admin/layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>旅程追加</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'tours.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('admin/tours.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('tours.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
