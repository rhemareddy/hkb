<?php
/* @var $this HomeBannerController */
/* @var $model HomeBanner */

$curController = @Yii::app()->controller->id ;
$curAction =  @Yii::app()->getController()->getAction()->controller->action->id;
$this->breadcrumbs=array(
		'Home Banners'=>array('index'),
		$curAction.' banner',
);
?>
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="/metronic/assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="/metronic/assets/plugins/select2/select2-metronic.css"/>
<link rel="stylesheet" type="text/css" href="/metronic/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
<link rel="stylesheet" type="text/css" href="/metronic/assets/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css" href="/metronic/assets/plugins/dropzone/css/dropzone.css"/>
<!-- END PAGE LEVEL SCRIPTS -->

<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i><?php echo ucwords($curAction);?> <?php echo ucwords($curController);?>
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
		</div>
	</div>

<div class="portlet-body form">
	<?php 
		$form=$this->beginWidget('CActiveForm', array(
			'action'=>Yii::app()->createUrl($this->route)."?id=$model->id",
			'id'=>'form_sample_3_banner',
			'method'=>'post',
			'htmlOptions'=>array(
			  'class'=>'form-horizontal',
			  'role'=>'form'
			)
		)); 
		?>	
<div class="form-body">
	<div class="alert alert-danger display-hide">
		<button class="close" data-close="alert"></button>
		<?php echo Yii::t('translation','You have some form errors. Please check below.');?>
	</div>
	<div class="alert alert-success display-hide">
		<button class="close" data-close="alert"></button>
		<?php echo Yii::t('translation','Your form validation is successful!');?>
	</div>

	<div class="form-group">	
		<label class="control-label col-md-3">
			Image:
		</label>
		<div class="col-md-7">			
			<div style="min-height:200px;width:570px" class="dropzone dropzone-previews" id="my-awesome-dropzone"><div class="dz-message" data-dz-message><span>Drop or Upload Image</span></div></div>
			<input type="hidden" id="banner_image" name="HomeBanner[banner]" value="<?php echo $model->banner ?>">
		</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-md-3">
			<?php echo $model->getAttributeLabel('banner_text'); ?><span class="required"> * </span>
		</label>
		<div class="col-md-7">
			<?php echo $form->textField($model,'banner_text',array( 'class'=>'form-control','maxlength'=> 60,'placeholder'=>"Max 50 characters allowed!")); ?>
		</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-md-3">
			<?php echo $model->getAttributeLabel('show_order'); ?><span class="required"> * </span>
		</label>
		<div class="col-md-7">
			<?php echo $form->textField($model,'show_order',array( 'class'=>'form-control')); ?>
		</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-md-3">
			Country<span class="required"> * </span>
		</label>
		<div class="col-md-7">
		<select id="country_id" name="HomeBanner[country_id]" class="form-control select2me">  
		<?php 
			$countries = Country::model()->findAll();
			$i=0;
                $countryObject = BaseClass::getCountryCode();
                foreach(BaseClass::getCountryDropdown() as $ky=>$cn):
                                    $selected = ($cn['id'] == YII::app()->params['default']['countryId'])? "selected='selected'" : "";
                                    echo "<option ".$selected." value='".$cn['id']."'>".strtoupper($cn['name'])."</option>";
                                endforeach;?>
		</select>
		<input type="checkbox" name="selectCountry" value="1">
		</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-md-3">
			State<span class="required"> * </span>
		</label>
		<div class="col-md-7">
		<select id="state_id" name="HomeBanner[state_id]" class="form-control select2me">  
		<option value="">NA</option>
		
		<?php
			$criteria = new CDbCriteria;
			$criteria->addCondition("status=1");
			$setcountryid = Yii::app()->params['default']['countryId'];
			if(isset($model->id)){
				if(!$model->country_id)
					$model->country_id = $setcountryid;
				$criteria->addCondition("country_id=".$model->country_id);
			}else {
				$criteria->addCondition("country_id=".$setcountryid);
			}
			$states=State::model()->findAll($criteria);
			$s=0;
			foreach($states as $state){
				$stateSelected="";
				if($state->id == $model->state_id)
					$stateSelected="selected='selected'";
				if($s==0)
				{
					$setstateid = $state->id;
					$s++;
				}
			?>			
			<option <?php echo $stateSelected?> value="<?php echo $state->id;?>"><?php echo $state->slug;?></option> 
		<?php 	
			}					
		?>		 
		</select>
		<input type="checkbox" name="selectState" value="1">
		</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-md-3">
			City<span class="required"> * </span>
		</label>
		<div class="col-md-7">
		<select id="city_id" name="HomeBanner[city_id]" class="form-control select2me">  
		<option value="">NA</option>
		<?php
			$criteria = new CDbCriteria;
			$criteria->addCondition("status=1");
			if(isset($model->id)){
				$setModelstateid = isset($model->state_id)?$model->state_id:1;
				$criteria->addCondition("state_id=".$setModelstateid);
			}else {
				$setstateid = isset($setstateid)?$setstateid:1;
				$criteria->addCondition("state_id=".$setstateid);
			}
			$cities=City::model()->findAll($criteria);
			foreach($cities as $city){
				$citySelected="";
				if($city->id == $model->city_id)
					$citySelected="selected='selected'";
			?>			
			<option <?php echo $citySelected;?> value="<?php echo $city->id;?>"><?php echo $city->slug;?></option> 
		<?php 	
			}					
		?>		 
		</select>
		<input type="checkbox" name="selectCity" value="1">
		</div>
	</div>	
	
	
	<div class="row">
		<div class="col-md-6">
			<div class="col-md-offset-3 col-md-9">
				<button type="submit" class="btn green"><?php echo Yii::t('translation','Submit');?></button>
				<a class="btn default" href="/admin/homeBanner"><?php echo Yii::t('translation','Cancel');?></a>				
			</div>
		</div>
		<div class="col-md-6">
		</div>
	</div>
	
</div>
<?php $this->endWidget(); ?>
</div>
</div>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="/metronic/assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="/metronic/assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="/metronic/assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="/metronic/assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="/metronic/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="/metronic/assets/plugins/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script type="text/javascript" src="/metronic/assets/plugins/bootstrap-markdown/lib/markdown.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL STYLES -->
<script type="text/javascript" src="/metronic/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/metronic/assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="/metronic/assets/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<script src="/metronic/assets/scripts/custom/components-dropdowns.js"></script>
<script src="/metronic/custom/form-dropzone.js?ver=<?php echo strtotime("now");?>"></script> 
<script type="text/javascript" src="/metronic/assets/plugins/dropzone/dropzone.js?ver=<?php echo strtotime("now");?>"></script> 

<!-- END PAGE LEVEL STYLES -->
<script type="text/javascript">
jQuery(document).ready(function() {   
   // initiate layout and plugins
   ComponentsDropdowns.init();
   Dropzone.options.myAwesomeDropzone = {
		   	  url: '/admin/homeBanner/dropzoneupload/id/<?php echo $model->id;?>',
			  maxFiles: 1,
			  acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",			  
			  accept: function(file, done) {
			    done();
			  },
			  init: function() {
			    this.on("maxfilesexceeded", function(file){
			        alert("No more files please!");
			    });
			    this.on("success", function(file,response){
					var obj = jQuery.parseJSON(response);
					if(obj.result=="success"){
						$("#banner_image").val(obj.filename);
					}
			    });	
			}
			
	};
});

$("#form_sample_3_banner").submit(function(e){
	e.preventDefault();
    var checked = $("#form_sample_3_banner input:checked").length > 0;
    if (!checked){
        alert("Please check at least one checkbox");
        return false;
    }else{
       if($('input[name=selectCountry]').is(':checked') && !($("#country_id").val())){
      	    alert("Please select country");
   		 	return false;
       }
       if($("input[name=selectState]").is(':checked') && !($("#state_id").val())){
   	    	alert("Please select state");
		 	return false;
       }
       if($("input[name=selectCity]").is(':checked') && !($("#city_id").val())){
   	    	alert("Please select city");
		 	return false;
       }
       var url = $("#form_sample_3_banner").attr("action");
       $.post( url, $("#form_sample_3_banner").serialize())
       .done(function( result ) {
    	   var obj = jQuery.parseJSON(result);
			if(obj.status=="SUCCESS"){
				showSucessMsg("Record saved successfully", "Save Home Banner");
				var currentUrl  = (window.location.pathname);				
					// redirect to update Job page
					showSucessMsg("Please wait while we redirecting.", "Page redirection");
					window.location.href = "/admin/homeBanner";
					return;
			}
       }); 	
    }
});


$( "#country_id" ).change(function() {
	$.ajax({
		type: "GET",
		url: "<?php echo Yii::app()->createUrl('admin/hotel/changestate'); ?>",
		data: { country_id: $('#country_id :selected').val(),'selectName':'HomeBanner[state_id]'},
		success: function(result){
					$('#state_id').html(result);
			}
		});
});

$( "#state_id" ).change(function() {
	$.ajax({
		type: "GET",
		url: "<?php echo Yii::app()->createUrl('admin/hotel/changecity'); ?>",
		data: { state_id: $('#state_id :selected').val(),'selectName':'HomeBanner[city_id]'},
		success: function(result){
					$('#city_id').html(result);
			}
		});
});
</script>