<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Instrument+Serif&family=Roboto:wght@100&display=swap');
        .email{

            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            line-height: 1.5em;
            color: #ff6666;
            padding: 20px;
            max-width: 600px;
            margin: 50px auto;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <section class="email">

        Dear <b>{{ $name }}</b><br/>

        We received a request to reset your Andaaz Offcial password.
        click the below link to reset your password:<br/><br/>

        <a style="margin: 40px; background-color: rgb(0, 0, 0);padding: 10px; color: #ccc; font-size: 20px;" href="{{ url('/forget_password_change') }}/{{$rand_id}}"><b>Click here</b></a><br/><br/>

        Should you have any questions, please do not hesitate to contact us at <a href="mailto:dilshadgopang000@gmail.com">dilshadgopang000@gmail.com</a><br>

        <b>Thanks & Regards</b><br/>
        <b>Andaaz Offcial</b><br/>
        </section>

</body>
</html>
