<?php
session_start();
$url = "https://ipaytotal.solutions/api/transaction";
$key = "16630iRX27NSvssxLrBPXJDirxT4ZZTcBW4Ajaz08qSpDiwyceDqL2jhOTjey0zfpCHa";
if (isset($_POST["submitPayment"])) {
    $cardNo = $_POST["card_no"];
    $expMonth=$_POST["expiry_month"];
    $expYear=$_POST["expiry_year"];
    $cvvNumber=$_POST["cvv_number"];
    $data = $_SESSION["data"];
    
    $data['api_key'] = $key;
    $data['card_no'] = $cardNo;
    $data['ccExpiryMonth'] = $expMonth;
    $data['ccExpiryYear'] = $expYear;
    $data['cvvNumber'] =  $cvvNumber;
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    $response = curl_exec($curl);
    curl_close($curl);

    $responseData = json_decode($response);
    $resData=get_object_vars($responseData);
    $_SESSION["status"]=$resData["status"];
    $_SESSION["message"]=$resData["message"];
    if($resData["status"]=="3d_redirect"){
        header('Location: '.$resData["redirect_3ds_url"]);
    }
}elseif(isset($_GET["status"])){
    $_SESSION["status"]=$_GET["status"];
    $_SESSION["message"]=$_GET["message"];
}else{
    $_SESSION["status"]="";
    $_SESSION["message"]="";
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
        <header class="header">
            <div class="image__container my-3 text-center"><img src="./assets/images/logo.png" alt="iPayment Logo" class="logo" width="250" /></div>
        </header>
        <?php if($_SESSION["status"]=="success"){
            echo 
                '<div class="alert alert-success" role="alert">
                    <strong>'.$_SESSION["status"].'!&nbsp;</strong>'. $_SESSION["message"]
                .'</div>';
        }elseif($_SESSION["status"]=="fail"){
                echo 
                '<div class="alert alert-success" role="alert">
                    <strong>'.$_SESSION["status"].'!&nbsp;</strong>'.$_SESSION["message"]
                .'</div>';
        } ?>
        <div class="form__container mb-3 p-4" data-label='Billing Info'>
            <form action="/paymentGateway.php" method='POST'>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="first_name">First Name<code style="font-weight: 900; font-size: 20px; margin-left: 4px">*</code></label>
                        <input name='first_name' type="text" pattern="^[A-Za-z][\S]{1,32}" class="form-control" id="first_name" placeholder="First Name" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_name">Last Name<code style="font-weight: 900; font-size: 20px; margin-left: 4px">*</code></label>
                        <input name='last_name' type="text" pattern="^[A-Za-z][\S]{1,32}" class="form-control" id="last_name" placeholder="Last Name" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="address">Address<code style="font-weight: 900; font-size: 20px; margin-left: 4px">*</code></label>
                        <input name='address' type="text" class="form-control" id="address" placeholder="Address" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="customer_order_id_number">Customer Order ID Number<code style="font-weight: 900; font-size: 20px; margin-left: 4px">*</code></label>
                        <input name='order_id' type="number" class="form-control" id="customer_order_id_number" placeholder="Customer Order ID Number" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="country">Country<code style="font-weight: 900; font-size: 20px; margin-left: 4px">*</code></label>
                        <select name='country' id="country" class="form-control" name="country" required>
                            <option value="" selected disabled> -- Select your Country -- </option>
                            <option value="AF">Afghanistan</option>
                            <option value="AX">Åland Islands</option>
                            <option value="AL">Albania</option>
                            <option value="DZ">Algeria</option>
                            <option value="AS">American Samoa</option>
                            <option value="AD">Andorra</option>
                            <option value="AO">Angola</option>
                            <option value="AI">Anguilla</option>
                            <option value="AQ">Antarctica</option>
                            <option value="AG">Antigua and Barbuda</option>
                            <option value="AR">Argentina</option>
                            <option value="AM">Armenia</option>
                            <option value="AW">Aruba</option>
                            <option value="AU">Australia</option>
                            <option value="AT">Austria</option>
                            <option value="AZ">Azerbaijan</option>
                            <option value="BS">Bahamas</option>
                            <option value="BH">Bahrain</option>
                            <option value="BD">Bangladesh</option>
                            <option value="BB">Barbados</option>
                            <option value="BY">Belarus</option>
                            <option value="BE">Belgium</option>
                            <option value="BZ">Belize</option>
                            <option value="BJ">Benin</option>
                            <option value="BM">Bermuda</option>
                            <option value="BT">Bhutan</option>
                            <option value="BO">Bolivia</option>
                            <option value="BA">Bosnia and Herzegovina</option>
                            <option value="BW">Botswana</option>
                            <option value="BV">Bouvet Island</option>
                            <option value="BR">Brazil</option>
                            <option value="IO">British Indian Ocean Territory</option>
                            <option value="BN">Brunei Darussalam</option>
                            <option value="BG">Bulgaria</option>
                            <option value="BF">Burkina Faso</option>
                            <option value="BI">Burundi</option>
                            <option value="KH">Cambodia</option>
                            <option value="CM">Cameroon</option>
                            <option value="CA">Canada</option>
                            <option value="CV">Cape Verde</option>
                            <option value="KY">Cayman Islands</option>
                            <option value="CF">Central African Republic</option>
                            <option value="TD">Chad</option>
                            <option value="CL">Chile</option>
                            <option value="CN">China</option>
                            <option value="CX">Christmas Island</option>
                            <option value="CC">Cocos (Keeling) Islands</option>
                            <option value="CO">Colombia</option>
                            <option value="KM">Comoros</option>
                            <option value="CG">Congo</option>
                            <option value="CD">Congo, The Democratic Republic of The</option>
                            <option value="CK">Cook Islands</option>
                            <option value="CR">Costa Rica</option>
                            <option value="CI">Cote D&#039;ivoire</option>
                            <option value="HR">Croatia</option>
                            <option value="CU">Cuba</option>
                            <option value="CY">Cyprus</option>
                            <option value="CZ">Czech Republic</option>
                            <option value="DK">Denmark</option>
                            <option value="DJ">Djibouti</option>
                            <option value="DM">Dominica</option>
                            <option value="DO">Dominican Republic</option>
                            <option value="EC">Ecuador</option>
                            <option value="EG">Egypt</option>
                            <option value="SV">El Salvador</option>
                            <option value="GQ">Equatorial Guinea</option>
                            <option value="ER">Eritrea</option>
                            <option value="EE">Estonia</option>
                            <option value="ET">Ethiopia</option>
                            <option value="FK">Falkland Islands (Malvinas)</option>
                            <option value="FO">Faroe Islands</option>
                            <option value="FJ">Fiji</option>
                            <option value="FI">Finland</option>
                            <option value="FR">France</option>
                            <option value="GF">French Guiana</option>
                            <option value="PF">French Polynesia</option>
                            <option value="TF">French Southern Territories</option>
                            <option value="GA">Gabon</option>
                            <option value="GM">Gambia</option>
                            <option value="GE">Georgia</option>
                            <option value="DE">Germany</option>
                            <option value="GH">Ghana</option>
                            <option value="GI">Gibraltar</option>
                            <option value="GR">Greece</option>
                            <option value="GL">Greenland</option>
                            <option value="GD">Grenada</option>
                            <option value="GP">Guadeloupe</option>
                            <option value="GU">Guam</option>
                            <option value="GT">Guatemala</option>
                            <option value="GG">Guernsey</option>
                            <option value="GN">Guinea</option>
                            <option value="GW">Guinea-bissau</option>
                            <option value="GY">Guyana</option>
                            <option value="HT">Haiti</option>
                            <option value="HM">Heard Island and Mcdonald Islands</option>
                            <option value="VA">Holy See (Vatican City State)</option>
                            <option value="HN">Honduras</option>
                            <option value="HK">Hong Kong</option>
                            <option value="HU">Hungary</option>
                            <option value="IS">Iceland</option>
                            <option value="IN">India</option>
                            <option value="ID">Indonesia</option>
                            <option value="IR">Iran, Islamic Republic of</option>
                            <option value="IQ">Iraq</option>
                            <option value="IE">Ireland</option>
                            <option value="IM">Isle of Man</option>
                            <option value="IL">Israel</option>
                            <option value="IT">Italy</option>
                            <option value="JM">Jamaica</option>
                            <option value="JP">Japan</option>
                            <option value="JE">Jersey</option>
                            <option value="JO">Jordan</option>
                            <option value="KZ">Kazakhstan</option>
                            <option value="KE">Kenya</option>
                            <option value="KI">Kiribati</option>
                            <option value="KP">Korea, Democratic People&#039;s Republic of</option>
                            <option value="KR">Korea, Republic of</option>
                            <option value="KW">Kuwait</option>
                            <option value="KG">Kyrgyzstan</option>
                            <option value="LA">Lao People&#039;s Democratic Republic</option>
                            <option value="LV">Latvia</option>
                            <option value="LB">Lebanon</option>
                            <option value="LS">Lesotho</option>
                            <option value="LR">Liberia</option>
                            <option value="LY">Libyan Arab Jamahiriya</option>
                            <option value="LI">Liechtenstein</option>
                            <option value="LT">Lithuania</option>
                            <option value="LU">Luxembourg</option>
                            <option value="MO">Macao</option>
                            <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
                            <option value="MG">Madagascar</option>
                            <option value="MW">Malawi</option>
                            <option value="MY">Malaysia</option>
                            <option value="MV">Maldives</option>
                            <option value="ML">Mali</option>
                            <option value="MT">Malta</option>
                            <option value="MH">Marshall Islands</option>
                            <option value="MQ">Martinique</option>
                            <option value="MR">Mauritania</option>
                            <option value="MU">Mauritius</option>
                            <option value="YT">Mayotte</option>
                            <option value="MX">Mexico</option>
                            <option value="FM">Micronesia, Federated States of</option>
                            <option value="MD">Moldova, Republic of</option>
                            <option value="MC">Monaco</option>
                            <option value="MN">Mongolia</option>
                            <option value="ME">Montenegro</option>
                            <option value="MS">Montserrat</option>
                            <option value="MA">Morocco</option>
                            <option value="MZ">Mozambique</option>
                            <option value="MM">Myanmar</option>
                            <option value="NA">Namibia</option>
                            <option value="NR">Nauru</option>
                            <option value="NP">Nepal</option>
                            <option value="NL">Netherlands</option>
                            <option value="AN">Netherlands Antilles</option>
                            <option value="NC">New Caledonia</option>
                            <option value="NZ">New Zealand</option>
                            <option value="NI">Nicaragua</option>
                            <option value="NE">Niger</option>
                            <option value="NG">Nigeria</option>
                            <option value="NU">Niue</option>
                            <option value="NF">Norfolk Island</option>
                            <option value="MP">Northern Mariana Islands</option>
                            <option value="NO">Norway</option>
                            <option value="OM">Oman</option>
                            <option value="PK">Pakistan</option>
                            <option value="PW">Palau</option>
                            <option value="PS">Palestinian Territory, Occupied</option>
                            <option value="PA">Panama</option>
                            <option value="PG">Papua New Guinea</option>
                            <option value="PY">Paraguay</option>
                            <option value="PE">Peru</option>
                            <option value="PH">Philippines</option>
                            <option value="PN">Pitcairn</option>
                            <option value="PL">Poland</option>
                            <option value="PT">Portugal</option>
                            <option value="PR">Puerto Rico</option>
                            <option value="QA">Qatar</option>
                            <option value="RE">Reunion</option>
                            <option value="RO">Romania</option>
                            <option value="RU">Russian Federation</option>
                            <option value="RW">Rwanda</option>
                            <option value="SH">Saint Helena</option>
                            <option value="KN">Saint Kitts and Nevis</option>
                            <option value="LC">Saint Lucia</option>
                            <option value="PM">Saint Pierre and Miquelon</option>
                            <option value="VC">Saint Vincent and The Grenadines</option>
                            <option value="WS">Samoa</option>
                            <option value="SM">San Marino</option>
                            <option value="ST">Sao Tome and Principe</option>
                            <option value="SA">Saudi Arabia</option>
                            <option value="SN">Senegal</option>
                            <option value="RS">Serbia</option>
                            <option value="SC">Seychelles</option>
                            <option value="SL">Sierra Leone</option>
                            <option value="SG">Singapore</option>
                            <option value="SK">Slovakia</option>
                            <option value="SI">Slovenia</option>
                            <option value="SB">Solomon Islands</option>
                            <option value="SO">Somalia</option>
                            <option value="ZA">South Africa</option>
                            <option value="GS">South Georgia and The South Sandwich Islands</option>
                            <option value="ES">Spain</option>
                            <option value="LK">Sri Lanka</option>
                            <option value="SD">Sudan</option>
                            <option value="SR">Suriname</option>
                            <option value="SJ">Svalbard and Jan Mayen</option>
                            <option value="SZ">Swaziland</option>
                            <option value="SE">Sweden</option>
                            <option value="CH">Switzerland</option>
                            <option value="SY">Syrian Arab Republic</option>
                            <option value="TW">Taiwan, Province of China</option>
                            <option value="TJ">Tajikistan</option>
                            <option value="TZ">Tanzania, United Republic of</option>
                            <option value="TH">Thailand</option>
                            <option value="TL">Timor-leste</option>
                            <option value="TG">Togo</option>
                            <option value="TK">Tokelau</option>
                            <option value="TO">Tonga</option>
                            <option value="TT">Trinidad and Tobago</option>
                            <option value="TN">Tunisia</option>
                            <option value="TR">Turkey</option>
                            <option value="TM">Turkmenistan</option>
                            <option value="TC">Turks and Caicos Islands</option>
                            <option value="TV">Tuvalu</option>
                            <option value="UG">Uganda</option>
                            <option value="UA">Ukraine</option>
                            <option value="AE">United Arab Emirates</option>
                            <option value="GB">United Kingdom</option>
                            <option value="US">United States</option>
                            <option value="UM">United States Minor Outlying Islands</option>
                            <option value="UY">Uruguay</option>
                            <option value="UZ">Uzbekistan</option>
                            <option value="VU">Vanuatu</option>
                            <option value="VE">Venezuela</option>
                            <option value="VN">Viet Nam</option>
                            <option value="VG">Virgin Islands, British</option>
                            <option value="VI">Virgin Islands, U.S.</option>
                            <option value="WF">Wallis and Futuna</option>
                            <option value="EH">Western Sahara</option>
                            <option value="YE">Yemen</option>
                            <option value="ZM">Zambia</option>
                            <option value="ZW">Zimbabwe</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="state">State<code style="font-weight: 900; font-size: 20px; margin-left: 4px">*</code></label>
                        <input name='state' type="text" class="form-control" id="state" placeholder="State" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">City<code style="font-weight: 900; font-size: 20px; margin-left: 4px">*</code></label>
                        <input name='city' type="text" class="form-control" id="city" placeholder="City" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="zip">Zip<code style="font-weight: 900; font-size: 20px; margin-left: 4px">*</code></label>
                        <input name='zip' type="text" class="form-control" id="zip" placeholder="Zip" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email<code style="font-weight: 900; font-size: 20px; margin-left: 4px">*</code></label>
                        <input name='email' type="email" class="form-control" id="email" placeholder="Email" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Phone<code style="font-weight: 900; font-size: 20px; margin-left: 4px">*</code></label>
                        <input name='phone_no' type="tel" pattern="^\+[\d]{1,2}[\d]{10}" class="form-control" id="phone" placeholder="Phone" required />
                        <div class="info-msg">
                            Note : Enter the phone number in the following format '+Country Code-Phone Number';
                            e.g."+911234567890"
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="amount">Amount<code style="font-weight: 900; font-size: 20px; margin-left: 4px">*</code></label>
                        <input name='amount' type="number" class="form-control" id="amount" placeholder="Amount" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="currency">Currency<code style="font-weight: 900; font-size: 20px; margin-left: 4px">*</code></label>
                        <select name='currency' class="form-control" id="currency" placeholder="Currency" required>
                            <option value="" selected disabled> -- Select Currency -- </option>
                            <option value="USD">USD</option>
                            <option value="HKD">HKD</option>
                            <option value="GBP">GBP</option>
                            <option value="JPY">JPY</option>
                            <option value="EUR">EUR</option>
                            <option value="AUD">AUD</option>
                            <option value="CAD">CAD</option>
                            <option value="SGD">SGD</option>
                            <option value="NZD">NZD</option>
                            <option value="TWD">TWD</option>
                            <option value="KRW">KRW</option>
                            <option value="DKK">DKK</option>
                            <option value="TRL">TRL</option>
                            <option value="MYR">MYR</option>
                            <option value="THB">THB</option>
                            <option value="INR">INR</option>
                            <option value="PHP">PHP</option>
                            <option value="CHF">CHF</option>
                            <option value="SEK">SEK</option>
                            <option value="ILS">ILS</option>
                            <option value="ZAR">ZAR</option>
                            <option value="RUB">RUB</option>
                            <option value="NOK">NOK</option>
                            <option value="AED">AED</option>
                        </select>
                    </div>
                </div>
                <hr>
                <button type="submit" name='SubmitData' class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-primary">Cancel</button>
            </form>
        </div>
        <footer class="footer">
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