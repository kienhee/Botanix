@extends('layouts.client.index')
@section('title', 'The project has been submitted successfully')
@section('content')

    <section class="submit__success ">
        <h2 class="submit__success-title">The project has been submitted successfully</h2>
        <p class="submit__success-notice">Please wait while we check the information.</p>
        <a class="submit__success-link" href="/">Return to home page (<span id="countdown">5s</span>)</a>


    </section>
    <script>
        // Hàm đếm ngược từ 5 giây và cập nhật trang
        function countdown() {
            const countdownElement = document.getElementById("countdown");
            let count = 5;

            const interval = setInterval(function() {
                if (count === 0) {
                    countdownElement.innerHTML = "Chuyển hướng";
                    clearInterval(interval);
                    window.location.href = '/';
                } else {
                    countdownElement.innerHTML = count + "s";
                    count--;
                }
            }, 1000); // Cập nhật mỗi giây
        }

        // Gọi hàm đếm ngược khi trang web được tải
        window.onload = countdown;
    </script>
@endsection
