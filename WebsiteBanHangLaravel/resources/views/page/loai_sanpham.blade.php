@extends('master')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm {{$tenloaisp->name}}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index">Trang chủ</a> / <span>Loại sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-3">
						<ul class="aside-menu">
							@foreach($loai_sp as $loaisp)
							<li
								@if($loaisp->id == $id_loaisp)
									class="is-active"
								@endif
								><a href="loai-san-pham/{{$loaisp->id}}">{{$loaisp->name}}</a>
							</li>
								@endforeach
						</ul>
					</div>
					<div class="col-sm-9">
						<div class="beta-products-list">
							<h4>Sản phẩm mới</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy {{count($new_product)}} sản phẩm mới</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($new_product as $product)
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
											<p class="single-item-price" style="font-size: 15px;">
												<span class="flash-del">{{number_format($product->unit_price)}}VND</span>
												@if($product->promotion_price !=0)
												<span class="flash-sale">{{number_format($product->promotion_price)}}VND</span>
												@endif
											</p>
										</div>
											<br>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="chi-tiet-san-pham/{{$product->id}}">Xem chi tiết <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
									<br>
								</div>
								@endforeach
								<!-- Pagination -->
								<div class="row text-center">
									<div class="col-lg-12">
										{{$new_product->links()}} 
										{{-- {{ $new_product->appends(Request::all())->links() }} --}}
									</div>
								</div>
								<!-- /.row -->
							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Sản phẩm khuyến mãi</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy {{count($promotion_product)}} sản phẩm khuyến mãi</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								<?php $i=0; ?>
								@foreach($promotion_product as $product)
									<div class="col-sm-3">
									<div class="single-item">
										@if($product->promotion_price !=0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif
										<div class="single-item-header">
											<a href="product.html"><img height="260px" width="250px" src="image/product/{{$product->image}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$product->name}}</p>
											<p class="single-item-price" style="font-size: 15px;">
												<span class="flash-del">{{number_format($product->unit_price)}}VND</span>
												@if($product->promotion_price !=0)
												<span class="flash-sale">{{number_format($product->promotion_price)}}VND</span>
												@endif
											</p>
										</div>
										<br>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="chi-tiet-san-pham/{{$product->id}}">Xem chi tiết <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
									@if($i==4) <div class="space40">&nbsp;</div>
									@endif
									<?php $i++;?>
									<br>
									<br>
								</div>
								@endforeach
								<!-- Pagination -->
								<div class="row text-center">
									<div class="col-lg-12">
										{{$promotion_product->links()}} 
										{{-- {{ $new_product->appends(Request::all())->links() }} --}}
									</div>
								</div>
								<!-- /.row -->
								
								
							</div>
							
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection