<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/avatar5.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php echo Yii::$app->user->identity->username;?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'MENU', 'options' => ['class' => 'header']],
                    /*['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],*/
                    [
                        'label' => 'Master',
                        'icon' => 'book',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Supplier', 'icon' => 'institution', 'url' => ['supplier/index'],],
                            ['label' => 'Barang', 'icon' => 'database', 'url' => ['filebarang/index'],],
                            /*[
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
                            ],*/
                        ],
                    ],
                    [
                        'label' => 'Pembelian',
                        'icon' => 'dashboard',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Transaksi Pembelian', 'icon' => 'institution', 'url' => ['pembelian/index']],
                            ['label' => 'Kelola Pembelian', 'icon' => 'tasks', 'url' => ['pembelian/admin'],],
                            /*[
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
                            ],*/
                        ],
                    ],
                    [
                        'label' => 'Mutasi',
                        'icon' => 'briefcase',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Transaksi Mutasi', 'icon' => 'location-arrow', 'url' => ['pembelian/mutasi']],
                            ['label' => 'Kelola Mutasi', 'icon' => 'tasks', 'url' => ['mutasi/index'],],
                            /*[
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
                            ],*/
                        ],
                    ],
                    
                    [
                        'label' => 'Laporan',
                        'icon' => 'bar-chart',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Laporan Mutasi', 'icon' => 'tasks', 'url' => ['laporan/mutasi']],
                            ['label' => 'Laporan Pembelian', 'icon' => 'tasks', 'url' => ['laporan/index'],],
                            ['label' => 'Laporan Rekap', 'icon' => 'tasks', 'url' => ['laporan/laporanrekap'],],
                            /*[
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
                            ],*/
                        ],
                    ],
                    
                ['label' => 'Logout', 'url' => ['site/logout'], 'visible' => !Yii::$app->user->isGuest],

                ],
            ]
        ) ?>

    </section>

</aside>
