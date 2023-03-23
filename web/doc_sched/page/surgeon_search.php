<div class="content_j">
  <!-- <h5 class="title"><span class="badge badge-pill badge-dark"><?= $_SESSION['STAFF_NM']; ?></span></h5> -->
  <h5 class="title"><span class="badge badge-pill badge-dark">แสดงตารางนัดตาม Surgeon</span></h5>
  <div id="container" class="calendar-container">
    <div id="loading" style="text-align: center;">
    </div>
    <div id="surgeon_form">
      <form method="get" id="frmSurSearch" action="index.php">
        <input type="hidden" name="p" value="surgeon_calendar" />
        <div class="input-group col-lg-8 offset-lg-2 col-md-12">
          <div class="input-group-prepend">
            <label class="input-group-text" for="surgeons">Surgeons</label>
          </div>
          <select id="surgeons" class="form-control" name="surgeons" required>
            <option value="">กรุณาระบุชื่อแพทย์</option>
          </select>
        </div>
        <input type="hidden" name="showlast" id="showlast" value="" />

        <div class="d-flex justify-content-center mt-2">
          <button type="button" class="btn btn-outline-success btnShowLast">แสดงผลวันสุดท้ายที่มีนัด</button>
          <button type="submit" class="btn btn-outline-primary ml-2">แสดงผลเดือนปัจจุบัน</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="./dist/jquery.min.js"></script>
<script>
  var $calendar;
  $(document).ready(function() {

    $(".btnShowLast").click(function() {
      // alert('last');
      $("#showlast").val("true");
      // alert($("#showlast").val());
      if (!$('#frmSurSearch')[0].checkValidity()) {
        $('#frmSurSearch')[0].reportValidity()
      } else {
        $("#frmSurSearch").submit();
      }

    });
    $.fn.dctList = function() {
      let datatoken = {
        "model": "dct"
      };
      $.ajax({
        url: "call/orroom.php",
        type: 'GET',
        data: datatoken,
        dataType: 'json',
        cache: false,
        beforeSend: function() {
          $('#loading').html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>  Loading...");
        },
        success: function(result) {
          // console.log(result);
          if (result.json_result) {
            // console.log(result.json_data);
          }
          $.each(result.json_data, function(key, dctRow) {
            var o = new Option(dctRow.DSPNAME + " " + dctRow.DCT, dctRow.DCT);
            // $("#surgeon").append(o);
            $("#surgeons").append(o);
          });
          // $('#surgeon').select2({
          //   theme: 'bootstrap4',
          // });
          $('#surgeons').select2({
            theme: 'bootstrap4',
          });
          $('#loading').html("");
        }
      });
    };
    $(this).dctList();
    $('#surgeons').change(function() {
      console.log($(this).val());
    });
  });
  $(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
  });
</script>