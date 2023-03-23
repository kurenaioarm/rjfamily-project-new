<script type="text/javascript">
function toggleDiv(divid)
  {
 
    varon = divid + 'on';
    varoff = divid + 'off';
 
    if(document.getElementById(varon).style.display == 'block')
    {
    document.getElementById(varon).style.display = 'none';
    document.getElementById(varoff).style.display = 'block';
    }
   
    else
    {  
    document.getElementById(varoff).style.display = 'none';
    document.getElementById(varon).style.display = 'block'
    }
} 
</script>

    <!-- Banner Starts Here -->
    <!-- Multiple Seacrh box-->
    <div class="banner">
      <div class="container">
        <button type="button" class="btn btn-warning" onmousedown="toggleDiv('mydiv');">เปลี่ยนการค้นหา</button>
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <div class="header-text caption">
              

<div id="mydivon" style="display:block">
	<h2>ค้นประวัติโดย HN-เลขบัตรประชาชน</h2>
              <div id="search-section">
                <form id="suggestion_form"  method="post" action="#">
                <div class="searchText">        
                  <input type="text" name="finder" class="searchText" placeholder="ระบุ HN หรือ เลขบัตรประชาชน" value="<?php echo $_POST['finder'];?>" autocomplete="off">
                </div>
                    <input type="submit" name="results" class="main-button" value="ค้นหา">
                 </form>
               <div class="advSearch_chkbox">
               </div>
              </div>
   </div>  


<div id="mydivoff" style="display:none">
	<h2>ค้นประวัติตามที่อยู่</h2>
              <div id="search-section">
                <form id="suggestion_form"  method="post" action="#">
                <div class="searchText">


<div class="card">

                  <form>
                  <div class="form-row">
                  <div class="form-group col-md-4">
                  <label for="province">จังหวัด</label>
                      <select name="province_id" id="province" class="form-control">
                          <option value="">เลือกจังหวัด</option>
                          <option value="<?php echo $result['id'];?>"><?php echo $result['name_th'];?></option>
                      </select>
                  </div>

                  <div class="form-group col-md-4">
                    <label for="amphure">อำเภอ</label>
                      <select name="amphure_id" id="amphure" class="form-control">
                          <option value="">เลือกอำเภอ</option>
                      </select>
                  </div>

                  <div class="form-group col-md-4">
                      <label for="district">ตำบล</label>
                        <select name="district_id" id="district" class="form-control">
                           <option value="">เลือกตำบล</option>
                        </select>

                  </div>                
                  </form>
                  </div>
                 </form>
                  </div>

                   <div class="form-group col-md-12">
                    <input type="submit" name="results" class="main-button" value="Search Now">
                  </div>
                  
               </div>
               <div class="advSearch_chkbox">
               </div>

              </div>

</div>
 
 <br><br>


            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    <?php if($_POST['finder']!=''){?>
      <?php include 'template/services.php';?>
    <?php }?>
