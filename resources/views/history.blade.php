@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">

    <table class="table table-responsive">
        <thead>
        <tr>

            <th>
                Data parcelas
            </th>
            <th>
                Valor
            </th>

        </tr>
        </thead>
        <tbody>

    @forelse($history as $historys)




            <tr>

                <td>

                    @if($historys->created_at>=\Illuminate\Support\Carbon::now())

                        <span style="color:blue"> {{ date( 'd/m/Y ' , strtotime($historys->created_at))}} </span>

                    @else

                        <span style="color:red">  {{ date( 'd/m/Y ' , strtotime($historys->created_at))}} </span>

                    @endif

                </td>
                <td>
                    {{  'R$ '.number_format($historys->valor, 2, ',', '.') }}
                </td>

            </tr>




    @empty
        <tr>
            <td colspan="11">Nenhuma parcela</td>
        </tr>
    @endforelse

    <tr>
        <td colspan="11"><button onclick=" window.history.back();" class="btn btn-default"> Voltar</button></td>
    </tr>

            </tbody>
        </table>
    <div>
        <div>
            <div>

@endsection

