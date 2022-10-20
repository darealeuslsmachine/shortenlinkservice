@extends('layouts.main')
@section('content')

<h1>Создать сокращенную ссылку</h1>

<div class="card">
    <div class="card-header">
        <form method="POST" action="{{ route('generate.shorten.link.post') }}">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="link" class="form-control" placeholder="URL">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit">Сократить ссылку</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card-body">
    @if (Session::has('success'))
        <div class="alert alert-success">
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif

    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>Сокращенная ссылка</th>
                <th>Ссылка</th>
                <th>Колличество переходов</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shortLinks as $link)
                <tr>
                    <td>
                        <a href="{{ route('shorten.link', $link->code) }}" target="_blank">{{ route('shorten.link', $link->code) }}</a>
                    </td>
                    <td>
                        <a href="{{ $link->link }}" target="_blank">{{ $link->link }}</a>
                    </td>
                    <td>{{ $link->count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@stop
