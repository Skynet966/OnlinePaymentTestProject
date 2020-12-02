<?php
session_start();
if (isset($_POST["SubmitData"])) {
    $api_key = "16630iRX27NSvssxLrBPXJDirxT4ZZTcBW4Ajaz08qSpDiwyceDqL2jhOTjey0zfpCHa";
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $address = $_POST["address"];
    $orderId = $_POST["order_id"];
    $country = $_POST["country"];
    $state = $_POST["state"];
    $city = $_POST["city"];
    $zip = $_POST["zip"];
    $email = $_POST["email"];
    $phoneNo = $_POST["phone_no"];
    $amount = $_POST["amount"];
    $currency = $_POST["currency"];

    $data = [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'address' => $address,
        'sulte_apt_no' => 'ORDER-' . $orderId,
        'country' => $country,
        'state' => $state, // if your country US then use only 2 letter state code.
        'city' => $city,
        'zip' => $zip,
        'ip_address' => '192.168.168.4',
        'birth_date' => '06/12/1990',
        'email' => $email,
        'phone_no' => $phoneNo,
        'card_type' => '2', // See your card type in list
        'amount' => $amount,
        'currency' => $currency,
        'response_url' => 'https://ipaymentgateway.000webhostapp.com',
    ];
    $_SESSION["data"] = $data;
}else{
    header("Location: /");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="iPayTotal Checkout Form provide Quality and secure payment digital gateway." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/logo01.png" />
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <!-- font aswsome-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <!-- google fonts (BM Plex Sans)-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@200;400&display=swap" rel="stylesheet" />
    <!-- Base Css Styles -->
    <link rel="stylesheet" href="./assets/css/style.css" />
    <title>iPayTotal Checkout Form</title>
</head>

<body>
    <!-- Main body area Start-->
    <div class="container">
        <div class="payment__box mx-auto my-5">
            <div class="card">
                <div class="card__header container-fluid px-4 py-3">
                    <div class="logo__container row">
                        <div class="col"><img src="./assets/images/logo.png" alt="iPayTotal logo" width='150'></div>
                        <div class="col text-right">
                            <div class="price__container float-right p-2"><span>USD <?php echo $_POST["amount"]; ?></span></div>
                        </div>
                    </div>
                </div>
                <form action="/" method='POST'>
                    <div class="card__body py-3">
                        <div class="form-group col-md-12">
                            <label for="card_number">Card Number</label>
                            <input name='card_no' type="text" pattern="(?:4[0-9]{12}(?:[0-9]{3})?|(?:5[1-5][0-9]{2}| 222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12})" class="form-control" id="card_number" placeholder="XXXX XXXX XXXX XXXX" maxlength="16" required />
                        </div>
                        <div class="form-row justify-content-between px-3">
                            <div class="form-group col-md-5">
                                <label for="expiry_month">Expiry Month</label>
                                <select name='expiry_month' type="Number" class="form-control" id="expiry_month" required>
                                    <option selected disabled> -- Select Exp. Month -- </option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="expiry_year">Expiry Year</label>
                                <select name='expiry_year' type="Number" class="form-control" id="expiry_year" required>
                                    <option selected disabled> -- Select Exp. Year -- </option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                    <option value="2031">2031</option>
                                    <option value="2032">2032</option>
                                    <option value="2033">2033</option>
                                    <option value="2034">2034</option>
                                    <option value="2035">2035</option>
                                    <option value="2036">2036</option>
                                    <option value="2037">2037</option>
                                    <option value="2038">2038</option>
                                    <option value="2039">2039</option>
                                    <option value="2040">2040</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="cvv_number">CVV Number</label>
                            <input name='cvv_number' type="Number" class="form-control" id="cvv_number" min="100" max="999" placeholder="e.g: 123" required />
                        </div>
                    </div>
                    <div class="card__footer py-3">
                        <div class="form-row justify-content-sm-center px-3">
                            <div class="col text-right"><button name='submitPayment' type="submit" class="btn btn-blue">Pay</button>
                            </div>
                            <div class="col"><button type="reset" class="btn btn-blue">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="fly__footer">
        <div class="partner__images__container text-right">
            <img src="./assets/images/partners_logos/american_exp_footer.jpg" alt="partners logo" width='80'>
            <img src="./assets/images/partners_logos/card-logos.jpg" alt="partners logo" width='80'>
            <img src="./assets/images/partners_logos/comodo.png" alt="partners logo" width='80'>
            <img src="./assets/images/partners_logos/jcb_logo_footer.jpg" alt="partners logo" width='80'>
            <img src="./assets/images/partners_logos/mastercard_logo_footer.jpg" alt="partners logo" width='80'>
            <img src="./assets/images/partners_logos/norton_logo_footer.jpg" alt="partners logo" width='80'>
            <img src="./assets/images/partners_logos/pci_logo_footer.jpg" alt="partners logo" width='80'>
            <img src="./assets/images/partners_logos/SafeSecureLogo.jpg" alt="partners logo" width='80'>
            <img src="./assets/images/partners_logos/sitelock.png" alt="partners logo" width='80'>
            <img src="./assets/images/partners_logos/ssl.png" alt="partners logo" width='80'>
            <img src="./assets/images/partners_logos/visa_logo_footer.jpg" alt="partners logo" width='80'>
        </div>
    </footer>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <!-- Base js for index page -->
    <script src="./assets/js/index.js"></script>
</body>

</html>