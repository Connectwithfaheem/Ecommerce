@extends('frontend.layout')
@section('title', 'Daily Shop | Chnage Password')
@section('container')


    <!-- Cart view section -->
    <section id="aa-myaccount">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-myaccount-area">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="aa-myaccount-register">
                                    <h4>Change Password</h4>
                                    <form action="" id="frmUpdatePassword" class="aa-login-form ">
                                        @csrf
                                        <div class="form-group mb-3 position-relative">
                                            <label class="col-form-label">Password<span>*</span></label>
                                            <input class="form-control" type="password" required name="password" id="password"
                                                 placeholder="********">
                                            <span id="password_error" style="color: red; font-size:16px" class="field_error"></span>
                                            <a href="javascript:void(0)" style="
                                                position: absolute;
                                                right: 10px;
                                                bottom: 4px;
                                                padding: 6px 12px;
                                                line-height: initial;
                                                border-radius: 4px;
                                                color: #fff !important;
                                                font-size: 12px;
                                                "
                                              class="hide-show btn btn-primary">
                                                <span><i class="fa fa-eye" aria-hidden="true"></i></span>
                                            </a>
                                        </div>
                                        <button type="submit"  id="btnUpdatePassword" class="aa-browse-btn btn-submit">Update Password</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="password_msg" style="color: red; font-size:16px; margin:10px;"></div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Cart view section -->
    <script>
        $(function() {
            $('.hide-show').show();
            $('.hide-show').addClass('show')

            $('.hide-show').click(function() {
                if ($(this).hasClass('show')) {
                    $(this).text('Hide');
                    $('#password').attr('type', 'text');
                    $(this).removeClass('show');
                } else {
                    $(this).text('Show');
                    $('#password').attr('type', 'password');
                    $(this).addClass('show');
                }
            });

            $('form button[type="submit"]').on('click', function() {
                $('.hide-show').text('Show').addClass('show');
                $('.hide-show').parent().find('#password').attr('type', 'password');
            });
        });
    </script>




@endsection
