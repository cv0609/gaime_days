<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body style=" height: 100%; font-family: Open Sans, sans-serif;background-color: #f9f9f9; margin: 0; padding: 0;">
    <div
        style="width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);  position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);">

        <table width="100%" cellspacing="0">
            <tr style="padding: 20px; text-align: center; color: #ffffff;">
                <td style="padding: 10px;">
                    <a href="#" target="_blank"> <img src="img/Logo-dark-n.png" alt="logo"
                            style="max-width: 150px; width:100%;">
                    </a>
                </td>
            </tr>
            <tr style="    background-image: linear-gradient(135deg, #15cd00 0%, #72e001 100%); color: #ffffff;">
                <td
                    style="padding:36px 48px;display:block;text-align:center;padding-top:15px;padding-bottom:15px;padding-left:48px;padding-right:48px">
                    <h1 style="margin: 0; font-size: 30px;">User Details
                    </h1>
                </td>
            </tr>

            <table style="padding: 0 30px; margin-top: 20px;" cellspacing="0" width="100%">
                <tr>
                    <td>
                        <p><strong>Full Name :</strong> {{$contact['full_name']}}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><strong>Email :</strong> {{ $contact['email'] }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><strong>Subject :</strong> {{ $contact['subject'] }}</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p><strong>Message :</strong> {{ $contact['message'] }}
                        </p>
                    </td>
                </tr>

            </table>

            {{-- <table style="border-top: 1px solid #00c900;  padding-top: 20px; margin-top: 20px; " cellspacing="0" width="100%">
                <tr style="display: flex; justify-content: center; gap: 20px;">
                    <td
                        style="width: 40px; height: 40px;  border-radius: 50%;    background-image: linear-gradient(135deg, #00c900 0%, #8ae501 100%);       display: flex; justify-content: center; align-items: center;">
                        <a href="#" style="color: #fff;"><i class="fa-brands fa-instagram"></i></a>
                    </td>
                    <td
                        style="width: 40px; height: 40px;  border-radius: 50%;   background-image: linear-gradient(135deg, #00c900 0%, #8ae501 100%); display: flex; justify-content: center; align-items: center;">
                        <a href="#" style="color: #fff;"><i class="fa-brands fa-x-twitter"></i></a>
                    </td>
                    <td
                        style="width: 40px; height: 40px;  border-radius: 50%;   background-image: linear-gradient(135deg, #00c900 0%, #8ae501 100%); display: flex; justify-content: center; align-items: center;">
                        <a href="#" style="color: #fff;"><i class="fa-brands fa-facebook-f"></i></a>
                    </td>
                </tr>


            </table> --}}

            <table width="600" cellspacing="0" cellpadding="20"
            style="text-align:center ; background-color: #333;  color:#15cd00;  margin-top:20px; border-top: 1px solid;">
            <tr>
                <td>
                    &copy; Thank you for your submission!
                </td>
            </tr>
        </table>


        </table>


    </div>
    <script>
        // JavaScript to ensure both cells have the same height
        window.onload = function () {
            var billingCell = document.getElementById('billing-cell');
            var shippingCell = document.getElementById('shipping-cell');

            var billingHeight = billingCell.offsetHeight;
            var shippingHeight = shippingCell.offsetHeight;

            var maxHeight = Math.max(billingHeight, shippingHeight);

            billingCell.style.height = maxHeight + 'px';
            shippingCell.style.height = maxHeight + 'px';
        };
    </script>
</body>

</html>