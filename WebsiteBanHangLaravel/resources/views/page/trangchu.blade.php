@extends('master')
@section('content')
<div class="fullwidthbanner-container">
					<div class="fullwidthbanner">
						<div class="bannercontainer" >
					    <div class="banner" >
								<ul>
									<!-- THE FIRST SLIDE -->
									@foreach($slide as $sl)
									<li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
										<div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
											<div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="image/slide/{{$sl->image}}" data-src="image/slide/{{$sl->image}}" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('image/slide/{{$sl->image}}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
											</div>
										</div>

									</li>
									@endforeach
								
								</ul>
							</div>
						</div>

						<div class="tp-bannertimer"></div>
					</div>
				</div>
				<!--slider-->
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
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
										</div>
									</div>
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
							<br>
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
											<a href="chi-tiet-san-pham/{{$product->id}}"><img height="260px" width="250px" src="image/product/{{$product->image}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$product->name}}</p>
											<p class="single-item-price">
												<span class="flash-del">{{number_format($product->unit_price)}}VND</span>
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