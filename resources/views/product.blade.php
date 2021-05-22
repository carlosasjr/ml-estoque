@extends('adminlte::page')

@section('title_postfix', ' - Predição do Estoque')


@section('content')
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Produto : {{ $product->id  }} - {{ $product->name }}
            </h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            <form class="form" action="{{ route('product.predict', $product->id) }}" method="get">
                <div class="row">
                    <div class="col-4 form-group in-line">
                        <input type="date" name="date" class="form-control" value="{{ isset($date) ? $date : ''  }}">
                    </div>

                    <div class="col-4 form-group in-line">
                        <input class="btn btn-primary" type="submit" value="Treinar e Aplicar">
                    </div>
                </div>
            </form>

            @if (isset($predict))
                <div>
                   <h1>Saldo {{ \App\Services\Helper::formatDateTime($date, 'd/m/Y')  }}: {{ $predict  }}</h1>
                </div>

                <div>
                    <table id="tabela" class="table table-hover table-responsive-sm" style="width:100%">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Data da Movimentação</th>
                            <th scope="col">Saldo em Estoque</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($stocks as $stock)
                            <tr>
                                <td>{{ \App\Services\Helper::formatDateTime($stock->data_mov, 'd/m/Y')  }}</td>
                                <td>{{ $stock->in_stoke }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
        <!-- /.card-body -->
    </div>


@stop


