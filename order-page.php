<?php include("layouts/header.php");
$stylist_id = $_GET['id'];
$specificavaliabeDate = "SELECT bdate, COUNT(*) c FROM orders where stylist_id = '$stylist_id' GROUP BY stylist_id, bdate HAVING c = 7";
$result3 = mysqli_query($conn, $specificavaliabeDate);
if (mysqli_num_rows($result3)==0) {
    //$data = '[{"bdate":"01-01-1999","c":"7"}]';
    $data = '[{"bdate":""}]';

}else{
    //$row = mysqli_fetch_assoc($resut3);
    while($row = mysqli_fetch_assoc($result3)){
        $myData[] = $row;
    }
    $data = json_encode($myData,JSON_UNESCAPED_SLASHES);

}
$avaliabeDate = "SELECT bdate,btime, COUNT(*) c FROM orders where stylist_id = '$stylist_id' GROUP BY  bdate,btime HAVING c >= 1";
$result2 = mysqli_query($conn, $avaliabeDate);
//$row2 = mysqli_fetch_assoc($result2);
while($row2 = mysqli_fetch_assoc($result2)){
    $myData2[] = $row2;
}
//echo json_encode($myData2,JSON_UNESCAPED_SLASHES);
$data2 = json_encode($myData2,JSON_UNESCAPED_SLASHES);

?>
<!-- Breadcrumb Area Start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h2>Our Services</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon_house_alt"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Services</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->
<?php if(isset($_SESSION['auth_user_id'])): ?>
    <section class="akame-service-area">
        <div class="row">
            <div class="col-md-8">
                <form action="order.php" method="POST" id="order_form_submit">
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['auth_user_id']; ?>">
                    <input type="hidden" name="stylist_id" id="stylist_id" value="<?php echo $stylist_id ?>">

                    <div class="form-group">
                        <label for="hair_style" class="col-md-4 col-form-label text-md-right">Hair Style:</label>
                        <select class="choose_plan" name="hairCut" id="hairCut">
                            <option value="0">Select Hair Style:</option>
                            <?php while($row = mysqli_fetch_assoc($hair_cut_sql)): ?>
                                <option value="<?php echo $row['hair_cut_price']; ?>"><?php echo $row['hair_cut_title']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="hair_style" class="col-md-4 col-form-label text-md-right">Hair Color Style:</label>
                        <select class="choose_plan" name="hairColor" id="hairColor">
                            <option value="0">Select Color:</option>
                            <?php while($row = mysqli_fetch_assoc($hair_color_sql)): ?>
                            <option value="<?php echo $row['hair_color_price']; ?>"><?php echo $row['hair_color_title']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label for="hair_style" class="col-md-4 col-form-label text-md-right">Hair Care:</label>
                        <div class="col-md-8">
                        <select class="choose_plan" name="hairCare" id="hairCare">
                            <option value="0">No</option>
                            <?php while($row = mysqli_fetch_assoc($hair_care_sql)): ?>
                            <option value="<?php echo $row['hair_care_price']; ?>">Yes</option>
                            <?php endwhile; ?>
                        </select>
                        <span>3000 Kyats</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="hair_style" class="col-md-4 col-form-label text-md-right">Date:</label>
                        <div class="col-md-8">
                            <i class="fas fa-calendar-alt form-fa-right"></i>
                            <input class="form-control choose_plan" id="date" name="date" data-date-format="mm-dd-yyyy" placeholder="MM/DD/YYY" type="text" autocomplete="off"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="hair_style" class="col-md-4 col-form-label text-md-right">Time:</label>
                        <div class="col-md-8">
                            <select class="choose_plan" name="time" id="time">
                                <option value="9:30AM" disabled="disabled">9:30 AM</option>
                                <option value="10:30AM" disabled="disabled">10:30 AM</option>
                                <option value="11:30AM" disabled="disabled">11:30 AM</option>
                                <option value="1:30PM" disabled="disabled">1:30 PM</option>
                                <option value="2:30PM" disabled="disabled">2:30 PM</option>
                                <option value="3:30PM" disabled="disabled">3:30 PM</option>
                                <option value="4:30PM" disabled="disabled">4:30 PM</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn akame-btn">Book Now</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">

                <img src="img/bg-img/30.jpg" alt="">

            </div>
        </div>

    </section>

    <div class="modal" id="orderFormModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Fail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Please Choose the at least one of the service.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal" id="orderSuccessModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Successfully Booking, thank you.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="successRedirect" data-dismiss="modal">Back</button>
            </div>
            </div>
        </div>
    </div>

<?php else: ?>
    <div class="container msg_body" style="	padding-top: 40px;
    text-align: center;
    padding-bottom: 40px;

    margin-top: 20px;
    margin-bottom: 20px;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="login-form.php" class="btn akame-btn">Login First</a>
            </div>
        </div>
    </div>

<?php endif; ?>


<?php include("layouts/footer.php"); ?>
<script>
    $(document).ready(function () {
        var jsondata = '<?php echo $data ?>';
        var outObjA = JSON.parse(jsondata);
        var dataArr = []
        for (var i = 0; i < outObjA.length; i++) {
        var data = outObjA[i]['bdate'];

        console.log(data);
        dataArr.push(data);
        }
        console.log(dataArr);

        var date_input=$('input[name="date"]'); //our date input has the name "date"
          var options={
            format: 'mm-dd-yyyy',
            todayHighlight: true,
            startDate: new Date(),
            datesDisabled: dataArr,
            autoclose: true,
          };
          date_input.datepicker(options);

          var jsondata2 = '<?php echo $data2 ?>';
            var outObjB = JSON.parse(jsondata2);
            var optionarray = [];
            $("#time option").each(function(index, value){
                optionarray.push(value.value);
            });

          $('#date').datepicker().on('changeDate', function (ev) {
               console.log('date is input now');
               var userDate = $('#date').val();
               console.log(userDate);
            // //$('#date-daily').change();

             $("#time option").attr('disabled', false);
             //var getTime = $("#time option").val();
             //console.log(getTime);
            $.each(outObjB, function(index,value){
                //console.log(value.btime);
                var times = $("#time option");
                //var userTime = $("#time").val();
                console.log(times);
                if(value.bdate == userDate ){
                    for(var i=0; i < times.length; i++) {
                        if (times[i].value == value.btime) {
                            times[i].setAttribute('disabled',true);
                        }
                    }

                 }

            });
        });

          $("form#order_form_submit").submit(function(e) {
            e.preventDefault();
            var user_id = $('#user_id').val();
            var stylist_id = $('#stylist_id').val();
            var hairCut = $('#hairCut').val();
            var hairColor = $('#hairColor').val();
            var hairCare = $('#hairCare').val();
            var date = $('#date').val();
            var time = $('#time').val();

            //console.log(stylist_id);

            $.ajax({
                url: "order.php",
                type: "POST",
                data: {
                    user_id: user_id,
                    stylist_id: stylist_id,
                    hairCut: hairCut,
                    hairColor : hairColor,
                    hairCare : hairCare,
                    date: date,
                    time: time,
                    },
                success: function(data,status) {
                    console.log(data);
                    if($.trim(data) == 'Choose the one service'){
                        console.log('NO');
                        $('#orderFormModal').modal();
                    }else{
                        console.log('Yes');
                        $('#orderSuccessModal').modal();

                    }
                }
            });

            $('#successRedirect').click(function(){
                window.location.href = 'index.php';
            });


          });




    });
</script>