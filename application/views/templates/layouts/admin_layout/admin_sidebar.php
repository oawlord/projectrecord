<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Upload Excel</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('dashboard/import'); ?>"><i class="fa fa-circle-o"></i> Import excel files</a></li>
                    <li><a href="<?php echo site_url('dashboard/export'); ?>"><i class="fa fa-circle-o"></i> Export excel files</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Report</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('dashboard/report/daily_report'); ?>"><i class="fa fa-circle-o"></i> Today</a></li>
                    <li><a href="<?php echo site_url('dashboard/report/weekly_report'); ?>"><i class="fa fa-circle-o"></i> Week</a></li>
                    <li><a href="<?php echo site_url('dashboard/report/monthly_report'); ?>"><i class="fa fa-circle-o"></i> Month</a></li>
                    <li><a href="<?php echo site_url('dashboard/report/yearly_report'); ?>"><i class="fa fa-circle-o"></i> Year</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
