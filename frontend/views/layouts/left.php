<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
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
                            ['label' => 'CSF', 'icon' => 'clipboard', 'url' => ['/evaluation/feedback/index']],
                            ['label' => 'Reports and Statistics', 'icon' => 'area-chart', 'url' => ['/evaluation/default/dashboard']],
                            ['label' => 'Business Units', 'icon' => 'reorder', 'url' => ['/evaluation/businessunit/index']],
                            ['label' => 'Manage Survey Questions', 'icon' => 'cog', 'url' => ['/evaluation/evaluationattribute/index']],
                            ['label' => 'Agency Profile', 'icon' => 'cog', 'url' => ['/evaluation/agencyprofile/view?id=1']],
                        ],
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
                    
                    ['label' => 'Login', 'icon' => 'user', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ],
            ]
        ) ?>
    </section>
    <!-- /.sidebar -->
  </aside>