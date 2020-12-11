<?php
use common\models\User;
use common\models\Profile;
    if(!Yii::$app->user->isGuest){
        $CurrentUser = User::findOne(['user_id'=> Yii::$app->user->identity->user_id]);
        $CurrentAgencyid = $CurrentUser->profile->agency_id;
        $UserName = $CurrentUser->profile->firstname . ' ' . $CurrentUser->profile->lastname;
    }else{
        $UserName = 'Guest';
    }

?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/images/user-icon.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$UserName?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    
                    ['label' => '', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Evaluation',
                        'icon' => 'archive',
                        'url' => '#',
                        'items' => [
                            ['label' => 'CSF', 'icon' => 'clipboard', 'url' => ['/evaluation/feedback/index','agency_id' => !Yii::$app->user->isGuest ? $CurrentAgencyid : null],'visible'=> Yii::$app->user->can('access-csf')],
                            ['label' => 'Reports and Statistics', 'icon' => 'area-chart', 'url' => ['/evaluation/default/dashboard'],'visible'=> Yii::$app->user->can('access-reports')],
                            ['label' => 'Business Units', 'icon' => 'reorder', 'url' => ['/evaluation/businessunit/index'],'visible'=> Yii::$app->user->can('access-business-unit')],
                            ['label' => 'Manage Survey Questions', 'icon' => 'cog', 'url' => ['/evaluation/evaluationattribute/index'],'visible'=> Yii::$app->user->can('access-manage-survey-question')],
                            ['label' => 'Agency Profile', 'icon' => 'cog', 'url' => ['/evaluation/agencyprofile/view?id=1'],'visible'=> Yii::$app->user->can('access-agency-profile')],
                        ],
                        'visible'=> Yii::$app->user->can('access-evaluation')
                    ],
                    [
                        'label' => 'RBAC',
                        'icon' => 'fa fa-user-circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Users', 'icon' => 'fa fa-user-o', 'url' => ['/admin/user'],'visible'=> Yii::$app->user->can('access-user')],
                            //['label' => 'Groups', 'icon' => 'dashboard', 'url' => ['/admin/group'],'visible'=> Yii::$app->user->can('access-user')],
                            ['label' => 'Assignment', 'icon' => 'dashboard', 'url' => ['/admin/assignment'],'visible'=> Yii::$app->user->can('access-assignment')],
                            ['label' => 'Route', 'icon' => 'line-chart', 'url' => ['/admin/route'],'visible'=> Yii::$app->user->can('access-route')],
                            ['label' => 'Roles', 'icon' => 'glide-g', 'url' => ['/admin/role'],'visible'=> Yii::$app->user->can('access-role')],
                            ['label' => 'Permissions', 'icon' => 'resistance', 'url' => ['/admin/permission'],'visible'=> Yii::$app->user->can('access-permission')],
                            ['label' => 'Menus', 'icon' => 'scribd', 'url' => ['/admin/menu'],'visible'=> Yii::$app->user->can('access-menu')],
                            //['label' => 'Rules', 'icon' => 'reorder', 'url' => ['/admin/rule'],'visible'=> Yii::$app->user->can('access-rule')],
                        ],
                        'visible'=> Yii::$app->user->can('access-rbac')
                    ],
                    /*
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],*/
                    ['label' => 'Login', 'icon' => 'user', 'url' => ['/site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Logout', 'icon' => 'user-times', 'url' => Yii::$app->urlManager->createUrl(['/site/logout']),
                    'visible' => !Yii::$app->user->isGuest, 'template' => '<a href="{url}" data-method="post">{icon}{label}</a>'],
                ] ,
            ]
        ) ?>
    </section>
    <!-- /.sidebar -->
  </aside>