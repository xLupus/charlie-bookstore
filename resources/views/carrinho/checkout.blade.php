@extends('layout')

@section('title', 'Verificação de Dados')

@php
    $precoTotal = $descontoTotal = 0;

    foreach ($produtos as $item) {
        $precoTotal    = $precoTotal + $item->produto->PRODUTO_PRECO * $item->ITEM_QTD;
        $descontoTotal = $descontoTotal + $item->produto->PRODUTO_DESCONTO * $item->ITEM_QTD;
    }
@endphp

@section('main')

<main role="main">
    <div class="container-xxl">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('carrinho.index')}}" class="link">Carrinho</a></li>
                <li class="breadcrumb-item active">Verificação de dados</li>
            </ol>
        </nav>
    </div>

    <div class="container-xxl">
        <div class="row row-cols-2">
            <div class="col col-8 mb-5">
                <div class="row row-cols-1 mb-4">
                    <div class="col">
                        <div class="bg-light p-3 ms-3">
                            <h5 class="fw-bold">Informações de contato</h5>

                            <div class="mb-1">
                                <span class="fw-bold">Nome: </span>
                                <span>{{$usuario->USUARIO_NOME}}</span>
                            </div>
                            <div class="mb-1">
                                <span class="fw-bold">CPF: </span>
                                <span>{{$usuario->USUARIO_CPF}}</span>
                            </div>
                            <div>
                                <span class="fw-bold">Email: </span>
                                <span>{{$usuario->USUARIO_EMAIL}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <div class="bg-light p-3 ms-3">
                            <span class="fw-bold h5 d-block">Endereço de entrega</span>

                            <div class="">
                                <span class="d-block fw-bold">{{strtoupper($endereco->ENDERECO_NOME)}}: </span>
                                <div>
                                    <span>{{$endereco->ENDERECO_LOGRADOURO}}, </span>
                                    <span>{{$endereco->ENDERECO_NUMERO}}- </span>
                                    <span>{{$endereco->ENDERECO_COMPLEMENTO}}</span>
                                    <span>{{$endereco->ENDERECO_CIDADE}} -</span>
                                    <span>{{$endereco->ENDERECO_ESTADO}},</span>
                                    <span>{{$endereco->ENDERECO_CEP}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="px-3">
                        <span class="d-block fw-bold h5 mb-3">Forma de Pagamento</span>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-light px-5 rounded-pill border" data-bs-toggle="button">Boleto Bancario</button>
                            <button type="button" class="btn btn-light px-5 rounded-pill border" data-bs-toggle="button">Cartão de crédito</button>
                            <button type="button" class="btn btn-light px-5 rounded-pill border" data-bs-toggle="button">Transferencia Bancaria</button>
                            <button type="button" class="btn btn-light px-5 rounded-pill border" data-bs-toggle="button">PIX</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="bg-light w-75 p-3 ms-3">
                        <h5 class="fw-bold">Itens do Pedido</h5>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>QTD</th>
                                    <th>NOME DO PRODUTO</th>
                                    <th>VALOR UNITARIO</th>
                                    <th>VALOR TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($produtos as $livro)
                                <tr>
                                    <td>{{$livro->ITEM_QTD}}x</td>
                                    <td>{{$livro->produto->PRODUTO_NOME}}</td>
                                    <td>R$ {{number_format(($livro->produto->PRODUTO_PRECO - $livro->produto->PRODUTO_DESCONTO), 2)}}</td>
                                    <td>R$ {{number_format(($livro->produto->PRODUTO_PRECO - $livro->produto->PRODUTO_DESCONTO) * $livro->ITEM_QTD, 2)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col col-4">
                <div class="bg-light rounded p-3">
                    <span class="d-block fw-bold h4 mb-3">Detalhes do Pedido</span>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-normal fs-5 align-start">Preço total</span>
                        <span class="fw-normal fs-5">R$ {{number_format($precoTotal, 2)}}</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-normal fs-5">Frete</span>
                        <span class="fw-normal fs-5">Gratis</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fw-normal fs-5">Desconto</span>
                        <span class="fw-normal fs-5">R$ {{number_format($descontoTotal, 2)}}</span>
                    </div>

                    <div class= "d-flex justify-content-between align-items-center py-4 border-1 border-top border-dark">
                        <span class="fw-bold fs-5">Valor total</span>
                        <span class="fw-semibold fs-5">R$ {{number_format($precoTotal - $descontoTotal, 2)}}</span>
                    </div>

                    <form class="#" action="{{route('realizar-pedido')}}" method="post">
                        @csrf
                        <input type="submit" name="#" value="Efetuar Pedido" class="d-block bg-black w-100 text-white rounded-pill w-100 py-2 text-center">
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
