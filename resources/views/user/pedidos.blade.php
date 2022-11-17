@extends('layout')

@section('title', 'Meus Pedidos')
@section('script', '/js/pedidos.js')
@section('style', '/css/pedidos.css')

@section('main')
    <main role="main">
        <div class="container-xxl">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="link">Perfil</a></li>
                            <li class="breadcrumb-item active">Meus Pedidos</li>
                        </ul>
                    </nav>
                </div>

                <div class="col-12 mt-2">
                    <span class="d-block fs-3 fw-bold">Meus Pedidos</span>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-11 mx-auto">
                    <div class="table-responsive shadow-sm">
                        <table class="table">
                            <thead>
                                <tr class="text-center align-middle history-header">
                                    <th scope="col">ID</th>
                                    <th scope="col">DATA DA COMPRA</th>
                                    <th scope="col">MÉTODO DE PAGAMENTO</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">Nº DE ITENS</th>
                                    <th scope="col">TOTAL DA COMPRA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($pedidos->count() != 0)
                                    @foreach ($pedidos as $pedido)
                                        @php
                                            $precoTotal = [];
                                            $itensTotal = 0;

                                            foreach ($pedido->pedidoItens as $item) {
                                                $precoTotal[] = $item->ITEM_QTD * ($item->ITEM_PRECO);
                                                $itensTotal += $item->ITEM_QTD;
                                            }
                                        @endphp
                                        <tr class="text-center align-middle">
                                            <th scope="row"><a href="{{route('pedido', $pedido->PEDIDO_ID)}}" class="link text-dark">#{{$pedido->PEDIDO_ID}}</a></th>
                                            <td>{{implode('/', array_reverse(explode('-', $pedido->PEDIDO_DATA)))}}</td>
                                            <td class="pagamento"></td>
                                            <td><span class="badge rounded-pill px-2 status">{{$pedido->pedidoStatus->STATUS_DESC}}</span></td>
                                            <td>{{$itensTotal}}</td>
                                            <td>R$ {{number_format(array_sum($precoTotal), 2)}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Você não possui nenhum pedido</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $pedidos->links() }}

              {{--   <div class="col-12 mt-5">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center text-center">
                            <li class="page-item"><a href="#" class="page-link">Anterior</a></li>
                            <li class="page-item"><a href="#" class="page-link active text-white ms-3">1</a></li>
                            <li class="page-item"><a href="#" class="page-link text-dark ms-3">2</a></li>
                            <li class="page-item"><a href="#" class="page-link text-dark ms-3">3</a></li>
                            <li class="page-item"><a href="#" class="page-link ms-3">Próxima</a></li>
                        </ul>
                    </nav>
                </div> --}}
            </div>
        </div>
    </main>
@endsection
