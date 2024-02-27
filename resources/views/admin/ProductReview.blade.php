@extends('admin.layout')
@section('title', 'Product Reviews')
@section('productReview_select', 'active')
@section('container')

    <h1>Products Review</h1>
        <div class="row">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="row m-t-30">
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product ID</th>
                                        <th>Customer Name</th>
                                        <th>Rating </th>
                                        <th>Review</th>
                                        <th>Added On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($product_review)
                                        @foreach ($product_review as $review)
                                            <tr>
                                                <td>{{ $review->id }}</td>
                                                <td>{{ $review->pid }}</td>
                                                <td>{{ $review->name }}</td>
                                                <td> @if ($review->rating==1)
                                                    <div style="color: gold; display: inline-block;">&#9733;</div>
                                                    @endif
                                                    @if ($review->rating==2)
                                                    <div style="color: gold; display: inline-block;">&#9733;&#9733;</div>
                                                    @endif
                                                    @if ($review->rating==3)
                                                    <div style="color: gold; display: inline-block;">&#9733;&#9733;&#9733;</div>
                                                    @endif
                                                    @if ($review->rating==4)
                                                    <div style="color: gold; display: inline-block;">&#9733;&#9733;&#9733;&#9733;</div>
                                                    @endif
                                                    @if ($review->rating==5)
                                                    <div style="color: gold; display: inline-block;">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                                                    @endif</td>
                                                <td>{{ $review->review }}</td>
                                                <td>{{ $review->added_on }}</td>
                                                <td>
                                                    @if ($review->status == 1)
                                                        <a href="{{ url('admin/productReview/review_status_update/0') }}/{{ $review->id }}"
                                                            class="btn btn-primary">Active</a>
                                                    @elseif ($review->status == 0)
                                                        <a href="{{ url('admin/productReview/review_status_update/1') }}/{{ $review->id }}"
                                                            class="btn btn-warning">Deactive</a>
                                                    @endif

                                                    {{-- <form action="review/{{ $review->id }}/delete" method="POST"
                                                        class="d-inline ">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger deleteBtn"> <i
                                                                class="fas fa-trash"></i>DELETE</button>
                                                    </form> --}}

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- END DATA TABLE-->
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>

    @endsection
