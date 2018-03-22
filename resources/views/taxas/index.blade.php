@extends('layouts.app')


@yield('content')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

<form role="form" method="POST" action="{{ route('taxas.update',$taxas[0]['id'])}}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}


        <div class="form-group">

            <label for="exampleInputEmail1">
                Credito
            </label>
            <input type="text" name="credito" value="{{old('credito',$taxas[0]['credito'])}}" class="form-control"  />
        </div>
        <div class="form-group">

            <label for="exampleInputPassword1">
                Debito
            </label>
            <input type="text" value="{{old('debito',$taxas[0]['debito'])}}" name="debito" class="form-control" id="exampleInputPassword1" />
        </div>

        <button type="submit" class="btn btn-success">
            Atualizar
        </button>

    <button onclick="window.location='/home'" type="button" class="btn btn-default">
        Cancelar
    </button>

    </form>

          <div>
        <div>
    <div>




@endsection