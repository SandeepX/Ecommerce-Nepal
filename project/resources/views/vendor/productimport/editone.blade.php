@extends('layouts.vendor')
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet" />

@endsection
@section('content')

<div class="content-area">
	<div class="mr-breadcrumb">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="heading"> {{ $langg->lang704 }} <a class="add-btn" href="{{ url()->previous() }}"><i
							class="fas fa-arrow-left"></i> {{ $langg->lang550 }}</a></h4>
				<ul class="links">
					<li>
						<a href="{{ route('admin.dashboard') }}">{{ $langg->lang441 }} </a>
					</li>
					<li>
						<a href="javascript:;">{{ $langg->lang447 }} </a>
					</li>
					<li>
						<a href="{{ route('vendor-import-index') }}">{{ $langg->lang449 }}</a>
					</li>
					<li>
						<a href="javascript:;">{{ $langg->lang705 }}</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<form id="geniusform" action="{{route('vendor-import-update',$data->id)}}" method="POST"
		enctype="multipart/form-data">
		{{csrf_field()}}
	<div class="row">
		<div class="col-lg-8">
			<div class="add-product-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="product-description">
							<div class="body-area">
		
								<div class="gocover"
									style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
								</div>
								
		
		
									@include('includes.admin.form-both')
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ $langg->lang632 }}* </h4>
												<p class="sub-heading">{{ $langg->lang517 }}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ $langg->lang632 }}"
												name="name" required="" value="{{ $data->name }}">
										</div>
									</div>
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ $langg->lang793 }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ $langg->lang794 }}"
												name="sku" required="" value="{{ $data->sku }}">
		
										</div>
									</div>
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ $langg->lang707 }}* </h4>
												<p class="sub-heading">{{ $langg->lang708 }}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ $langg->lang707 }}"
												name="affiliate_link" required="" value="{{ $data->affiliate_link }}">
											<div class="checkbox-wrapper">
												<input type="checkbox" name="product_condition_check" class="checkclick"
													id="conditionCheck" value="1"
													{{ $data->product_condition != 0 ? "checked":"" }}>
												<label for="conditionCheck">{{ __('Allow Product Condition') }}</label>
											</div>
										</div>
									</div>
		
		
		
									<div class="{{ $data->product_condition == 0 ? "showbox":"" }}">
		
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ $langg->lang634 }}*</h4>
												</div>
											</div>
											<div class="col-lg-12">
												<select name="product_condition">
													<option value="2" {{$data->product_condition == 2 
															? "selected":""}}>{{ $langg->lang635 }}</option>
													<option value="1" {{$data->product_condition == 1 
															? "selected":""}}>{{ $langg->lang636 }}</option>
												</select>
											</div>
		
										</div>
		
		
									</div>
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ $langg->lang637 }}*</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="cat" name="category_id" required="">
												<option>{{ $langg->lang691 }}</option>
		
												@foreach($cats as $cat)
												<option data-href="{{ route('vendor-subcat-load',$cat->id) }}"
													value="{{$cat->id}}" {{$cat->id == $data->category_id ? "selected":""}}>
													{{$cat->name}}</option>
												@endforeach
											</select>
										</div>
									</div>
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ $langg->lang638 }}*</h4>
											</div>
										</div>
										<div class="col-lg-7">
											<select id="subcat" name="subcategory_id">
												<option value="">{{ $langg->lang639 }}</option>
												@if($data->subcategory_id == null)
												@foreach($data->category->subs as $sub)
												<option data-href="{{ route('admin-childcat-load',$sub->id) }}"
													value="{{$sub->id}}">{{$sub->name}}</option>
												@endforeach
												@else
												@foreach($data->category->subs as $sub)
												<option data-href="{{ route('admin-childcat-load',$sub->id) }}"
													value="{{$sub->id}}" {{$sub->id == $data->subcategory_id ? "selected":""}}>
													{{$sub->name}}</option>
												@endforeach
												@endif
		
		
											</select>
										</div>
									</div>
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ $langg->lang640 }}*</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="childcat" name="childcategory_id"
												{{$data->subcategory_id == null ? "disabled":""}}>
												<option value="">{{ $langg->lang641 }}</option>
												@if($data->subcategory_id != null)
												@if($data->childcategory_id == null)
												@foreach($data->subcategory->childs as $child)
												<option value="{{$child->id}}">{{$child->name}}</option>
												@endforeach
												@else
												@foreach($data->subcategory->childs as $child)
												<option value="{{$child->id}} "
													{{$child->id == $data->childcategory_id ? "selected":""}}>{{$child->name}}
												</option>
												@endforeach
												@endif
												@endif
											</select>
										</div>
									</div>
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
		
											</div>
										</div>
										<div class="col-lg-12">
											<ul class="list">
												<li>
													<input class="checkclick1" name="shipping_time_check" type="checkbox"
														id="check1" value="1" {{$data->ship != null ? "checked":""}}>
													<label for="check1">{{ $langg->lang646 }}</label>
												</li>
											</ul>
										</div>
									</div>
		
		
		
									<div class="{{ $data->ship != null ? "":"showbox" }}">
		
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ $langg->lang647 }}* </h4>
												</div>
											</div>
											<div class="col-lg-12">
												<input type="text" class="input-field" placeholder="{{ $langg->lang647 }}"
													name="ship" value="{{ $data->ship == null ? "" : $data->ship }}">
											</div>
										</div>
		
		
									</div>
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
		
											</div>
										</div>
										<div class="col-lg-12">
											<ul class="list">
												<li>
													<input name="size_check" type="checkbox" id="size-check" value="1"
														{{ !empty($data->size) ? "checked":"" }}>
													<label for="size-check">{{ $langg->lang648 }}</label>
												</li>
											</ul>
										</div>
									</div>
									<div class="{{ !empty($data->size) ? "":"showbox" }}" id="size-display">
										<div class="row">
											<div class="col-lg-12">
											</div>
											<div class="col-lg-12">
												<div class="product-size-details" id="size-section">
													@if(!empty($data->size))
													@foreach($data->size as $key => $data1)
													<div class="size-area">
														<span class="remove size-remove"><i class="fas fa-times"></i></span>
														<div class="row">
															<div class="col-md-4 col-sm-6">
																<label>
																	{{ $langg->lang649 }} :
																	<span>
																		{{ $langg->lang650 }}
																	</span>
																</label>
																<input type="text" name="size[]" class="input-field"
																	placeholder="{{ $langg->lang649 }}"
																	value="{{ $data->size[$key] }}">
															</div>
															<div class="col-md-4 col-sm-6">
																<label>
																	{{ $langg->lang651 }} :
																	<span>
																		{{ $langg->lang652 }}
																	</span>
																</label>
																<input type="number" name="size_qty[]" class="input-field"
																	placeholder="{{ $langg->lang651 }}" min="1"
																	value="{{ $data->size_qty[$key] }}">
															</div>
															<div class="col-md-4 col-sm-6">
																<label>
																	{{ $langg->lang653 }} :
																	<span>
																		{{ $langg->lang654 }}
																	</span>
																</label>
																<input type="number" name="size_price[]" class="input-field"
																	placeholder="{{ $langg->lang653 }}" min="0"
																	value="{{round($data->size_price[$key] * $sign->value , 2)}}">
															</div>
														</div>
													</div>
													@endforeach
													@else
													<div class="size-area">
														<span class="remove size-remove"><i class="fas fa-times"></i></span>
														<div class="row">
															<div class="col-md-4 col-sm-6">
																<label>
																	{{ $langg->lang649 }} :
																	<span>
																		{{ $langg->lang650 }}
																	</span>
																</label>
																<input type="text" name="size[]" class="input-field"
																	placeholder="{{ $langg->lang649 }}">
															</div>
															<div class="col-md-4 col-sm-6">
																<label>
																	{{ $langg->lang651 }} :
																	<span>
																		{{ $langg->lang652 }}
																	</span>
																</label>
																<input type="number" name="size_qty[]" class="input-field"
																	placeholder="{{ $langg->lang651 }}" value="1" min="1">
															</div>
															<div class="col-md-4 col-sm-6">
																<label>
																	{{ $langg->lang653 }} :
																	<span>
																		{{ $langg->lang654 }}
																	</span>
																</label>
																<input type="number" name="size_price[]" class="input-field"
																	placeholder="{{ $langg->lang653 }}" value="0" min="0">
															</div>
														</div>
													</div>
													@endif
												</div>
		
												<a href="javascript:;" id="size-btn" class="add-more"><i
														class="fas fa-plus"></i>{{ $langg->lang655 }} </a>
											</div>
										</div>
									</div>
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
		
											</div>
										</div>
										<div class="col-lg-12">
											<ul class="list">
												<li>
													<input class="checkclick1" name="color_check" type="checkbox" id="check3"
														value="1" {{ !empty($data->color) ? "checked":"" }}>
													<label for="check3">{{ $langg->lang656 }}</label>
												</li>
											</ul>
										</div>
									</div>
		
		
		
									<div class="{{ !empty($data->color) ? "":"showbox" }}">
		
										<div class="row">
											@if(!empty($data->color))
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">
														{{ $langg->lang657 }}*
													</h4>
													<p class="sub-heading">
														{{ $langg->lang658 }}
													</p>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="select-input-color" id="color-section">
													@foreach($data->color as $key => $data1)
													<div class="color-area">
														<span class="remove color-remove"><i class="fas fa-times"></i></span>
														<div class="input-group colorpicker-component cp">
															<input type="text" name="color[]" value="{{ $data->color[$key] }}"
																class="input-field cp" />
															<span class="input-group-addon"><i></i></span>
														</div>
													</div>
													@endforeach
												</div>
												<a href="javascript:;" id="color-btn" class="add-more mt-4 mb-3"><i
														class="fas fa-plus"></i>{{ $langg->lang659 }} </a>
											</div>
											@else
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">
														{{ $langg->lang657 }}*
													</h4>
													<p class="sub-heading">
														{{ $langg->lang658 }}
													</p>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="select-input-color" id="color-section">
													<div class="color-area">
														<span class="remove color-remove"><i class="fas fa-times"></i></span>
														<div class="input-group colorpicker-component cp">
															<input type="text" name="color[]" value="#000000"
																class="input-field cp" />
															<span class="input-group-addon"><i></i></span>
														</div>
													</div>
												</div>
												<a href="javascript:;" id="color-btn" class="add-more mt-4 mb-3"><i
														class="fas fa-plus"></i>{{ $langg->lang659 }} </a>
											</div>
		
		
											@endif
										</div>
		
									</div>
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													{{ $langg->lang664 }}*
												</h4>
												<p class="sub-heading">
													({{ $langg->lang665 }} {{$sign->name}})
												</p>
											</div>
										</div>
										<div class="col-lg-12">
											<input name="price" step="0.1" type="number" class="input-field"
												placeholder="{{ $langg->lang666 }}"
												value="{{round($data->price * $sign->value , 2)}}" required="" min="0">
										</div>
									</div>
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ $langg->lang667 }}*</h4>
												<p class="sub-heading">{{ $langg->lang668 }}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<input name="previous_price" step="0.1" type="number" class="input-field"
												placeholder="{{ $langg->lang666 }}"
												value="{{round($data->previous_price * $sign->value , 2)}}" min="0">
										</div>
									</div>
									<div class="{{ !empty($data->size) ? "showbox":"" }}" id="stckprod">
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ $langg->lang669 }}*</h4>
													<p class="sub-heading">{{ $langg->lang670 }}</p>
												</div>
											</div>
											<div class="col-lg-12">
												<input name="stock" type="text" class="input-field"
													placeholder="{{ $langg->lang666 }}" value="{{ $data->stock }}">
												<div class="checkbox-wrapper">
													<input type="checkbox" name="measure_check" class="checkclick1"
														id="allowProductMeasurement" value="1"
														{{ $data->measure == null ? '' : 'checked' }}>
													<label for="allowProductMeasurement">{{ $langg->lang671 }}</label>
												</div>
											</div>
										</div>
		
									</div>
		
									<div class="{{ $data->measure == null ? 'showbox' : '' }}">
		
										<div class="row">
											<div class="col-lg-6">
												<div class="left-area">
													<h4 class="heading">{{ $langg->lang672 }}*</h4>
												</div>
											</div>
											<div class="col-lg-6">
												<select id="product_measure">
													<option value="" {{$data->measure == null ? 'selected':''}}>
														{{ $langg->lang673 }}</option>
													<option value="Gram" {{$data->measure == 'Gram' ? 'selected':''}}>
														{{ $langg->lang674 }}</option>
													<option value="Kilogram" {{$data->measure == 'Kilogram' ? 'selected':''}}>
														{{ $langg->lang675 }}</option>
													<option value="Litre" {{$data->measure == 'Litre' ? 'selected':''}}>
														{{ $langg->lang676 }}</option>
													<option value="Pound" {{$data->measure == 'Pound' ? 'selected':''}}>
														{{ $langg->lang677 }}</option>
													<option value="Custom"
														{{ in_array($data->measure,explode(',', 'Gram,Kilogram,Litre,Pound')) ? '' : 'selected' }}>
														{{ $langg->lang678 }}</option>
												</select>
											</div>
											<div class="col-lg-6 {{ in_array($data->measure,explode(',', 'Gram,Kilogram,Litre,Pound')) ? 'hidden' : '' }}"
												id="measure">
												<input name="measure" type="text" id="measurement" class="input-field"
													placeholder="{{ $langg->lang679 }}" value="{{$data->measure}}">
											</div>
										</div>
		
									</div>
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													Product Description*
												</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="text-editor">
												<textarea name="details" class="nic-edit-p">{{$data->details}}</textarea>
											</div>
										</div>
									</div>
		
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													{{ $langg->lang680 }}*
												</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="text-editor">
												<textarea name="details" class="nic-edit-p">{{$data->details}}</textarea>
											</div>
										</div>
									</div>
		
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													{{ $langg->lang681 }}*
												</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="text-editor">
												<textarea name="policy" class="nic-edit-p">{{$data->policy}}</textarea>
											</div>
										</div>
									</div>
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="checkbox-wrapper">
												<input type="checkbox" name="seo_check" value="1" class="checkclick"
													id="allowProductSEO"
													{{ ($data->meta_tag != null || strip_tags($data->meta_description) != null) ? 'checked':'' }}>
												<label for="allowProductSEO">{{ $langg->lang683 }}</label>
											</div>
										</div>
									</div>
		
		
		
									<div
										class="{{ ($data->meta_tag == null && strip_tags($data->meta_description) == null) ? "showbox":"" }}">
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ $langg->lang684 }} *</h4>
												</div>
											</div>
											<div class="col-lg-12">
												<ul id="metatags" class="myTags">
													@if(!empty($data->meta_tag))
													@foreach ($data->meta_tag as $element)
													<li>{{  $element }}</li>
													@endforeach
													@endif
												</ul>
											</div>
										</div>
		
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">
														{{ $langg->lang685 }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="text-editor">
													<textarea name="meta_description" class="input-field"
														placeholder="{{ $langg->lang685 }}">{{ $data->meta_description }}</textarea>
												</div>
											</div>
										</div>
									</div>
		
		
									<div class="row">
										<div class="col-lg-12 text-center">
											<button class="addProductSubmit-btn" type="submit">{{ $langg->lang706 }}</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="add-product-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="product-description">
							<div class="body-area">
		
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ $langg->lang709 }}*</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="imageSource" name="image_source">
												<option value="file"
													{{ !filter_var($data->photo,FILTER_VALIDATE_URL) ? 'selected' : '' }}>
													{{ $langg->lang710 }}</option>
												<option value="link"
													{{ filter_var($data->photo,FILTER_VALIDATE_URL) ? 'selected' : '' }}>
													{{ $langg->lang711  }}</option>
											</select>
										</div>
									</div>
		
		
									<div id="f-file" {!! filter_var($data->photo,FILTER_VALIDATE_URL) ? 'style="display:none"' :
										'' !!}>
		
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ $langg->lang511 }} *</h4>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="img-upload  custom-image-upload">
													<div id="image-preview" class="img-preview"
														style="background: url({{ $data->photo ? asset('assets/images/products/'.$data->photo):asset('assets/images/noimage.png') }});">
														<label class="img-label" id="image-label"><i
																class="icofont-upload-alt"></i>{{ $langg->lang512 }}</label>
														<input type="file" name="photo" class="img-upload" id="image-upload"
															{{ filter_var($data->photo,FILTER_VALIDATE_URL) ? 'required' : '' }}>
													</div>
													<p class="img-alert mt-2 text-danger d-none"></p>
													<p class="text">
														{{ isset($langg->lang805) ? $langg->lang805 : 'Prefered Size: (800x800) or Square Size.' }}
													</p>
												</div>
		
											</div>
										</div>
		
		
									</div>
		
									<div id="f-link" {!! !filter_var($data->photo,FILTER_VALIDATE_URL) ? 'style="display:none"'
										: '' !!}>
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ $langg->lang712 }} *</h4>
												</div>
											</div>
											<div class="col-lg-12">
		
												<input type="text" name="photolink" value="{{ $data->photo }}"
													class="input-field">
											</div>
										</div>
									</div>
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													{{ $langg->lang644 }} *
												</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<a href="javascript" class="set-gallery" data-toggle="modal"
												data-target="#setgallery">
												<input type="hidden" value="{{$data->id}}">
												<i class="icofont-plus"></i> {{ $langg->lang645 }}
											</a>
										</div>
									</div>
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													{{ $langg->lang664 }}*
												</h4>
												<p class="sub-heading">
													({{ $langg->lang665 }} {{$sign->name}})
												</p>
											</div>
										</div>
										<div class="col-lg-12">
											<input name="price" step="0.1" type="number" class="input-field"
												placeholder="{{ $langg->lang666 }}"
												value="{{round($data->price * $sign->value , 2)}}" required="" min="0">
										</div>
									</div>
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ $langg->lang667 }}*</h4>
												<p class="sub-heading">{{ $langg->lang668 }}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<input name="previous_price" step="0.1" type="number" class="input-field"
												placeholder="{{ $langg->lang666 }}"
												value="{{round($data->previous_price * $sign->value , 2)}}" min="0">
										</div>
									</div>
							
								
									<div class="row">
										<div class="col-lg-12">
											<div class="featured-keyword-area">
												<div class="left-area">
													<h4 class="heading">{{ $langg->lang686 }}</h4>
												</div>
		
												<div class="feature-tag-top-filds" id="feature-section">
													@if(!empty($data->features))
		
													@foreach($data->features as $key => $data1)
		
													<div class="feature-area">
														<span class="remove feature-remove"><i class="fas fa-times"></i></span>
														<div class="row">
															<div class="col-lg-6">
																<input type="text" name="features[]" class="input-field"
																	placeholder="{{ $langg->lang687 }}"
																	value="{{ $data->features[$key] }}">
															</div>
		
															<div class="col-lg-6">
																<div class="input-group colorpicker-component cp">
																	<input type="text" name="colors[]"
																		value="{{ $data->colors[$key] }}"
																		class="input-field cp" />
																	<span class="input-group-addon"><i></i></span>
																</div>
															</div>
														</div>
													</div>
		
		
													@endforeach
													@else
		
													<div class="feature-area">
														<span class="remove feature-remove"><i class="fas fa-times"></i></span>
														<div class="row">
															<div class="col-lg-6">
																<input type="text" name="features[]" class="input-field"
																	placeholder="{{ $langg->lang687 }}">
															</div>
		
															<div class="col-lg-6">
																<div class="input-group colorpicker-component cp">
																	<input type="text" name="colors[]" value="#000000"
																		class="input-field cp" />
																	<span class="input-group-addon"><i></i></span>
																</div>
															</div>
														</div>
													</div>
		
													@endif
												</div>
		
												<a href="javascript:;" id="feature-btn" class="add-fild-btn"><i
														class="icofont-plus"></i> {{ $langg->lang688 }}</a>
											</div>
										</div>
									</div>
		
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ $langg->lang689 }} *</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<ul id="tags" class="myTags">
												@if(!empty($data->tags))
												@foreach ($data->tags as $element)
												<li>{{  $element }}</li>
												@endforeach
												@endif
											</ul>
										</div>
									</div>
		
		
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>

<div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">{{ $langg->lang619 }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="top-area">
					<div class="row">
						<div class="col-sm-6 text-right">
							<div class="upload-img-btn">
								<form method="POST" enctype="multipart/form-data" id="form-gallery">
									{{ csrf_field() }}
									<input type="hidden" id="pid" name="product_id" value="">
									<input type="file" name="gallery[]" class="hidden" id="uploadgallery"
										accept="image/*" multiple>
									<label id="prod_gallery"><i
											class="icofont-upload-alt"></i>{{ $langg->lang620 }}</label>
								</form>
							</div>
						</div>
						<div class="col-sm-6">
							<a href="javascript:;" class="upload-done" data-dismiss="modal"> <i
									class="fas fa-check"></i> {{ $langg->lang621 }}</a>
						</div>
						<div class="col-sm-12 text-center">( <small>{{ $langg->lang622 }}</small> )</div>
					</div>
				</div>
				<div class="gallery-images">
					<div class="selected-image">
						<div class="row">


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
	// Gallery Section Update

	$(document).on("click", ".set-gallery", function () {
		var pid = $(this).find('input[type=hidden]').val();
		$('#pid').val(pid);
		$('.selected-image .row').html('');
		$.ajax({
			type: "GET",
			url: "{{ route('vendor-gallery-show') }}",
			data: {
				id: pid
			},
			success: function (data) {
				if (data[0] == 0) {
					$('.selected-image .row').addClass('justify-content-center');
					$('.selected-image .row').html('<h3>{{ $langg->lang624 }}</h3>');
				} else {
					$('.selected-image .row').removeClass('justify-content-center');
					$('.selected-image .row h3').remove();
					var arr = $.map(data[1], function (el) {
						return el
					});

					for (var k in arr) {
						$('.selected-image .row').append('<div class="col-sm-6">' +
							'<div class="img gallery-img">' +
							'<span class="remove-img"><i class="fas fa-times"></i>' +
							'<input type="hidden" value="' + arr[k]['id'] + '">' +
							'</span>' +
							'<a href="' + '{{asset('
							assets / images / galleries ').' / '}}' + arr[k]['photo'] +
							'" target="_blank">' +
							'<img src="' + '{{asset('
							assets / images / galleries ').' / '}}' + arr[k]['photo'] +
							'" alt="gallery image">' +
							'</a>' +
							'</div>' +
							'</div>');
					}
				}

			}
		});
	});


	$(document).on('click', '.remove-img', function () {
		var id = $(this).find('input[type=hidden]').val();
		$(this).parent().parent().remove();
		$.ajax({
			type: "GET",
			url: "{{ route('vendor-gallery-delete') }}",
			data: {
				id: id
			}
		});
	});

	$(document).on('click', '#prod_gallery', function () {
		$('#uploadgallery').click();
	});


	$("#uploadgallery").change(function () {
		$("#form-gallery").submit();
	});

	$(document).on('submit', '#form-gallery', function () {
		$.ajax({
			url: "{{ route('vendor-gallery-store') }}",
			method: "POST",
			data: new FormData(this),
			dataType: 'JSON',
			contentType: false,
			cache: false,
			processData: false,
			success: function (data) {
				if (data != 0) {
					$('.selected-image .row').removeClass('justify-content-center');
					$('.selected-image .row h3').remove();
					var arr = $.map(data, function (el) {
						return el
					});
					for (var k in arr) {
						$('.selected-image .row').append('<div class="col-sm-6">' +
							'<div class="img gallery-img">' +
							'<span class="remove-img"><i class="fas fa-times"></i>' +
							'<input type="hidden" value="' + arr[k]['id'] + '">' +
							'</span>' +
							'<a href="' + '{{asset('
							assets / images / galleries ').' / '}}' + arr[k]['photo'] +
							'" target="_blank">' +
							'<img src="' + '{{asset('
							assets / images / galleries ').' / '}}' + arr[k]['photo'] +
							'" alt="gallery image">' +
							'</a>' +
							'</div>' +
							'</div>');
					}
				}

			}

		});
		return false;
	});


	// Gallery Section Update Ends	
</script>

<script src="{{asset('assets/admin/js/jquery.Jcrop.js')}}"></script>

<script src="{{asset('assets/admin/js/jquery.SimpleCropper.js')}}"></script>

<script type="text/javascript">
	$('.cropme').simpleCropper();

</script>

<script type="text/javascript">
	$(document).ready(function () {

		let html =
			`<img src="{{ empty($data->photo) ? asset('assets/images/noimage.png') : (filter_var($data->photo, FILTER_VALIDATE_URL) ? $data->photo : asset('assets/images/products/'.$data->photo)) }}" alt="">`;
		$(".span4.cropme").html(html);

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

	});

	$('.ok').on('click', function () {

		setTimeout(
			function () {

				var img = $('#feature_photo').val();

				$.ajax({
					url: "{{route('vendor-prod-upload-update',$data->id)}}",
					type: "POST",
					data: {
						"image": img
					},
					success: function (data) {
						if (data.status) {
							$('#feature_photo').val(data.file_name);
						}
						if ((data.errors)) {
							for (var error in data.errors) {
								$.notify(data.errors[error], "danger");
							}
						}
					}
				});

			}, 1000);

	});
</script>

<script type="text/javascript">
	$('#imageSource').on('change', function () {
		var file = this.value;
		if (file == "file") {
			$('#f-file').show();
			$('#f-link').hide();
			$('#f-link').find('input').prop('required', false);
		}
		if (file == "link") {
			$('#f-file').hide();
			$('#f-link').show();
			$('#f-link').find('input').prop('required', true);
		}
	});
</script>

<script src="{{asset('assets/admin/js/product.js')}}"></script>
@endsection