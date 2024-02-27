@extends('admin.layout')
@section('title', 'customer')
@section('suctomer_select', 'active')
@section('container')

    <h1>Show Customer Detail</h1>
    <div class="container m-3"></div>
    <a href="{{ route('customer') }}">
        <button type="button" class="btn btn-success">Back</button>
    </a>
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
                                        <th><b>Field</b></th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                            <tr>
                                                <td><b>Name</b></td>
                                                <td>{{ $customerList->name }}</td>

                                            </tr>
                                            <tr>
                                                <td><b>Email</b></td>
                                                <td>{{ $customerList->email }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Mobile</b></td>
                                                <td>{{ $customerList->mobile }}</td>

                                            </tr>
                                            <tr>
                                                <td><b>Address</b></td>
                                                <td>{{ $customerList->address }}</td>

                                            </tr>
                                            <tr>
                                                <td><b>Password</b></td>
                                                <td>{{ Crypt::decrypt($customerList->password) }}</td>


                                            </tr>
                                            <tr>
                                                <td><b>City</b></td>
                                                <td>{{ $customerList->city }}</td>

                                            </tr>
                                            <tr>
                                                <td><b>State</b></td>
                                                <td>{{ $customerList->state }}</td>

                                            </tr>
                                            <tr>
                                                <td><b>Zip Code</b></td>
                                                <td>{{ $customerList->zip }}</td>

                                            </tr>
                                            <tr>
                                                <td><b>Company</b></td>
                                                <td>{{ $customerList->company }}</td>

                                            </tr>
                                            <tr>
                                                <td><b>GST Number</b></td>
                                                <td>{{ $customerList->gstin }}</td>

                                            </tr>
                                            <tr>
                                                <td><b>Status</b></td>

                                                @if($customerList->status == 1)
                                                <td>Active</td>
                                                @else
                                                <td>Deactive</td>
                                                @endif

                                            </tr>
                                            <tr>
                                                <td><b>Created On</b></td>

                                                <td>{{ date('d-m-Y H:i A', strtotime($customerList->created_at))}}</td>

                                            </tr>

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
