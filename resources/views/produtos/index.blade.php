@extends('layout')
@section('style', 'css/catalogo-bootstrap.css')
@section('script','js/catalogo.js')

@section('main')
    <main role="main">
        <div class="container-xxl mt-5 mb-5">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                <a class="link text-decoration-none text-dark" href="{{ route('catalogo') }}">Livros</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row row-cols-2 mt-4 gx-5">
                <div class="col-3 pe-5">
                    <div class="d-block bg-light p-4 shadow-sm">
                        <span class="d-block fw-bold" id="filter">FILTROS:</span>
                        <button class="btn btn-default d-inline-flex align-items-center mt-4 p-0 order-btn" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="#collapse1">
                            <span class="d-block fw-bold" id="order">ORDENAR POR</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-dash ms-2" viewBox="0 0 16 16" id="btnOrder">
                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                            </svg>
                        </button>
                        <div class="collapse mt-2" id="collapse1">
                            <ul class="list-unstyled ms-5 lh-lg">
                                <li>Livro: A - Z</li>
                                <li>Livro: Z - A</li>
                                <li>Nome do Autor</li>
                                <li>Preço Crescente</li>
                                <li>Preço Decrescente</li>
                            </ul>
                        </div><!-- 1 -->

                        <button class="btn btn-default d-inline-flex align-items-center mt-4 p-0 order-btn" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="#collapse2">
                            <span class="d-block fw-bold" id="categorie">CATEGORIAS</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-dash ms-2" viewBox="0 0 16 16" id="btnCategory">
                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                            </svg>
                        </button>

                        <div class="collapse mt-2" id="collapse2">
                            <ul class="list-unstyled ms-5 lh-lg">
                                @foreach (App\Models\Categoria::ativo() as $categoria)
                                    <li>
                                        <a href="{{route('categoria.show', $categoria['id'])}}" class="link text-decoration-none text-dark">{{$categoria['nome']}} ({{$categoria['quantidade']}}) </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div><!-- 2 -->

                        <button class="btn btn-default d-inline-flex align-items-center mt-4 p-0 order-btn" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="#collapse3">
                            <span class="d-block fw-bold" id="price">FAIXA DE PREÇO</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-dash ms-2" viewBox="0 0 16 16" id="btnPrice">
                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                            </svg>
                        </button>
                        <div class="collapse mt-2" id="collapse3">
                            <form action="#">
                                <label for="range" class="form-label">Preço Mínimo</label>
                                <input type="range" class="form-range" min="0" max="100" value="10" id="range">

                                <label for="range" class="form-label mt-2">Preço Máximo</label>
                                <input type="range" class="form-range" min="0" max="100" value="75" id="range">
                            </form>
                        </div><!-- 3 -->
                    </div>
                </div>

                <div class="col-9">

                    <div class="row row-cols-4">
                        @foreach ($produtos as $produto)
                            <div class="col">
                                <a href="{{ route('produto.show', $produto->PRODUTO_ID) }}">
                                    <figure class="figure">
                                        @if (isset($produto->produtoImagens[0]))
                                            <img src="{{$produto->produtoImagens[0]->IMAGEM_URL}}" alt="" class="figure-img img-fluid">
                                        @else
                                            <img src="https://via.placeholder.com/223x300/F8F8F8/CCC?text=Sem%20Imagem" alt="" class=" figure-img img-fluid">
                                        @endif

                                        <figcaption class="figure-caption text-dark fw-semibold fs-6 position-relative">
                                            <span class="mt-2"><small>{{$produto->PRODUTO_NOME}}</small></span>

                                            @if ($produto->PRODUTO_DESCONTO > 0)
                                                <span class="badge rounded-0 rounded-start position-absolute translate-middle bg-danger fs-5">{{number_format($produto->PRODUTO_DESCONTO / $produto->PRODUTO_PRECO * 100, 0)}}%</span>
                                                <div class="d-flex">
                                                    <span class="fw-semibold me-3 fs-5">R$ {{ number_format($produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO, 2) }}</span>
                                                    <span class="fw-semibold"><s>R$ {{$produto->PRODUTO_PRECO}}</s></span>
                                                <div>
                                            @else
                                                <div class="">
                                                    <span class="fw-semibold fs-5">R$ {{$produto->PRODUTO_PRECO}}</span>
                                                </div>
                                            @endif

                                        </figcaption>
                                    </figure>
                                </a>
                            </div>
                        @endforeach
                </div>
            </div>

        </div>
    </main>
@endsection