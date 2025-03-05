<style type="text/css">
	.courses{
		line-height: 20px; 
	}
	.panel-body table tr td {
		text-align: left;
		padding-left: 8px;
	}
	td, th{
		padding-left: 18px;
	}
	table.courses tr td:first-child {
    	background:rgba(181, 181, 181, 0.16);
	}
	h4.sub-heading {
	    font-size: 16px;
	    color: #c72600;
	}
	h2.sub-heading {
	    font-size: 20px;
	    color: #bb5308;
	    border-bottom: 1px dotted #bb5308;
	}
</style>
<?php echo fuel_block('departments/faculties');?><br>
<?php echo fuel_block('departments/courses');?><br>
<?php echo fuel_block('departments/syllabus');?><br>
<?php echo fuel_block('departments/alumni');?><br>
<?php echo fuel_block('departments/placements');?><br>
<?php echo fuel_block('departments/departmental_news');?>
