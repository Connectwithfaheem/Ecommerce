@extends('frontend.layout')
@section('title', 'Daily Shop | Rsegistration Page')
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
                                    <h4>Register</h4>
                                    <form action="" id="frmRegistration" class="aa-login-form ">
                                        @csrf
                                        <label for="">Name<span>*</span></label>
                                        <input type="text" class="form-control"  name="name"
                                            placeholder="Full Name">

                                        <div id="name_error" style="color: red; font-size:16px" class="field_error"></div>

                                        <label for="">Email<span>*</span></label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Email">
                                        <div id="email_error" style="color: red; font-size:16px" class="field_error"></div>

                                        <label for="">Mobile<span>*</span></label>
                                        <input type="number" name="mobile" class="form-control"
                                            placeholder="ex: 03103002002">
                                        <div id="mobile_error" style="color: red; font-size:16px" class="field_error"></div>

                                        <div class="form-group mb-3 position-relative">
                                            <label class="col-form-label">Password<span>*</span></label>
                                            <input class="form-control" type="password" name="password" id="password"
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


                                        <label for="">Confirm Password<span>*</span></label>
                                        <input type="password" name="password_confirmation" id="confirm_password"
                                            placeholder="********" >
                                        <span id="password_confirmation_error" style="color: red; font-size:16px" class="field_error"></span>

                                        <button type="submit"  id="btnRegistration" class="aa-browse-btn btn-submit">Register</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="success_msg" style="color: red; font-size:16px; margin:10px;"></div>

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
