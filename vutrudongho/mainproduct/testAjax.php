<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div id="result"></div>
    <script>
        $(document).ready(function() {
            var maxPrice;

            // Lấy dữ liệu từ file get-data.php
            $.ajax({
                url: 'get-max-product-price.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // var html = '';
                    $.each(data, function(index, item) {
                        // html += '<p>' + item.maxProductPrice + '</p>';
                        maxPrice = item.maxProductPrice;
                    });
                    // $('#result').html(html);
                    console.log(maxPrice);
                },
                error: function() {
                    alert('Lỗi khi lấy dữ liệu');
                }
            });
        });
    </script>
</body>

</html>