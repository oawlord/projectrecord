<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"> <h1>Export your files here.</h1></section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border"><h3 class="box-title">Export project estimation report</h3></div>
                    <!-- form start -->
                    <form role="form" action="<?php echo base_url("dashboard/export"); ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="form-group">
                                <?php echo form_error('project_values');?>
                                <label for="project_group">Select Project Group:</label>
                                <?php if (!empty($project_list) && isset($project_list)) : ?>
                                    <select class="form-control" name="project_values">
                                        <option value="">Select</option>
                                        <?php foreach($project_list as $project): ?>
                                        <option value="<?php echo $project->project_id; ?>|<?php echo $project->project_name; ?>"><?php echo $project->project_name;  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php endif;  ?>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</div>
