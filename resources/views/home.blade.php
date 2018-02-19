@extends('layouts.app')

@section('content')



    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    ...
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    Controle de cartão
                </h3>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form role="form" method="post" action="/cadastrar">
                    {{ csrf_field() }}

                    <div class="form-group">


                        <input type="radio"  {{old('tipo')==\App\Payaments::DEBITO?'checked':''}}  name="tipo" value="{{\App\Payaments::DEBITO}}"  /> Debito
                        <input type="radio"  {{old('tipo')==\App\Payaments::CREDITO?'checked':''}} name="tipo" value="{{\App\Payaments::CREDITO}}"  />Credito


                    </div>


                    <div class="form-group">

                        <label for="exampleInputEmail1">
                            Produto
                        </label>
                        <input type="text" name="nome" value="{{old('nome')}}" class="form-control"  />
                    </div>
                    <div class="form-group">

                        <label for="exampleInputPassword1">
                            Valor
                        </label>
                        <input type="text" value="{{old('valor')}}" name="valor" class="form-control" id="exampleInputPassword1" />
                    </div>

                    <button type="submit" class="btn btn-default">
                        Enviar
                    </button>

                </form>

                <br>

                <div class="row">
                    <div class="col-md-12">

                <table>

                    <thead>
                    <form method="get">
                    <tr>
                        <th>
                            Pesquisar por data:
                        </th>
                        <th>

                            <input type="text" value="" class="date" id="data1" name="data1"> até <input type="text" value="" name="data2">
                        </th>

                        <th>  <button type="submit" class="btn btn-default">
                                Enviar
                            </button></th>

                    </tr>
                    </form>
                    </thead>
                </table>
                <table class="table">
                    <thead>


                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Produto
                        </th>
                        <th>
                            Data pagamento
                        </th>
                        <th>
                            Valor
                        </th>
                        <th>
                            Gerenciar
                        </th>
                    </tr>


                    </thead>
                    <tbody>

                    @forelse($payaments as $payament)
                    <tr>
                        <td>
                            {{$payament->id}}
                        </td>
                        <td>
                            {{$payament->nome}}
                        </td>
                        <td>
                            {{ date( 'd/m/Y' , strtotime($payament->created_at))}}
                        </td>
                        <td>
                            {{ money_format('%n', $payament->valor ) }}
                        </td>
                        <td>


                            <button class="btn btn-default" data-href="/delete.php?id=54" data-toggle="modal" data-target="#confirm-delete">
                                Delete record #54
                            </button>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="11">Nenhuma pedido encontrado</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>

                    <div>
                        <div>


                <div class="right-align">
                    {{ $payaments->appends(request()->query())->render() }}
                </div>
            </div>
        </div>
    </div>


@endsection
