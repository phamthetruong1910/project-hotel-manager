<?php

?>
<script>
    var counter = 0;

    function addBookingField() {
        // increment the counter variable
        counter++;

        // create a new booking field from the template
        var newBookingField = $('#bookingTemplate').clone().removeAttr('id').removeClass('hide');

        // set the IDs of the date picker inputs to be unique
        newBookingField.find('#datepicker').attr('id', 'datepicker-' + counter);
        newBookingField.find('#datepicker1').attr('id', 'datepicker1-' + counter);

        // add the new booking field to the form
        $('#bookingForm').append(newBookingField);
    }
</script>

<div class="modal fade create-booking-form" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width: 800px; max-width: 100%">
        <div class="modal-content modal-info">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body modal-spa">
                <div class="login-grids">
                    <div class="login">
                        <div class="login-left" style="width: 0">
                        </div>
                        <div class="login-right" style="width: 100%;">
                            <form method="post" id="bookingForm" action="booking/submit.php">

                                <div id="step1">
                                    <div class="form-group" style="padding-bottom: 70px">
                                        <div class="col-xs-1" style="width: 150px;display: flex;justify-content: center;align-items: center;height: 40px;">
                                            <h3 style="text-align: center">Đặt phòng</h3>
                                        </div>
                                        <div class="col-xs-2" style="width: 150px">
                                            <input class="date form-control" id="datepicker" type="text"
                                                   style="margin-top: 0; color: black"
                                                   placeholder="yyyy-mm-dd"
                                                   onchange="checkDates()" value="<?php echo date('Y-m-d'); ?>"
                                                   name="fromDate" required>
                                        </div>
                                        <div class="col-xs-2" style="width: 150px; color: black">
                                            <input class="date form-control" id="datepicker1" type="text"
                                                   style="margin-top: 0;color: black"
                                                   placeholder="yyyy-mm-dd"
                                                   onchange="checkDates()"
                                                   value="<?php echo date('Y-m-d', strtotime('+1 day', strtotime(date('Y-m-d')))); ?>"
                                                   name="toDate" required>
                                        </div>
                                        <input type="number" id="numberDay" name="numberDay" value="1" hidden>
                                    </div>
                                    <div class="ban-bottom" style="display: grid">

                                        <?php
                                        $pid = intval($_GET['pkgid']);
                                        $sql = "SELECT * from roomType where hotelId=:pid";
                                        $queryRoomType = $dbh->prepare($sql);
                                        $queryRoomType->bindParam(':pid', $pid, PDO::PARAM_STR);
                                        $queryRoomType->execute();
                                        $roomTypes = $queryRoomType->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($queryRoomType->rowCount() > 0) {
                                            ?>

                                        <?php } ?>
                                        <input type="text" name="hotelId" value="<?php echo $pid ?>" hidden>
                                        <div>
                                            <div class="form-group" style="padding-bottom: 70px">
                                                <div class="col-md-2">
                                                    <label class="form-label" for="" style="font-size: 15px; display: flex; padding-top: 5px">Loại phòng:</label>
                                                </div>
                                                <div class="col-md-4" style="width: 270px;">
                                                    <select id="roomType" name="roomTypeIdPrice-0" class="form-control"
                                                            style="margin-top: 0" onchange="sumColumn()"
                                                            id="ajax"
                                                            list="json-datalist" required>
                                                        <?php
                                                        foreach ($roomTypes as $roomType) {
                                                            ?>
                                                            <option value="<?php echo $roomType->id . '-' . $roomType->price . '-' . $roomType->isUseDeposit . '-' . $roomType->depositPercent; ?>"><?php echo $roomType->name ?></option>
                                                        <?php } ?>
                                                    </select><br>
                                                    <datalist id="json-datalist"></datalist>
                                                </div>
                                                <div class="col-md-3" style="width: 170px;display: flex">
                                                    <input class="form-control" name="quantity-0" placeholder="số phòng"
                                                           value="1" min="1"
                                                           onchange="sumColumn()"
                                                           type="number">
                                                </div>

                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-default addButton"><i
                                                                class="fa fa-plus"></i></button>
                                                </div>

                                                <div class="col-md-2" style="width: 350px;">
                                                    <h3 id="totalRecord-0"></h3>&nbsp;
                                                </div>
                                            </div>

                                            <div class="form-group hide" id="bookingTemplate"
                                                 style="padding-bottom: 70px">
                                                <div class="col-md-2">
                                                    <label class="form-label" for="" style="font-size: 15px; display: flex; padding-top: 5px">Loại phòng:</label>
                                                </div>
                                                <div class="col-md-4" style="width: 270px;">
                                                    <select id="gender" name="roomTypeIdPrice" class="form-control"
                                                            style="margin-top: 0" onchange="sumColumn()"
                                                            id="ajax"
                                                            list="json-datalist" required>
                                                        <?php
                                                        foreach ($roomTypes as $roomType) {
                                                            ?>
                                                            <option value="<?php echo $roomType->id . '-' . $roomType->price . '-' . $roomType->isUseDeposit . '-' . $roomType->depositPercent; ?>"><?php echo $roomType->name ?></option>
                                                        <?php } ?>
                                                    </select><br>
                                                    <datalist id="json-datalist"></datalist>
                                                </div>
                                                <div class="col-md-2" style="width: 170px;display: flex">
                                                    <input class="form-control" name="quantity" placeholder="số phòng"
                                                           value="1" min="1"
                                                           onchange="sumColumn()"
                                                           type="number">
                                                </div>

                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-default removeButton"><i
                                                                class="fa fa-minus"></i></button>
                                                </div>
                                                <div class="col-md-2" style="width: 350px;">
                                                    <h3 id="totalRecord"></h3>&nbsp;
                                                </div>
                                            </div>
                                            <div class="form-group" style="display: flex; flex-wrap: nowrap;">
                                                <input type="number" id="TotalNumberRoom" name="totalNumberRoom" value="0" hidden>
                                                <h3 id="validateCheckRoomBooking"></h3>
                                            </div>
                                        </div>
                                        <div style="display: flex; align-items: center">
                                            <button onclick="showStep(2); return false;" id="next-step" class="btn-primary btn">Tiếp
                                                theo
                                            </button>&nbsp;
                                            <h3 style="color: red" id="totalNumberRoomTitle"></h3>
                                        </div>
                                    </div>
                                </div>

                                <div id="step2" style="display: none;">
                                    <div>
                                        <div>
                                            <input type="text" value="" placeholder="Số điện thoại" name="mobileContact" autocomplete="off" required style="color: black">
                                            <div id="mobileError" class="error" style="color: red;font-size: 10px;"></div> <!-- Thông báo lỗi số điện thoại -->
                                        </div>
                                        <div>
                                            <input type="text" value="" placeholder="Email" name="emailContact" id="email" required autocomplete="off" style="color: black">
                                            <div id="emailError" class="error" style="color: red;font-size: 10px;"></div> <!-- Thông báo lỗi email -->
                                        </div>
                                        <div style="padding-top: 20px">
                                            <textarea class="form-control" rows="5" cols="50" name="comment" id="packagedetails" placeholder="comment" style="color: black"></textarea>
                                        </div>
                                    </div>
                                    <div style="padding-top: 20px">
                                        <button onclick="showStep(1); return false;" class="btn-primary btn">Trở lại
                                        </button>

                                        <button onclick="showStep(3);" class="btn-primary btn" type="button">Tiếp theo
                                        </button>
                                    </div>
                                </div>

                                <div id="step3" style="display: none;">
                                    <div>
                                        <div>
                                            <select id="payment-method" name="paymentId" style="color: black" onchange="showPaymentMethod()">
                                                <?php
                                                $sqlPaymentMethod = "SELECT * from paymentMethod";
                                                $queryPaymentMethod = $dbh->prepare($sqlPaymentMethod);
                                                $queryPaymentMethod->execute();
                                                $paymentMethods = $queryPaymentMethod->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($queryPaymentMethod->rowCount() > 0) {
                                                    foreach ($paymentMethods as $paymentMethod) {
                                                        ?>
                                                        <option value="<?php echo $paymentMethod->id ?>"><?php echo $paymentMethod->name ?></option>

                                                    <?php }
                                                } ?>
                                            </select>
                                            <div class="payment" id="credit-card" style="padding-top: 10px; color: black" >
                                                <h3>Thanh toán bằng thẻ tín dụng / Ghi nợ</h3>
                                                <input type="text" id="card-number" name="cardNumber" required onkeypress="return isNumeric(event)" style="color: black"
                                                       placeholder="Số thẻ: 1234 5678 9012 3456">
                                                <input type="text" id="card-holder" name="cardHolder" required style="color: black"
                                                       placeholder="Tên chủ thẻ: Nguyễn Văn A">
                                                <input type="text" id="expiration-date" name="expirationDate" required style="color: black"
                                                       placeholder="Ngày hết hạn: MM/YY">
                                                <input type="text" id="cvv" name="cvv" required style="color: black"
                                                       placeholder="Mã bảo mật (CVV/CVC): 123">
                                            </div>
                                            <div class="payment" style="display: none;padding-top: 10px; color: black" id="e-wallet" >
                                                <h3>Thanh toán bằng điện tử</h3>
                                                <input type="text" id="e-wallet-id" name="eWalletId" style="color: black"
                                                       placeholder="ID đăng nhập: abc@xyz.com">
                                                <input type="text" id="e-wallet-password" name="eWalletPassword" style="color: black"
                                                       placeholder="Mật khẩu: ********">
                                            </div>
                                            <div class="payment" style="display: none; padding-top: 10px; color: black" id="atm">
                                                <h3>Thanh toán bằng thẻ ATM nội địa</h3>
                                                <input type="text" id="bank-name" name="bankName" style="color: black"
                                                       placeholder="Tên ngân hàng: Ngân hàng ABC">
                                                <input type="text" id="atm-number" name="atmNumber" onkeypress="return isNumeric(event)" style="color: black"
                                                       placeholder="Số thẻ ATM: 1234 5678 9012 3456">
                                                <input type="text" id="atm-pin" name="atmPin" style="color: black"
                                                       placeholder="Mã PIN: ****">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="display: inline-block;width: 100%">
                                        <div style="float: left; margin-top: 20px; padding: 10px 15px;">
                                            <button class="btn-primary btn" onclick="showStep(2); return false;">Trở
                                                lại
                                            </button>
                                        </div>
                                        <div style="float: right;">
                                            <input type="submit" name="submit" value="Đặt phòng">
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function checkDates() {
        // date picker
        var fromDate = new Date(document.getElementById("datepicker").value);
        var toDate = new Date(document.getElementById("datepicker1").value);
        var toDateNow = new Date()

        // Kiểm tra nếu ngày "fromDate" hoặc "toDate" nhỏ hơn ngày hiện tại
        if (fromDate <= toDateNow) {
            // Lấy ngày hiện tại
            var today = toDateNow.toISOString().slice(0, 10);
            // Đặt giá trị của "fromDate" và "toDate" thành ngày hiện tại
            document.getElementById("datepicker").value = today;
        }

        // Kiểm tra nếu ngày "fromDate" lớn hơn ngày "toDate"
        if (fromDate > toDate) {
            // Đặt giá trị của "fromDate" thành giá trị của "toDate"
            document.getElementById("datepicker1").value = document.getElementById("datepicker").value;
        }

        calculateDays()
    }

    function validateInput() {
        const mobileContact = document.getElementsByName("mobileContact")[0].value;
        const emailContact = document.getElementsByName("emailContact")[0].value;
        var comment = document.getElementById("packagedetails").value;

        document.getElementById("mobileError").innerHTML = "";
        document.getElementById("emailError").innerHTML = "";

        if (mobileContact.length !== 10) {
            document.getElementById("mobileError").innerHTML = "Số điện thoại không hợp lệ!";
            return false;
        }
        const isNumeric = /^\d+$/.test(mobileContact);
        if (!isNumeric) {
            document.getElementById("mobileError").innerHTML = "Số điện thoại không hợp lệ!";
            return false;
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailContact)) {
            document.getElementById("emailError").innerHTML = "Email không hợp lệ!";
            return false;
        }
        return true;
    }

    function showStep(stepNumber) {
        if (stepNumber === 3) {
            if (!validateInput()) {
                return;
            }
        }
        // Hide all steps
        var steps = document.querySelectorAll('[id^="step"]');
        for (var i = 0; i < steps.length; i++) {
            steps[i].style.display = "none";
        }

        // Show the specified step
        var step = document.getElementById("step" + stepNumber);
        step.style.display = "block";


        sumColumn();
    }


    //script add multi room
    var counter = 0;
    var dataList = document.getElementById('json-datalist');

    $('#bookingForm')
        // Add button click handler
        .on('click', '.addButton', function () {
            counter++;
            var $template = $('#bookingTemplate'),
                $clone = $template
                    .clone()
                    .removeClass('hide')
                    .removeAttr('id')
                    .attr('data-book-index', counter)
                    .insertBefore($template);

            // Update the name attributes
            $clone
                .find('[name="roomTypeIdPrice"]').attr('name', 'roomTypeIdPrice-' + counter).end()
                .find('[name="quantity"]').attr('name', 'quantity-' + counter).end()
                .find('[id="totalRecord"]').attr('id', 'totalRecord-' + counter).end()


            sumColumn()

        })

        // Remove button click handler
        .on('click', '.removeButton', function () {
            var $row = $(this).parents('.form-group'),
                index = $row.attr('data-book-index');

            // Remove element containing the fields
            $row.remove();

            sumColumn()
        });

    function isNumeric(event) {
        var keyCode = event.which ? event.which : event.keyCode;
        var keyValue = String.fromCharCode(keyCode);

        if (!/^\d+$/.test(keyValue)) {
            event.preventDefault();
            return false;
        }
    }

    var expirationDateInput = document.getElementById("expiration-date");

    expirationDateInput.addEventListener("input", function(event) {
        var input = event.target;
        var inputValue = input.value;

        // Remove non-digit characters
        var numericValue = inputValue.replace(/\D/g, "");

        // Format the numeric value as MM/yyyy
        var formattedValue = numericValue.replace(/(\d{2})(\d{0,4})/, "$1/$2");

        // Truncate year to four digits
        if (formattedValue.length > 7) {
            formattedValue = formattedValue.substr(0, 7);
        }

        // Update the input value with the formatted value
        input.value = formattedValue;
    });

    expirationDateInput.addEventListener("blur", function(event) {
        var input = event.target;
        var inputValue = input.value;

        // Validate the format as MM/yyyy
        var isValidFormat = /^\d{2}\/\d{4}$/.test(inputValue);

        // Set custom validity if format is not valid
        if (!isValidFormat) {
            input.setCustomValidity("Please enter the expiration date in the format MM/yyyy.");
        } else {
            input.setCustomValidity("");
        }
    });



    function showPaymentMethod() {
        var paymentMethod = document.getElementById("payment-method").value;
        var creditCardDiv = document.getElementById("credit-card");
        var eWalletDiv = document.getElementById("e-wallet");
        var atmDiv = document.getElementById("atm");

        // Reset "required" attribute for all input fields
        var inputFields = document.querySelectorAll(".payment input");
        inputFields.forEach(function(input) {
            input.removeAttribute("required");
        });

        if (paymentMethod === "1") {
            creditCardDiv.style.display = "block";
            eWalletDiv.style.display = "none";
            atmDiv.style.display = "none";

            // Set "required" attribute for credit card input fields
            var creditCardInputs = creditCardDiv.querySelectorAll("input");
            creditCardInputs.forEach(function(input) {
                input.setAttribute("required", "required");
            });
        } else if (paymentMethod === "2") {
            creditCardDiv.style.display = "none";
            eWalletDiv.style.display = "block";
            atmDiv.style.display = "none";

            // Set "required" attribute for e-wallet input fields
            var eWalletInputs = eWalletDiv.querySelectorAll("input");
            eWalletInputs.forEach(function(input) {
                input.setAttribute("required", "required");
            });
        } else if (paymentMethod === "3") {
            creditCardDiv.style.display = "none";
            eWalletDiv.style.display = "none";
            atmDiv.style.display = "block";

            // Set "required" attribute for ATM input fields
            var atmInputs = atmDiv.querySelectorAll("input");
            atmInputs.forEach(function(input) {
                input.setAttribute("required", "required");
            });
        }
    }


    function calculateDays() {
        var fromDate = new Date(document.getElementsByName("fromDate")[0].value);
        var toDate = new Date(document.getElementsByName("toDate")[0].value);

        var timeDiff = Math.abs(toDate.getTime() - fromDate.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

        document.getElementById("numberDay").value = diffDays === 0 ? 1 : diffDays;
        sumColumn()
    }

    function sumColumn() {
        var sum = 0

        var numberDay = document.getElementsByName("numberDay")[0].value;
        var selectedOptions = document.querySelectorAll('#roomType option:checked');

        var selectedData = [];

        selectedOptions.forEach(function(option) {
            var selectedValues = option.value.split("-");
            selectedData.push({
                id: selectedValues[0],
                price: selectedValues[1],
                isUseDeposit: selectedValues[2],
                depositPercent: selectedValues[3]
            });
        });

        var roomData = {};

        for (var i = 0; i <= 10; i++) {
            var roomType = document.getElementsByName("roomTypeIdPrice-" + i)[0]?.value;
            console.log(roomType);
            var roomTypeArr
            var roomTypeId
            var price
            var isUseDeposit = selectedData[0].isUseDeposit
            var depositPercent = isUseDeposit === '1' ? selectedData[0].depositPercent : 0;

            if (roomType !== undefined) {
                roomTypeArr = roomType.split("-");
                roomTypeId = roomTypeArr[0];
                price = parseInt(roomTypeArr[1]);
                isUseDeposit = roomTypeArr[2];
                depositPercent = isUseDeposit ? roomTypeArr[3] : 0
            } else {
                price = 0;
            }

            var quantity = document.getElementsByName("quantity-" + i)[0]?.value || 0;

            if (roomData[roomTypeId]) {
                roomData[roomTypeId].quantity += parseInt(quantity);
            } else {
                roomData[roomTypeId] = {
                    roomTypeId: parseInt(roomTypeId),
                    quantity: parseInt(quantity)
                };
            }

            if (quantity !== 0 && price !== 0 && numberDay !== 0) {
                var priceDeposit = 0;

                if (isUseDeposit === '1') {
                    priceDeposit = (price * depositPercent) / 100;
                    sum += (numberDay * priceDeposit) * quantity;
                } else {
                    sum += (numberDay * price) * quantity;
                }
            }

            var totalRecord = isUseDeposit === '1' ? (numberDay * ((price * depositPercent) / 100)) * quantity : (numberDay * price) * quantity;

            var totalRecordEl = document.getElementById('totalRecord-' + i);
            if (totalRecordEl !== null) {
                totalRecordEl.innerText = 'Giá cọc: ' + totalRecord.toLocaleString('vi', {
                    style: 'currency',
                    currency: 'VND'
                }) + ' phòng/đêm';
            }
        }
        callValidateRoom(roomData)

        document.getElementById('totalNumberRoomTitle').innerText = 'Tổng là: ' + sum.toLocaleString('vi', {
            style: 'currency',
            currency: 'VND'
        });

        document.getElementById('TotalNumberRoom').value = parseInt(sum);
    }

    sumColumn()

    function callValidateRoom(roomData) {
        var fromDate = (new Date(document.getElementsByName("fromDate")[0].value)).toISOString().slice(0,10).replace(/-/g,"-");
        var toDate = (new Date(document.getElementsByName("toDate")[0].value)).toISOString().slice(0,10).replace(/-/g,"-");
        var hotelId = document.getElementsByName("hotelId")[0].value;

        $.ajax({
            url: 'booking/check-validate-date.php',
            method: 'POST',
            data: {fromDate: fromDate, toDate: toDate, roomData: roomData, hotelId: hotelId},
            success: function (response) {
                // var element = document.getElementById('validateCheckRoomBooking');
                const nextStep = document.querySelector('#next-step');

                if (response.key) {
                    document.getElementById('validateCheckRoomBooking').innerText = response.message;
                    document.getElementById('validateCheckRoomBooking').style.color = '#4CB320';

                    nextStep.disabled = false;
                } else {
                    document.getElementById('validateCheckRoomBooking').innerText = response.message;
                    document.getElementById('validateCheckRoomBooking').style.color = 'red';
                    nextStep.disabled = true;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                alert('lỗi trong quá trình cập nhật dữ liệu');
            }
        });
    }

</script>