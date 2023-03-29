@extends('Painel.layout.index')
@section('content')

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

			<div class="row mt-3">
				<div class="col-12">
					
					@php
					$position = 0;
					$number = [];
					@endphp
					<div class="row">
						<div class="col-sm-6">
							@foreach ($produto as $itemprod)
								<h5 class=" d-inline-block ">{{$itemprod->name}}</h5>
							@endforeach
						</div>
					
					</div>
					<div class="card card-dark card-tabs">
						<div class="col-12 alert alert-danger text-center" 
							id="messagem" style=" display: none;" role="alert">	
						</div>
						<div class="card-header p-0 pt-1">
							<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
								@foreach ($etapa as $chave=> $item)
								@foreach($listaProduto as $key=> $itemp)
								@foreach ($listaProduto[$key] as $valor)

								@if ($valor == $id_produto)

								@if ($key === $chave )
								@php
									$position++;
								@endphp

								@php
									$number[] = $item->id;
								@endphp
								<li class="nav-item">
									<a class="nav-link {{($position == 1)? 'active': ''}} " id="id_{{$item->id}}"
										data-toggle="pill" href="#id-{{$item->id}}" role="tab"
										aria-controls="custom-tabs-one-home" aria-selected="true">
										{{$item->nome_etapa}}
									</a>
								</li>
								@endif
								@endif
								@endforeach
								@endforeach
								@endforeach

							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content" id="custom-tabs-one-tabContent">
								@if ($number == [])
									<h5>Não Existe Etapa para esse produto</h5>
								@endif
								@for ($i = 0; $i < count($number); $i++) 
									<div class="tab-pane  {{$i == 0 ? 'active' : ''}}"
											id="id-{{$number[$i]}}" 
											role="tabpanel" 
											aria-labelledby="id_{{$number[$i]}}">
										<form id="form" class="form " name="form">
											<input class="activeInput" 
												type="hidden" 
												name="{{$id_produto}}" 
												id="id_produto"
												value="{{$id_produto}}">
											<input class="activeInput" 
												type="hidden" 
												name="{{$id_produto}}" 
												id="status"
												value="1">
											<div id="actions">
												{{-- <h5>{{$campo}}</h5> --}}
												@if (!empty($campo[0]))
													<div style="text-align: right;">
														@if($i == count($number)-1)
															
															<a class="btn btn-primary btn-pay mt-4 btn-sm"
																data-toggle="modal" data-target="#teste"
																onclick="visualizar()">
																<i class="fa-solid fa-file-lines fa-lg" title="Preview"></i>
																
															</a>
															<!-- <button type="submit"  class="btn btn-primary btn-pay mt-4 " >Pré-visualizar</button> -->
															<a class="btn btn-primary btn-pay mt-4 btn-sm"
																onclick="finalizar()">Finalizar
																Pedido
															</a>
														@else
															<a class="btn btn-primary btn-pay mt-4 btn-sm"
																onclick="proximo({{$number[$i]}}, {{$number[$i+1]}})">Próximo 
																<i class="fa-solid fa-chevron-right"></i> 
															</a>
														@endif
													</div>
													<div style="text-align: right;">
														<div>
															<label>Etapa {{$i+1}} de {{count($number)}} </label>
														</div>
													</div>

												@endif

											</div>

											<div class="row">
												@foreach ($campo as $chave=>$item)
												@foreach($listaEtapa as $key=> $itemp)
												@foreach ($listaEtapa[$key] as $valor)
												@if ($key == $chave)
												@if ($valor == $number[$i] )
													<div class="col-12 col-sm-12">
														<div class="card card-light ">
															<div class="card-header">
																<h5 class="card-title">
																	{{$item->name_campo}}</h5>
																<div class="card-tools">
																	<button type="button" class="btn btn-tool" data-card-widget="collapse"
																		title="Collapse" >
																		<i class="fas fa-minus"></i>
																	</button>
																</div>
															</div>
															<div class="card-body">
																<div class="row">
																	@foreach ($items as $chaveitems=>$elemento)
																	@foreach($lista_id as $keylist=> $lista_a)
																	@foreach ($lista_id[$keylist] as $lista_b)
																	@if ($chaveitems == $keylist )
																	@if ($lista_b == $item->id && $elemento->status == 1 && ($elemento->visivel_em == 'todos' || $elemento->visivel_em == 'orcamento') )
																	@if ($elemento->tipo_item == 'text')
																		<div class="col-md-6 col-sm-12">
																			<hr>
																			<div class="form-group">
																				<label
																					for="{{$number[$i]}}-{{$item->id}}-{{$elemento->id}}">{{$elemento->name_item}}
																					( min {{$elemento->limite_min}} - max {{$elemento->limite_max}})</label>
																				<input type="text" class="form-control activeInput medidas"
																					id="{{$number[$i]}}-{{$item->id}}-{{$elemento->id}}"
																					data-id="[{{$number[$i]}}-{{$item->id}}-{{$elemento->id}}]"
																					data-min="{{$elemento->limite_min}}"
																					data-max="{{$elemento->limite_max}}"
																					placeholder="{{$elemento->placeholder}}"
																					onkeyup="myFunction('{{$id_produto}}','{{$number[$i]}}-{{$item->id}}-{{$elemento->id}}','{{$elemento->limite_min}}','{{$elemento->limite_max}}',{{$elemento->id}})"
																					name="{{$elemento->name_item}}">
																			</div>
																		</div>
																	@endif
																	@if ($elemento->tipo_item == 'radio')
																		<div class="col-md-6 col-sm-12">
																			<div class="icheck-primary ">
																				<input type="radio" class="form-control activeInput"
																					id="{{$number[$i]}}-{{$item->id}}-{{$elemento->id}}"
																					name="{{$item->name_campo}}" value="{{$elemento->name_item}}"
																					onclick="myFunction('{{$number[$i]}}-{{$item->id}}-{{$elemento->id}}','{{$elemento->limite_min}}','{{$elemento->limite_max}}','{{$elemento->name_item}}')"
																					required>
																				<label class="mb-2"
																					for="{{$number[$i]}}-{{$item->id}}-{{$elemento->id}}">{{$elemento->name_item}}</label>

																			</div>
																		</div>
																	@endif
																	@if ($elemento->tipo_item == 'checkbox')
																		<div class="col-md-6 col-sm-12">
																			<div class="icheck-primary  ">
																				<input type="checkbox" class="form-control activeInput"
																					id="{{$number[$i]}}-{{$item->id}}-{{$elemento->id}}"
																					name="{{$elemento->name_item}}" value="{{$elemento->name_item}}"
																					onclick="myFunction('{{$number[$i]}}-{{$item->id}}-{{$elemento->id}}','{{$elemento->limite_min}}','{{$elemento->limite_max}}','{{$elemento->name_item}}')"
																					>
																				<label class="mb-2"
																					for="{{$number[$i]}}-{{$item->id}}-{{$elemento->id}}">{{$elemento->name_item}}</label>
																			</div>
																		</div>
																	@endif
																	@if ($elemento->tipo_item == 'select')
																				
																				<div class="col-md-12 ">
																					<label class="mx-auto d-block" 
																						for="{{$number[$i]}}-{{$item->id}}-{{$elemento->id}}">{{$elemento->name_item}}
																					</label>
																					<div class="btn-group btn-group-toggle d-sm-flex flex-wrap" data-toggle="buttons">
																						@foreach ($subitens as $valor )
																							@if ($valor->id_item == $elemento->id)
																								@if ($valor->status == 1)
																								<div class="btn btn-light activeInput2 flex-grow-0 mr-1"  id="{{$elemento->id}}-{{$valor->id}}" >
																									<label class="control-label"  
																										for="{{$number[$i]}}-{{$item->id}}-{{$elemento->id}}-{{$valor->id}}">
																										<input type="radio" class=" form-control activeInput" 
																											id="{{$number[$i]}}-{{$item->id}}-{{$elemento->id}}-{{$valor->id}}"
																											name="{{$elemento->name_item}}"
																											value=""
																											onclick="myFunction('{{$number[$i]}}-{{$item->id}}-{{$elemento->id}}-{{$valor->id}}','{{$elemento->limite_min}}','{{$elemento->limite_max}}','{{$valor->id}}')"
																										>
																											<div class="text-center " style=" word-wrap: break-word;" >
																												<span class="d-none d-sm-block" >{{$valor->nome_lista}}</span>
																											</div>
																											<div class="d-sm-none d-md-none" style="font-size:.9rem"> {{$valor->nome_lista}}</div>
																											<br>
																										@if ($valor->image != '')
																											@php
																												$comeca ='#';
																												$existe = (strpos($valor->image,$comeca) !== false);
																											@endphp
																											@if ($existe)
																												<div class="" 
																												style="
																													width: 2.5rem;
																													height: 2.5rem;
																													border-radius: 50%;
																													background-color: {{$valor->image}}">
																												</div>
																											@else
																											<div class="d-none d-sm-block" >
																												<img width= "80px" height ="120px" src="{{asset('AdminLTE/dist/img/listas/'.$valor->image)}}" alt="">
																											</div>
																											<div class="d-sm-none d-md-none">
																												<img width= "60px" height ="80px" src="{{asset('AdminLTE/dist/img/listas/'.$valor->image)}}" alt="">
																											</div>
																											@endif
																										@endif
																									</label>
																								</div>
																								@endif
																							@endif
																						@endforeach
																					</div>
																				</div>
																			{{-- </div> --}}
																		{{-- </div> --}}
																	@endif
																	@endif
																	@endif
																	@endforeach
																	@endforeach
																	@endforeach
																</div>
															</div>
															<!-- /.card-body -->
														</div>
													</div>
												@endif
												@endif
												@endforeach
												@endforeach
												@endforeach
											</div>
										</form>
									</div>
								@endfor
							</div>
						</div>
					</div>
					<!-- /.card -->
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
	
        {{-- MODAL PARA info --}}
        <div class="modal fade" id="teste">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class=" modal-title ">Preview</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
					<div class="modal-body">

						<form class="form-horizontal">
							<div class="row">
								<div class="col-md-12">
									<div id="produto" class="form-group">
										<h6> <span>Nome do Produto: </span>  Porta Seccionada</h6>
									</div>
									<hr/>
								</div>
								
								<div class="col-md-12">
									<div id="etapa" class="form-group">
										<h6>Painel</h6>
									</div>
									<hr/>
								</div>
								<div class="col-md-12">
									<div id="Campo" class="form-group">
										<h6>Cotas</h6>
									</div>
									<hr/>
								</div>
								<div class="col-3">
									<div class="form-group variaveis">
										<label>Textarea</label>
										<input type="text" class="form-control" placeholder=".col-3">
									</div>
								</div>
								<div class="col-3">
									<div class="form-group">
										<label>Textarea</label>
										<input type="text" class="form-control" placeholder=".col-3">
									</div>
								</div>
								<div class="col-3">
									<div class="form-group">
										<label>Textarea</label>
										<input type="text" class="form-control" placeholder=".col-3">
									</div>
								</div>
								<div class="col-3">
									<div class="form-group">
										<label>Textarea</label>
										<input type="text" class="form-control" placeholder=".col-3">
									</div>
								</div>
								<div class="col-3">
									<div class="form-group">
										<label>Textarea</label>
										<input type="text" class="form-control" placeholder=".col-3">
									</div>
								</div>
							</div>

						</form>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
					</div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
@endsection
