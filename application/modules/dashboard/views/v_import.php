<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"> <h1>Import your files here.</h1></section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border"><h3 class="box-title">Import files</h3></div>
                    <!-- form start -->
                    <form role="form" action="<?php echo base_url("dashboard/import"); ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php echo form_error('project_name'); ?>
                            <div class="form-group">                               
                                <label for="projectName">Project Name</label>
                                <input type="text" class="form-control" id="projectName" name="project_name" placeholder="Project Name">
                            </div>  
                            <div class="form-group">
                                <?php echo form_error('project_group'); ?>
                                <label for="project_group">Select Project Group:</label>
                                <select class="form-control" name="project_group">
                                    <option value="">Select</option>
                                    <option value="1">Codeigniter</option>
                                    <option value="2">Wordpress</option>
                                    <option value="3">Magento</option>
                                    <option value="4">Drupal</option>
                                    <option value="5">Ios</option>
                                    <option value="6">Android</option>
                                    <option value="7">Webservice</optin>>
                                    <option value="8">.Net</option>

                                </select>
                            </div> 
                            <?php //echo form_error('estimation_file'); ?>
                            <?php //if($this->session->flashdata('file_empty')){echo $this->session->flashdata('file_empty');} ?>
                            <div class="form-group">                               
                                <label for="browse_estimation">Choose Project estimation xls/csv file to import</label>
                                <input type="file" name="estimation_file" id="browse_estimation">
                                <!--<p class="help-block">Please select a estimation excel file.</p>-->
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
