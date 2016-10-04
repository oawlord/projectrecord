<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"> <h1>Project Estimation Report</h1></section>
    <section class="content">
        <div class="row" style="margin: 15px 0px; text-align: right">
          <div class="col-md-12">
            <a class="btn btn-primary" href="<?php echo site_url('dashboard/export/export_daily'); ?>">Export</a>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border"><h3 class="box-title"><?php echo $title?></h3></div>
                    <div>
                      <table class="table table-striped table-hover">
                        <tr>
                          <th>S.No</th>
                          <th>PROJECT NAME</th>
                          <th>PROJECT DATE</th>
                          <th>TOTAL ESTIMATED HOURS</th>
                        </tr>
                        <?php $count=1;foreach($records as $row){?>
                        <tr>
                          <td><?php echo $count++;?></td>
                          <td><?php echo $row->project_name?></td>
                          <td><?php echo $row->project_date?></td>
                          <td><?php echo $row->total_estimated_hours?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                          <td colspan="4" align = "center"><?php echo $links?></td>
                        </tr>
                      </table>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</div>
