@extends('adminlte::page')

@section('title_postfix', ' - Produtos')


@section('content')
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Produtos
            </h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            <table id="tabela" class="table table-hover table-responsive-sm" style="width:100%">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Qtd.Movimentações</th>
                    <th width="150px" scope="col">Ações</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->count }}</td>
                            <td>
                                <a href="{{route('product.show', $product->id)}}" class="badge bg-dark">Visualizar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>


@stop


