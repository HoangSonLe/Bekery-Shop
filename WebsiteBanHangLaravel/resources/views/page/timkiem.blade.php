@extends('master')
@section('content')
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>Sản phẩm tìm được</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy {{count($products)}} sản phẩm mới</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($products as $product)
									<div class="col-sm-3">
									<div class="single-item">
										@if($product->promotion_price !=0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif
										<div class="single-item-header">
											<a href="chi-tiet-san-pham/{{$product->id}}"><img height="260px" width="250px" src="image/product/{{$product->image}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$product->name}}</p>
											<p class="single-item-price">
												<span class="flash-del" >{{number_format($product->unit_price)}}VND</span>
												@if($product->promotion_price !=0)
												<span class="flash-sale">{{number_format($product->promotion_price)}}VND</span>
												@endif
											</p>
										</div>
											<br>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="add-to-cart/{{$product->id}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="chi-tiet-san-pham/{{$product->id}}">Xem chi tiết <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
											<br>
										</div>
									</div>
								</div>
								@endforeach
								<!-- Pagination -->
								<div class="row text-center">
									<div class="col-lg-12">
										{{ $products->appends(Request::all())->links() }}﻿
										{{-- {{ $new_product->appends(Request::all())->links() }} --}}
									</div>
								</div>
								<!-- /.row -->
							</div>
							<br>
						</div> <!-- .beta-products-list -->

					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection