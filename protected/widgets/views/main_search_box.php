<style>
	.ui-autocomplete {max-height: 150px;overflow-y: auto;overflow-x: hidden;}
	* html .ui-autocomplete {height: 150px;}
</style>
<script>
var filterdata = 1;
</script>
<?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'hotel_search',
                'htmlOptions' => array('name' => 'search-form'),
                'enableAjaxValidation' => false,
                'action' => "/search/index",
            	'method' => "GET",
            ));
            ?>
            <input type='hidden' name="search_widget_type" value="<?php echo $type ?>"/>
            <?php 
             $srchBoxInptValue = "";
			 if(isset($model->search_keyword) && $model->search_keyword!=''){
				$srchBoxInptValue = $model->search_keyword;
			 }else{
				$srchBoxInptValue = "Hotel, City, District";
			 }			
			 echo $form->textField($model, 'search_keyword', array('id' => 'search_keyword', "class" => "textBox searchBoxcity", "data-noval" => "Entrez un nom de ville, de département, de restaurant ou un point d'intérêt",  'value'=>"$srchBoxInptValue", 'onfocus'=>"this.value='';", 'onblur'=>"if(this.value==''){this.value='$srchBoxInptValue';}")); ?>
            <?php echo $form->hiddenField($model, 'search_id', array('id' => 'search_id')); ?>
	        <?php echo $form->hiddenField($model, 'search_type', array('id' => 'search_type')); ?>
	        <?php echo $form->hiddenField($model, 'date', array('id' => 'date')); ?>
	        <?php echo $form->hiddenField($model, 'arrival_time', array('id' => 'arrival_time')); ?>
	        <?php echo $form->hiddenField($model, 'stay_duration', array('id' => 'stay_duration')); ?>
	        <?php echo $form->hiddenField($model, 'budget', array('id' => 'budget')); ?>
	        <?php echo $form->hiddenField($model, 'rating', array('id' => 'rating')); ?>
	        <?php echo $form->hiddenField($model, 'equipment', array('id' => 'equipment')); ?>
	        <?php echo $form->hiddenField($model, 'theme', array('id' => 'theme')); ?>
	        <?php echo $form->hiddenField($model, 'district', array('id' => 'district')); ?>
	        <?php echo $form->hiddenField($model, 'order', array('id' => 'order')); ?>
	        <?php echo $form->hiddenField($model, 'page', array('id' => 'page')); ?>
                <?php echo $form->hiddenField($model, 'longitude', array('id' => 'longitude')); ?>
	        <?php echo $form->hiddenField($model, 'latitude', array('id' => 'latitude')); ?>
            
    		<span class="homeTopdatepicker">  
    			<input type="text" name="date_select" id="chk_dt" class="dateBox" value="<?php if(isset($model->date)) { echo $model->date; }  ?>" readonly="readonly" placeholder="DATE">
    			<div class="datepicker" id="datepicker"></div>
                        <div class="dateRequired" style="display:none;">Please Select Date</div>
    		</span>
    		
    		<div class="arivaltime">
			    <select id="arrival_time_select"> 
					<option>ARRIVAL TIME</option>
			        <?php
			        	$arrivalTimeArray = $model->getArrivalTimeArray();
			        	for ($i = $arrivalTimeArray['start']; $i <= $arrivalTimeArray['end']; $i = $i + $arrivalTimeArray['duration'] * 60) {
			            	$selected = "";
			            	if(isset($model->arrival_time) && $model->arrival_time == date('G:i', $i)) { $selected = "selected"; }
			            	
			            	echo "<option $selected value=" . date('G:i', $i) . ">" . date('g A', $i) . "</option>";
						}
					?>
				</select>
    		</div>
    		<div class="length">
				<select name="stay_duration_select" id="stay_duration_select">
			    	<option>LENGTH</option>
			        	<?php 
			            $timeLengthArray = $model->getDurationLength();
			            foreach ($timeLengthArray as $key=>$value) {?>
			            	<?php $selected = "";
				            if(isset($model->stay_duration) && $model->stay_duration == $key) { $selected = "selected"; } ?>
			                <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>;
						<?php } ?>
				</select>
			</div>
    		<input type="submit" class="searchBtn" value="Search" id="search_button">
            <?php $this->endWidget(); ?>
<script>
   $(function(){
       $("#hotel_search").validate();
   }); 
</script>