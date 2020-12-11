<?php
use common\models\User;
use common\models\Profile;

    if(!Yii::$app->user->isGuest){
        $CurrentUser = User::findOne(['user_id'=> Yii::$app->user->identity->user_id]);
        //$CurrentAgencyid = $CurrentUser->profile->agency_id;
        $UserName = $CurrentUser->profile->firstname . ' ' . $CurrentUser->profile->lastname;
    }else{
        $UserName = 'Guest';
    }
?>
<header class="main-header">
  <!-- Logo -->
  <a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">CRMS</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">CRMS</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="/images/user-icon.png" class="user-image" alt="User Image">
            <span class="hidden-xs"><?=$UserName?></span>
          </a>
          <?php if(!Yii::$app->user->isGuest){?>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="/images/user-icon.png" class="img-circle" alt="User Image">

              <p>
              <?=$UserName?>
              </p>
            </li>
            <!-- Menu Body -->
 
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-right">
                <a href="/site/logout" class="btn btn-default btn-flat" data-method="post">Sign out</a>
              </div>
            </li>
          </ul>
          <?php }?>
        </li>
      </ul>
    </div>
  </nav>
</header>