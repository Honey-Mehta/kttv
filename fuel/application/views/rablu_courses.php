<style type="text/css">
	label {
    font-weight: normal;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<div class="row" style="min-height: 200px">

<?php echo form_open('', array('role'=>'form','class'=>'forgot inline-form')); ?>
	<div class="col-md-3">
		<label>Select District</label>
		<?php echo form_dropdown('districtID',$getdistrict_list,set_value('districtID'), array('required'=>'required','class'=>'form-control basic-multiple','id'=>'districtID')); ?>
	</div>

	<div class="col-md-3">
		<label>Select Course Type</label>
		<?php echo form_dropdown('courseType',$getcourseType_list,set_value('courseType'), array('required'=>'required','class'=>'form-control basic-multiple','id'=>'courseType')); ?>
	</div>

	<div class="col-md-3">
		<label>Select Course</label>
		<?php echo form_dropdown('courseID',$getcourses_list,set_value('courseID'), array('required'=>'required','class'=>'form-control basic-multiple','id'=>'courseID')); ?>
	</div>

	<div class="col-md-3">
		<label>&nbsp;</label>
		<button type="submit" name="submit" class="form-control btn btn-primary">Search</button>
	</div>


<?php echo form_close(); ?>
<?php if($_POST):?>
<div class="col-md-12">
	<br>
	<table class="table table-striped table-bordered">
		<thead>
			<th>Course</th>
			<th>Type</th>
			<th>Duration</th>
			<th>College Name</th>
			<th>City</th>
			<th>District</th>
		</thead>
		<tbody>
			<?php if(! empty($getcourses_tbl)): ?>
			<?php foreach ($getcourses_tbl as $row): ?>
				<tr>
					<td><?php echo $row->course_desc_Eng; ?></td>
					<td><?php echo $row->Course_type_Desc; ?></td>
					<td><?php echo $row->Duration; ?> Yrs.</td>
					<td><?php echo $row->Collegedesc; ?></td>
					<td><?php echo $row->city; ?></td>
					<td><?php echo $row->DistrictName; ?></td>
				</tr>
			<?php endforeach ?>
			<?php else: ?>
				<tr>
					<td colspan="6" class="text-center">College not found for this search criteria</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>
<?php endif; ?>
</div>

<script type="text/javascript">
$(document).ready( function() {

$("#courseType").change(function() {
	if($(this.value)){
	var	course_Type = this.value;
	var csrfName = "<?php echo $this->security->get_csrf_token_name();?>";
	var csrfToken = $.cookie('csrf_cookie');
		$.ajax({
		   type: "POST",
		   dataType : "json",
		   url: "<?php echo base_url(); ?>paramedical_courses/coursesList",
		   data: {[csrfName]: csrfToken, "courseType": course_Type}, 

		   beforeSend: function()
		   {        
		   		$("#courseID").empty();
		   		$(".loading").show();
		   },
		   success: function(data)
		   {
		        $.each(data[0].options, function (index, response) {
	            
		             $("<option />", {value: response.course_code, text: response.course_desc_Eng}).appendTo($("#courseID"));
		           
		        });
		         debugger;
		        
		   },
		   error: function(xhr) { // if error occured

		        alert("Error occured.please try again");

		    },
		    complete: function(){
		    	$(".loading").hide();
		    	$("input[name='"+csrfName+"']").val($.cookie('csrf_cookie'));

		    }
		});
		}
	});
});
</script>
<div class="loading" style="display: none;">Loading…</div>
<style type="text/css">

/*-------------------------------*/
/*    loading Spinner start		 */
/*-------------------------------*/

/* Absolute Center Spinner */
.loading {
  display:none;
  position: fixed;
  z-index: 9999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

/*-------------------------------*/
/*    loading Spinner end		 */
/*-------------------------------*/

</style>