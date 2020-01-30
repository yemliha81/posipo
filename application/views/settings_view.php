<?php include('includes/header.php');?>
<div class="w10 h100 bR p5" style="position:relative;">
	<a href="<?php echo MAIN_BOARD;?>" class="btn btn-info form-control"><?php echo $home;?></a> <br/> <br/>
	<a href="javascript:;" class="btn btn-info form-control pagex" page="cats/add_category"><?php echo $category;?></a> <br/> <br/>
	<a href="javascript:;" class="btn btn-info form-control pagex" page="products/add_product"><?php echo $product;?></a> <br/> <br/>
</div>

<div class="w90 report">
	<div class="wrapper">
	</div>
</div>
<?php include('includes/footer.php');?>

<script>
	
	$(".pagex").click(function(){
		
		var page_name = $(this).attr("page");
		
		open_page(page_name);
		
	});
	
	function open_page(page_name){
		
		$.ajax({
			type : "get",
			url : "<?php echo FATHER_BASE;?>/"+page_name,
			success : function(response){
				$(".wrapper").html(response);
			}
		});
		
	}
</script>