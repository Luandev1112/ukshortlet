@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body">

                    <div class="row justify-content-between">
                        <div class="col-md-8">
                            <form action="{{route('admin.inventories')}}" id="search_form" method="GET" >
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="key" class="control-label font-weight-bold">Stock Code</label>
                                        <select class="form-control form-control-sm search_stock_code" id="search_stock_code" name="stock_code">
                                            <option value="">All</option>
                                            @foreach ($category_items as $cate)
                                                @if($search_stock == $cate->stock_code)
                                                <option value="{{ $cate->stock_code }}" selected>{{ $cate->stock_code }}</option>
                                                @else
                                                <option value="{{ $cate->stock_code }}">{{ $cate->stock_code }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="key" class="control-label font-weight-bold">Update Day</label>
                                        @if($update_day)
                                        <input type="date" class="form-control form-control-sm update_date" id="serch_update_day" name="update_day" placeholder="" value="{{ $update_day }}">
                                        @else
                                        <input type="date" class="form-control form-control-sm update_date" id="serch_update_day" name="update_day" placeholder="">
                                        @endif
                                         
                                    </div>
                                    
                                </div>
                            </form>
                            
                        </div>
                        <div class="col-md-4 mt-md-0 mt-3">
                            <button type="button" data-toggle="modal" data-target="#addModal" class="btn btn-sm btn--primary box--shadow1 text--small float-right"><i class="la la-download"></i> Import Data </button>

                        </div>
                    </div>
                    <hr>


                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light">
                            <thead>
                            <tr>
                                <th scope="col"> Day </th>
                                <th scope="col"> Stock Code </th>
                                <th scope="col"> Eps </th>
                                <th scope="col"> P/E </th>
                                <th scope="col"> FWPE </th>
                  <!--               <th scope="col"> Fastest revenue </th>
                                <th scope="col"> Most Consistent Revenue </th>
                                <th scope="col"> Annual Revenue </th>
                                <th scope="col"> Profit After Tax </th>
                                <th scope="col"> Profit After Previous Tax </th>
                                <th scope="col"> Profit After Tax Return </th>
                                <th scope="col"> Best eps4 </th>
                                <th scope="col"> bvps_co_ban </th>
                                <th scope="col"> pe_co_ban </th>
                                <th scope="col"> roea </th>
                                <th scope="col"> roaa </th>
                                <th scope="col"> tong_tai_san </th>
                                <th scope="col"> tong_no </th>
                                <th scope="col"> flower </th>
                                <th scope="col"> khoi_luong_giao_dich </th>
                                <th scope="col"> original_price </th>
                                <th scope="col"> PEIM_PE </th> -->
                                <th scope="col"> Industry trend </th>
                                <th scope="col"> Push trend </th>
                                <th scope="col"> Finance Performance </th>
                                <th scope="col"> Leaders Reputation </th>
                                <!-- <th scope="col"> share_code </th> -->
                                <th scope="col"> Current price </th>
                                <th scope="col"> Sell price </th>
                                <!-- <th scope="col"> flag_active </th> -->
                                <th scope="col"> Expected price </th>
                                <th scope="col"> Interest </th>
                                <!-- <th scope="col"> interest_price </th> -->
                               <!--  <th scope="col"> created_at </th>
                                <th scope="col"> updated_at </th> -->

                            </tr>
                            </thead>
                            <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td data-label="Date" scope="col"> {{ $item->update_day }}</td>
                                    <td data-label="stock code" scope="col"><a rel="{{ $item->id }}" class="stock-a" type="button" data-toggle="modal" data-target="#editModal" href="#editModal"> {{ $item->stock_code }} </a></td>
                                    <td data-label="Eps" scope="col"> {{ $item->eps }}</td>
                                    <td data-label="P/E" scope="col"> {{ $item->pe }}</td>
                                    <td data-label="FWPE" scope="col"> {{ $item->fwpe }}</td>
                                    <!-- <td data-label="doanh_thu_quy_gan_nhat" scope="col"> {{ $item->doanh_thu_quy_gan_nhat }}</td>
                                    <td data-label="doanh_thu_quy_truoc_gan_nhat" scope="col"> {{ $item->doanh_thu_quy_truoc_gan_nhat }}</td>
                                    <td data-label="doanh_thu_quy_cung_ky_nam_truoc" scope="col"> {{ $item->doanh_thu_quy_cung_ky_nam_truoc }}</td>
                                    <td data-label="loi_nhuan_sau_thue_quy_gan_nhat" scope="col"> {{ $item->loi_nhuan_sau_thue_quy_gan_nhat }}</td>
                                    <td data-label="loi_nhuan_sau_thue_quy_truoc_gan_nhat" scope="col"> {{ $item->loi_nhuan_sau_thue_quy_truoc_gan_nhat }}</td>
                                    <td data-label="loi_nhuan_sau_thue_quy_cung_ky_nam_truoc" scope="col"> {{ $item->loi_nhuan_sau_thue_quy_cung_ky_nam_truoc }}</td>
                                    <td data-label="eps_4_quy_gan_nhat" scope="col"> {{ $item->eps_4_quy_gan_nhat }}</td>
                                    <td data-label="bvps_co_ban" scope="col"> {{ $item->bvps_co_ban }}</td>
                                    <td data-label="pe_co_ban code" scope="col"> {{ $item->pe_co_ban }}</td>
                                    <td data-label="roea" scope="col"> {{ $item->roea }}</td>
                                    <td data-label="roaa" scope="col"> {{ $item->roaa }}</td>
                                    <td data-label="tong_tai_san" scope="col"> {{ $item->tong_tai_san }}</td>
                                    <td data-label="tong_no" scope="col"> {{ $item->tong_no }}</td>
                                    <td data-label="von_hoa" scope="col"> {{ $item->von_hoa }}</td>
                                    <td data-label="khoi_luong_giao_dich" scope="col"> {{ $item->khoi_luong_giao_dich }}</td>
                                    <td data-label="original_price" scope="col"> {{ $item->original_price }}</td>
                                    <td data-label="PEIM_PE" scope="col"> {{ $item->PEIM_PE }}</td> -->
                                    <td data-label="Industry trend" scope="col"> {{ $item->industry_trend }}</td>
                                    <td data-label="Push trend" scope="col"> {{ $item->push_trend }}</td>
                                    <td data-label="Finance Performance" scope="col"> {{ $item->finance_of_company_performance }}</td>
                                    <td data-label="Leaders reputation" scope="col"> {{ $item->leaders_reputation_impact }}</td>
                                    <!-- <td data-label="share code" scope="col"> {{ $item->share_code }}</td> -->
                                    <td data-label="Current price" scope="col"> {{ $item->current_price }}</td>
                                    <td data-label="Sell price" scope="col"> {{ $item->sell_price }}</td>
                                    <!-- <td data-label="flag active" scope="col"> {{ $item->flag_active }}</td> -->
                                    <td data-label="Expected price" scope="col"> {{ $item->expected_price }}</td>
                                    <td data-label="Interest" scope="col"> {{ $item->interest }}</td>
                                    <!-- <td data-label="interest price" scope="col"> {{ $item->interest_price }} </td> -->
                                   <!--  <td data-label="created at" scope="col"> {{ $item->created_at }}</td>
                                    <td data-label="updated at" scope="col"> {{ $item->updated_at }}</td> -->
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ trans($empty_message) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ $items->links('admin.partials.paginate') }}
                </div>
            </div><!-- card end -->
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> @lang('Add New')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                </div>

                <form action="{{route('admin.inventories.import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="key" class="control-label font-weight-bold">@lang('Key')</label>

                            <input type="file" class="form-control form-control-lg file " id="csv_file" name="csv_file"
                                   placeholder="">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary"> @lang('Save')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> Parameter Input </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                </div>

                <form action="{{route('admin.inventory.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="inventory_id" name="id">
                            <div class="form-group col-md-6">
                                <label for="key" class="control-label font-weight-bold">Date</label>
                                <input type="date" class="form-control form-control-lg update_date" id="csv_file" name="update_date"
                                       placeholder="" date-format="yyyy-mm-dd">

                            </div>

                            <div class="form-group col-md-6">
                                <label for="key" class="control-label font-weight-bold">Stock</label>

                                <input type="text" class="form-control form-control-lg stock_code " id="csv_file" name="stock_code"
                                       placeholder="">
                            </div>
                        </div><br><br>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="key" class="control-label font-weight-bold">Industry Trend</label>

                                <input type="text" class="form-control form-control-lg industry_trend " name="industry_trend"
                                       placeholder="">

                            </div>

                            <div class="form-group col-md-6">
                                <label for="key" class="control-label font-weight-bold">Finance Performance</label>

                                <input type="text" class="form-control form-control-lg finance_performance " id="csv_file" name="finance_performance"
                                       placeholder="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="key" class="control-label font-weight-bold">Leaders Reputation</label>

                                <input type="text" class="form-control form-control-lg reputation " id="csv_file" name="reputation"
                                       placeholder="">

                            </div>

                            <div class="form-group col-md-6">
                                <label for="key" class="control-label font-weight-bold">Push Trend</label>

                                <input type="text" class="form-control form-control-lg push_trend " id="csv_file" name="push_trend"
                                       placeholder="">
                            </div>
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">Reset</button>
                        <button type="submit" class="btn btn--primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="parameterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> Parameter Input </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                </div>

                <form action="{{route('admin.inventory.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mt-20 mb-20 warning-alert" style="display: none;">
                                <h3 class="color-danger text-center" style="color: red">No Clearance code. Please re-input another</h3>
                            </div>

                            <div class="col-md-12 mt-20 mb-20 success-alert" style="display: none;">
                                <h3 class="color-danger text-center" style="color: blue">Updated successfully</h3>
                            </div>
                            
                        </div>
                        <div class="row">
                            <input type="hidden" class="inventory_id" name="id">
                            <div class="form-group col-md-6">
                                <label for="key" class="control-label font-weight-bold">Date</label>
                                <input type="date" class="form-control form-control-lg update_date" id="csv_file" name="update_date"
                                       placeholder="" date-format="yyyy-mm-dd">

                            </div>

                            <div class="form-group col-md-6">
                                <label for="key" class="control-label font-weight-bold">Stock</label>

                                <input type="text" class="form-control form-control-lg stock_code " id="csv_file" name="stock_code"
                                       placeholder="">
                            </div>
                        </div><br><br>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="key" class="control-label font-weight-bold">Industry Trend</label>

                                <input type="text" class="form-control form-control-lg industry_trend " name="industry_trend"
                                       placeholder="">

                            </div>

                            <div class="form-group col-md-6">
                                <label for="key" class="control-label font-weight-bold">Finance Performance</label>

                                <input type="text" class="form-control form-control-lg finance_performance " id="csv_file" name="finance_performance"
                                       placeholder="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="key" class="control-label font-weight-bold">Leaders Reputation</label>

                                <input type="text" class="form-control form-control-lg reputation " id="csv_file" name="reputation"
                                       placeholder="">

                            </div>

                            <div class="form-group col-md-6">
                                <label for="key" class="control-label font-weight-bold">Push Trend</label>

                                <input type="text" class="form-control form-control-lg push_trend " id="csv_file" name="push_trend"
                                       placeholder="">
                            </div>
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" id="btn_add_reset" >Reset</button>
                        <button type="button" class="btn btn--primary" id="btn_add_submit">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        var baseUrl = "{{ url('admin') }}";
    </script>
@endsection


