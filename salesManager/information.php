<?php
require_once('../db/connect.php');
session_start();
if(!isset($_SESSION['dealer'])){
    header("Location: ../login.php");
    exit();
}
?>

<?php
$dealer_name = "";
$dealer_email = "";
$contact_areaCode = "";
$dealer_contact = "";
$fax_areaCode = "";
$dealer_fax = "";
$dealer_address = "";

if (isset($_SESSION['dealer'])) {
    $dealer = $_SESSION['dealer'];

    $stmt = $conn->prepare("SELECT dealerID,dealerName,dealerEmail, contactNumber, faxNumber, deliveryAddress FROM dealer WHERE dealerEmail = ?");
    $stmt->bind_param("s", $dealer);
    $stmt->execute();
    $result = $stmt->get_result();
    $dealerID ="";
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dealer_email = $row['dealerEmail'];
        $dealerID = $row['dealerID'];
        if($row['dealerName'] ==null){$dealer_name = "Not Set";}
          else{$dealer_name = $row['dealerName'];}

        if($row['contactNumber'] == null){$dealer_contact = "Not Set";}
          else{
            $partForContact = explode('-', $row['contactNumber']);
            if (count($partForContact) === 2) {
                $contact_areaCode = $partForContact[0];
                $dealer_contact = $partForContact[1];
            }}

        if($row['faxNumber'] == null){$dealer_fax = "Not Set";}
          else{$partForFax = explode('-', $row['faxNumber']);
            if (count($partForFax) === 2) {
                $fax_areaCode = $partForFax[0];
                $dealer_fax = $partForFax[1];
            }}
        
        if($row['deliveryAddress'] == null){$dealer_address = "Not Set";}
        else{$dealer_address = $row['deliveryAddress'];}
    }
    $stmt->close();
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SLMS - eCommerce Website</title>

    <!--
    - favicon
  -->
    <link rel="shortcut icon" href="../assets/img/catHead.jpg" type="image/x-icon" />
    <!--
    - custom css link
  -->


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="./assets/css/style-prefix.css" />
    <link rel="stylesheet" href="./assets/css/style-information.css" />

    <!--
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
</head>

<body>
    <div class="overlay" data-overlay></div>

    <!--
    - HEADER
  -->

    <header>
    </header>

    <!--
    - MAIN
  -->

    <main>
        <!--
      - PRODUCT
    -->
        <!-- informations-->
        <div class="productDetail-container">
            <div class="container" style=" margin-bottom: 30vh; width: 2000px;">
                <div class="d-lg-flex justify-content-between">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-information-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-information" type="button" role="tab"
                            aria-controls="v-pills-information" aria-selected="true">Information</button>
                        <button class="nav-link" id="v-pills-update-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-update" type="button" role="tab" aria-controls="v-pills-update"
                            aria-selected="false">Information Update</button>

                    </div>
                    <div class="flex-grow-1 tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-information" role="tabpanel"
                            aria-labelledby="v-pills-information-tab">
                            <div class="information-title">information</div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" placeholder="<?php echo $dealer_name ?>"
                                            disabled />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="<?php echo $dealer_email ?>"
                                            disabled />
                                        <div id="emailHelp" class="form-text">
                                            We'll never share your email with anyone else.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Contact Number</label>
                                        <div class="input-group">
                                            <select class="form-select" id="inputGroupSelect01" disabled>
                                                <option selected>+<?php echo $contact_areaCode?></option>
                                            </select>
                                            <input type="number" class="form-control w-75 p-2" id="basic-url"
                                                aria-describedby="basic-addon3 basic-addon4"
                                                placeholder="<?php echo $dealer_contact ?>" disabled />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="basic-url" class="form-label">Fax Number</label>
                                        <div class="input-group">
                                            <select class="form-select" id="inputGroupSelect01" disabled>
                                                <option selected>+<?php echo $fax_areaCode ?></option>
                                            </select>
                                            <input type="number" class="form-control w-75 p-2" id="basic-url"
                                                aria-describedby="basic-addon3 basic-addon4"
                                                placeholder="<?php echo $dealer_fax ?>" disabled />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="basic-url" class="form-label">Delivery Address</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="basic-url"
                                                aria-describedby="basic-addon3 basic-addon4"
                                                placeholder="<?php echo $dealer_address ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- information update-->

                        <div class="tab-pane fade" id="v-pills-update" role="tabpanel"
                            aria-labelledby="v-pills-update-tab">
                            <form action="./assets/subphp/UpdateInformation.php" method="POST">
                                <div class="information-title">Information Update</div>
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="nameForUpdate"
                                            pattern="^[A-Za-z\s]{1,}$" title="Only letters and space allowed"
                                            id="nameForUpdate" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="passwordForUpdate"
                                            pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$"
                                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                            name="passwordForUpdate" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="basic-url" class="form-label">Contact Number</label>
                                        <div class="input-group">

                                            <select class="form-select" id="areaCodeForUpdate" name="areaCodeForUpdate">
                                                <option value="852" selected>+852</option>
                                                <option value="886">+886</option>
                                                <option value="86">+86</option>
                                                <option value="853">+853</option>
                                            </select>
                                            <input type="text" class="form-control w-75 p-2" id="contactNumberForUpdate"
                                                name="contactNumberForUpdate" pattern="^[0-9]{8,}$"
                                                title="Please enter a valid fax number with at least 8 digits"
                                                aria-describedby="basic-addon3 basic-addon4" />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="basic-url" class="form-label">Fax Number</label>
                                        <div class="input-group">
                                            <select class="form-select" id="faxAreaCodeForUpdate"
                                                name="faxAreaCodeForUpdate">
                                                <option value="852" selected>+852</option>
                                                <option value="886">+886</option>
                                                <option value="86">+86</option>
                                                <option value="853">+853</option>
                                            </select>
                                            <input type="text" class="form-control w-75 p-2" id="faxNumberForUpdate"
                                                name="faxNumberForUpdate" pattern="^[0-9]{8,}$"
                                                title="Please enter a valid fax number with at least 8 digits"
                                                aria-describedby="basic-addon3 basic-addon4">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="basic-url" class="form-label">Delivery Address</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="deliveryAddressForUpdate"
                                                name="deliveryAddressForUpdate"
                                                aria-describedby="basic-addon3 basic-addon4" />
                                        </div>
                                    </div>

                                    <button id="submit-button" type="submit" name="submit">
                                        <span class="circle1"></span>
                                        <span class="circle2"></span>
                                        <span class="circle3"></span>
                                        <span class="circle4"></span>
                                        <span class="circle5"></span>
                                        <span class="text">Submit</span>
                                    </button>

                                </div>

                            </form>
                        </div>


                    </div>
                </div>

            </div>
        </div>
        </div>
    </main>


    <footer>
    </footer>

    <!--
    - custom js link
  -->
    <script src="./assets/js/script.js"></script>

    <!--
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script>
    $(function() {
        $("header").load("./assets/subphp/header.php");
        $("footer").load("./assets/subphp/footer.php");
    });
    </script>
</body>

</html>