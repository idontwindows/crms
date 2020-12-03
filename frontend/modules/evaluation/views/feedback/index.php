<?php
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

//echo $ip;
?>
   <section>
    <div class="row" style="display: flex; justify-content: center; align-items: center;">
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua" style="width: 300px; height: 200px;">
            <div class="inner">
              <h3><?= $counter[20]?></h3>

              <p>Accounting and Budgetting</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="create?business_unit_id=20" class="small-box-footer">Rate unit <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-md-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua" style="width: 300px; height: 200px;">
            <div class="inner">
              <h3><?= $counter[30]?></h3>

              <p>Cashiering</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="create?business_unit_id=30" class="small-box-footer">Rate Unit <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-md-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua" style="width: 300px; height: 200px;">
            <div class="inner">
              <h3><?= $counter[40]?></h3>

              <p>Purchasing</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="create?business_unit_id=40" class="small-box-footer">Rate Unit <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    </div>
    
    <div class="row" style="display: flex; justify-content: center; align-items: center;">  
          
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua" style="width: 300px; height: 200px">
            <div class="inner">
              <h3><?= $counter[50]?></h3>

              <p>Human Resources</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="create?business_unit_id=50" class="small-box-footer">Rate Unit <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua" style="width: 300px; height: 200px">
            <div class="inner">
              <h3><?= $counter[60]?></h3>

              <p>Maintenance</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="create?business_unit_id=60" class="small-box-footer">Rate Unit <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua" style="width: 300px; height: 200px">
            <div class="inner">
              <h3><?= $counter[70]?></h3>

              <p>Science and Technology Information Services</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="create?business_unit_id=70" class="small-box-footer">Rate Unit <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    </div>
    
    <div class="row" style="display: flex; justify-content: center; align-items: center;"> 
          
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua" style="width: 300px; height: 200px">
            <div class="inner">
              <h3><?= $counter[80]?></h3>

              <p>Science and Technology Scholarship</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="create?business_unit_id=80" class="small-box-footer">Rate Unit <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua" style="width: 300px; height: 200px">
            <div class="inner">
              <h3><?= $counter[90]?></h3>

              <p>Innovation System Support</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="create?business_unit_id=90" class="small-box-footer">Rate Unit <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua" style="width: 300px; height: 200px">
            <div class="inner">
              <h3><?= $counter[100]?></h3>

              <p>Science and Technology Intervention</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="create?business_unit_id=100" class="small-box-footer">Rate Unit <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    </div>
</section>

<style>
  .small-box{
    border-radius: 25px;
  } 
</style>