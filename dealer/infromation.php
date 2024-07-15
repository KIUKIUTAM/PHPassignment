<?php
echo '
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
    <link rel="shortcut icon" href="../asserts/img/catHead.jpg" type="image/x-icon" />
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

    <div class="productDetail-container">
      <div class="container" style="margin-bottom: 30vh;">
        <div class="d-flex justify-content-between">
          <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active" id="v-pills-information-tab" data-bs-toggle="pill"
              data-bs-target="#v-pills-information" type="button" role="tab" aria-controls="v-pills-information"
              aria-selected="true">Information</button>
            <button class="nav-link" id="v-pills-update-tab" data-bs-toggle="pill" data-bs-target="#v-pills-update"
              type="button" role="tab" aria-controls="v-pills-update" aria-selected="false">Information Update</button>
            <button class="nav-link" id="v-pills-Order-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Order"
              type="button" role="tab" aria-controls="v-pills-Order" aria-selected="false">Order Record</button>

          </div>
          <div class="flex-grow-1 tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-information" role="tabpanel"
              aria-labelledby="v-pills-information-tab">
              <div class="information-title">information</div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                      placeholder="Vincenttam@gmail.com" disabled />
                    <div id="emailHelp" class="form-text">
                      We\'ll never share your email with anyone else.
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="basic-url" class="form-label">Contact Number</label>
                    <div class="input-group">
                      <select class="form-select" id="inputGroupSelect01" disabled>
                        <option selected>+852</option>
                        <option value="852">+852</option>
                        <option value="886">+886</option>
                        <option value="86">+86</option>
                        <option value="853">+853</option>
                      </select>
                      <input type="number" class="form-control w-75 p-2" id="basic-url"
                        aria-describedby="basic-addon3 basic-addon4" placeholder="12345678" disabled />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="basic-url" class="form-label">Fax Number</label>
                    <div class="input-group">
                      <select class="form-select" id="inputGroupSelect01" disabled>
                        <option selected>+852</option>
                        <option value="852">+852</option>
                        <option value="886">+886</option>
                        <option value="86">+86</option>
                        <option value="853">+853</option>
                      </select>
                      <input type="number" class="form-control w-75 p-2" id="basic-url"
                        aria-describedby="basic-addon3 basic-addon4" placeholder="12345678" disabled />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="basic-url" class="form-label">Delivery Address</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="basic-url"
                        aria-describedby="basic-addon3 basic-addon4" placeholder="30 Shing Tai Road Chai Wan, Hong Kong"
                        disabled />
                    </div>
                  </div>
                </div>
                <div class="col d-none d-xxl-block">
                  <img src="" class="rounded mx-auto d-block" alt="...">
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="v-pills-update" role="tabpanel" aria-labelledby="v-pills-update-tab">
              <form>
                <div class="information-title">Information Update</div>
                <div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
                    <div id="emailHelp" class="form-text">
                      We\'ll never share your email with anyone else.
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" />
                  </div>
                  <div class="mb-3">
                    <label for="basic-url" class="form-label">Contact Number</label>
                    <div class="input-group">

                      <select class="form-select " id="inputGroupSelect01">
                        <option selected>+XXX</option>
                        <option value="852">+852</opt ion>
                        <option value="886">+886</option>
                        <option value="86">+86</option>
                        <option value="853">+853</option>
                      </select>
                      <input type="number" class="form-control w-75 p-2" id="basic-url"
                        aria-describedby="basic-addon3 basic-addon4" />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="basic-url" class="form-label">Fax Number</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="basic-url"
                        aria-describedby="basic-addon3 basic-addon4" />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="basic-url" class="form-label">Delivery Address</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="basic-url"
                        aria-describedby="basic-addon3 basic-addon4" />
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary" style="margin-bottom: 50px; margin-top: 30px">
                    Submit
                  </button>

                </div>

              </form>
            </div>
            <div class="tab-pane fade" id="v-pills-Order" role="tabpanel" aria-labelledby="v-pills-messages-tab">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Date & Time</th>
                    <th scope="col">Delivery Address</th>
                    <th scope="col">Delivery Date</th>
                    <th scope="col">Details</th>
                    <th scope="col">Cancel Order</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1123123</th>
                    <td>01/01/2024</td>
                    <td>Heng Fa Chuen Public Transport Interchange</td>
                    <td>02/01/2024</td>
                    <td><button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#Modal-Detail">Details</button></td>
                    <td><button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#Modal-Cancel">Cancel</button></td>
                  </tr>
                  <!-- Modal -->
                  
                  <tr>
                    <th scope="row">1123122</th>
                    <td>01/01/2024</td>
                    <td>Heng Fa Chuen Public Transport Interchange</td>
                    <td>02/01/2024</td>
                    <td><button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#Modal-Detail">Details</button></td>
                    <td><button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Cancel</button></td>
                  </tr>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Cancel Order</h1>

                        </div>
                        <div class="modal-body">
                          Do you confirm your request cancel this Order?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-danger">Request Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <tr>
                    <th scope="row">1123122</th>
                    <td>01/01/2024</td>
                    <td>Heng Fa Chuen Public Transport Interchange</td>
                    <td>02/01/2024</td>
                    <td><button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#Modal-Detail">Details</button></td>
                    <td><button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Cancel</button></td>
                  </tr>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Cancel Order</h1>

                        </div>
                        <div class="modal-body">
                          Do you confirm your request cancel this Order?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-danger">Request Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <tr>
                    <th scope="row">1123122</th>
                    <td>01/01/2024</td>
                    <td>Heng Fa Chuen Public Transport Interchange</td>
                    <td>02/01/2024</td>
                    <td><button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#Modal-Detail">Details</button></td>
                    <td><button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Cancel</button></td>
                  </tr>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Cancel Order</h1>

                        </div>
                        <div class="modal-body">
                          Do you confirm your request cancel this Order?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-danger">Request Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <tr>
                    <th scope="row">1123122</th>
                    <td>01/01/2024</td>
                    <td>Heng Fa Chuen Public Transport Interchange</td>
                    <td>02/01/2024</td>
                    <td><button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#Modal-Detail">Details</button></td>
                    <td><button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Cancel</button></td>
                  </tr>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Cancel Order</h1>

                        </div>
                        <div class="modal-body">
                          Do you confirm your request cancel this Order?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-danger">Request Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <tr>
                    <th scope="row">1123122</th>
                    <td>01/01/2024</td>
                    <td>Heng Fa Chuen Public Transport Interchange</td>
                    <td>02/01/2024</td>
                    <td><button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#Modal-Detail">Details</button></td>
                    <td><button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Cancel</button></td>
                  </tr>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Cancel Order</h1>

                        </div>
                        <div class="modal-body">
                          Do you confirm your request cancel this Order?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-danger">Request Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <tr>
                    <th scope="row">1123122</th>
                    <td>01/01/2024</td>
                    <td>Heng Fa Chuen Public Transport Interchange</td>
                    <td>02/01/2024</td>
                    <td><button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#Modal-Detail">Details</button></td>
                    <td><button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#Modal-Cancel">Cancel</button></td>
                  </tr>
                  <!-- Modal -->
                  <div class="modal fade" id="Modal-Cancel" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Cancel Order</h1>

                        </div>
                        <div class="modal-body">
                          Do you confirm your request cancel this Order?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-danger">Request Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </tbody>
              </table>
              <div class="modal fade" id="Modal-Detail" tabindex="-1" role=""
              aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Details</h1>
                  </div>
                  <div class="modal-body">
                    <br>
                    <form>
                      <div class="form-group row margin-bottom10">
                        <label for="inputOrderID" class="col-sm-3 col-form-label ">Order ID:</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="inputOrderID" placeholder="12312323123" disabled>
                        </div>
                      </div>
                      <div class="form-group row margin-bottom10">
                        <label for="inputOrderDate" class="col-sm-3 col-form-label" >Order Date & Time:</label>
                        <div class="col-sm-8">
                          <input type="datetime" class="form-control" id="inputOrderDate"  placeholder="22/05/2012 12:00" disabled>
                        </div>
                      </div>
                      <div class="form-group row margin-bottom10">
                        <label for="inputDeliveryAddress" class="col-sm-3 col-form-label">Delivery Address:</label>
                        <div class="col-sm-8">
                          <input type="datetime" class="form-control" id="inputDeliveryAddress" placeholder="30 Shing Tai Road Chai Wan, Hong Kong" disabled>
                        </div>
                      </div>
                      <div class="form-group row margin-bottom10">
                        <label for="inputDeliveryAddress" class="col-sm-3 col-form-label">Delivery Date:</label>
                        <div class="col-sm-8">
                          <input type="datetime" class="form-control" id="inputOrderDate"  placeholder="22/05/2012 16:00" disabled>
                        </div>
                      </div>
                      <h5 style="margin-top: 50px; margin-bottom: 20px;">Order item:</h5>

                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Spare Part number</th>
                            <th scope="col">Spare Part Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>3</td>
                            <td>$100</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>2</td>
                            <td>$200</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>1</td>
                            <td>$300</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>1</td>
                            <td>$300</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>1</td>
                            <td>$300</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>1</td>
                            <td>$300</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>1</td>
                            <td>$300</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>1</td>
                            <td>$300</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>1</td>
                            <td>$300</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>1</td>
                            <td>$300</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>1</td>
                            <td>$300</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>1</td>
                            <td>$300</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>1</td>
                            <td>$300</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>1</td>
                            <td>$300</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>1</td>
                            <td>$300</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>1</td>
                            <td>$300</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>1</td>
                            <td>$300</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>100003</td>
                            <td>carcar</td>
                            <td>1</td>
                            <td>$300</td>
                          </tr>


                          
                        </tbody>
                      </table>
                      <h5>Total Order Amount:$600</h5>
                      
                    </form>
                    
                   
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Print the Order</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="Modal-Cancel" tabindex="-1" aria-labelledby="ModalLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Cancel Order</h1>

                  </div>
                  <div class="modal-body">
                    Do you confirm your request cancel this Order?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Request Cancel</button>
                  </div>
                </div>
              </div>
            </div>

            </div>

          </div>
        </div>

      </div>
    </div>
    </div>
  </main>

  <!--
    - FOOTER
  -->

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
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-latest.js"></script>
  <script>
    $(function () {
      $("header").load("./header.php");
      $("footer").load("./footer.php");
    });
  </script>
</body>

</html>
';
?>