@extends('admin.layout.content')
@section('main-content')
    <div class="col-md-9">
        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content">
                <div class="sk-spinner sk-spinner-wave">
                    <div class="sk-rect1"></div>
                    <div class="sk-rect2"></div>
                    <div class="sk-rect3"></div>
                    <div class="sk-rect4"></div>
                    <div class="sk-rect5"></div>
                </div>
                <h3 class="text-qrRest-dark text-center">
                    <a href="{{ route('restaurant-manager') }}" class="btn btn-outline btn-primary btn-sm float-left"><i
                            class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    Bàn số : {{ $table->name }} 
                </h3>
                <hr/>
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

                <div class="col-md-12">
                    <div class="row table-responsive" id="nonPayOrder">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Table</th>
                                    <th>Piece</th>
                                    <th>Product</th>
                                    <th>Note</th>
                                    <th>Clock</th>
                                    <th>Status</th>
                                    <th>Cancel</th>
                                    <th>Complete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><br /><br /> You have no new orders. <br /><br /><br /></td>
                                    <td><i class="fa fa-bell-o fa-2x"></i></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
