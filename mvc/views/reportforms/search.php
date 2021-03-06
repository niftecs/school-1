<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-code-fork"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_reportforms_settings')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <?php 
                    $usertype = $this->session->userdata("usertype");
                    if($usertype == "Admin" || $usertype == "Teacher") {
                ?>
                    <h5 class="page-header">
                        <a href="<?php echo base_url('reportforms/add') ?>">
                            <i class="fa fa-plus-circle"></i> 
                            <?=$this->lang->line('filter_title')?>
                        </a>
                    </h5>
                <?php } ?>

                <div class="col-sm-6 col-sm-offset-3 list-group">
                    <div class="list-group-item list-group-item-warning">
                        <form style="" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">  

                            <?php 
                                if(form_error('name')) 
                                    echo "<div class='form-group has-error' >";
                                else     
                                    echo "<div class='form-group' >";
                            ?>
                                <label for="name_id" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line("reportforms_classes")?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("reportforms_select_classes"));
                                        foreach ($classes as $classa) {
                                            $array[$classa->classesID] = $classa->classes;
                                        }
                                        echo form_dropdown("classesID", $array, set_value("classesID"), "id='classesID' class='form-control'");
                                    ?>
                                </div>
                            </div>

                            <?php 
                                if(form_error('examID')) 
                                    echo "<div class='form-group has-error' >";
                                else     
                                    echo "<div class='form-group' >";
                            ?>
                                <label for="year" class="col-sm-2 col-sm-offset-2 control-label">
                                    <?=$this->lang->line("reportforms_year")?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        $array = array("0" => $this->lang->line("reportforms_select_year"));
                                        echo form_dropdown("year", $array, set_value("year"), "id='year' class='form-control'");
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- col-sm-6 -->  
            </div> <!-- col-sm-12 -->
            
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->

<script type="text/javascript">
$("#classesID").change(function() {
var classID = $(this).val();
if(parseInt(classID)) {
    if(classID === '0') {
        $('#year').val(0);
    } else {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('reportforms/year_call')?>",
            data: {"classID" : classID},
            dataType: "html",
            success: function(data) {
               $('#year').html(data);
            }
        });
    }
}
});
    $('#year').change(function() {
        var year = $(this).val();
        var classID = $('#classesID').val();
        if(classID == 0 || year== 0) {
            $('#hide-table').hide();
            alert("Hey? You must select class first!");
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('reportforms/reportforms_list')?>",
                data:{year: year,classID: classID},
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });

</script>