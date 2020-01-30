<?php include('includes/header.php');?>
<div class="w10 h100 bR p5 hidden" style="position:relative;">
	<a href="<?php echo MAIN_BOARD;?>" class="btn btn-info form-control">Anasayfa</a>
</div>
<div class="w40 h100 bR" style="position:relative;">
	<input type="text" class="barcodeInput bB foc hidden" placeholder="Scan barcode..." />
		<form id="shopForm">
			<div class="ShopList"></div>
		</form> 
	<div class="total_p">0.00</div>
	<a href="javascript:;" class="btn btn-success svShop" >SAVE</a>
</div>
<div class="w60 h100">
	<div class="cats">
		<?php foreach ($cat_list as $key => $val) { ?>
			<div class="catBox" cat_id="<?php echo $val['id'];?>">
				<div class="catName">
					<?php echo $val['cat_name'];?>
				</div>
			</div>
		<?php } ?>
		<div class="clearfix"></div>
	</div>
	<div class="products">
		<?php foreach ($pro_list as $key => $val) { ?>
			<div class="proBox" pro_name="<?php echo $val['pro_name'];?>" pro_price="<?php echo $val['pro_price'];?>" pro_id="<?php echo $val['id'];?>">
				<img src="<?php echo FATHER_BASE;?>img/<?php echo $val['pro_image'];?>" width="100%">
				<div class="proName">
					<?php echo $val['pro_name'];?>
				</div>
			</div>
		<?php } ?>
		<div class="clearfix"></div>
	</div>
</div>
<?php include('includes/footer.php');?>
<script>

	$(document).on("click", ".proBox", function(){
		var pro_name = $(this).attr("pro_name");
		var pro_price = $(this).attr("pro_price");
		var pro_id = $(this).attr("pro_id");
		addProRow(pro_name, pro_price, 1, pro_id);
	});

	function addProRow(proName, proPrice, qty, pro_id){
		
		var proHtml = '<div class="proRow bB xRow">\
						<div class="w40 bR divBox tt">'+proName+'</div>\
						<div class="w10 bR text-center divBox tt qqty">'+qty+'</div>\
						<div class="w20 bR text-center divBox tt totPrice">'+proPrice+'</div>\
						<div class="w10 bR text-center divBox">\
							<a href="javascript:;" class="minus"><i class="fa fa-minus"></i></a>\
						</div>\
						<div class="w10 bR text-center divBox">\
							<a href="javascript:;" class="plus"><i class="fa fa-plus"></i></a>\
						</div>\
						<div class="w10 text-center divBox">\
							<a href="javascript:;" class="del"><i class="fa fa-trash"></i></a>\
						</div>\
						<div class="clearfix"></div>\
						<input type="hidden" name="pro_id[]" value="'+pro_id+'">\
						<input class="xqty" type="hidden" name="qty[]" value="'+qty+'">\
						<input type="hidden" name="proPrice[]" value="'+proPrice+'">\
					</div>';
		
		
		$(".ShopList").append(proHtml);
		update_total_price();
	}
	
	function update_total_price(){
		
		var totP = 0.00;
		
		$(".xRow").each(function(){
			var q = parseFloat($(this).children('.qqty').text());
			var tot = parseFloat($(this).children('.totPrice').text());
			
				var rowTot = parseFloat(q*tot);
				totP += rowTot;
			
		});
		
		totP = parseFloat(totP).toFixed(2);
		$(".total_p").text(totP);
		
	}
	
	$(document).on("click", ".plus", function(){
		var qty = $(this).parent().parent().children('.qqty');
		var xqty = $(this).parent().parent().children('.xqty');
		var qqty = parseInt($(qty).text());
		
		var plus = qqty+1;
		
		$(qty).text(plus);
		$(xqty).val(plus);
		update_total_price();
	});
	
	$(document).on("click", ".minus", function(){
		var qty = $(this).parent().parent().children('.qqty');
		var xqty = $(this).parent().parent().children('.xqty');
		var qqty = parseInt($(qty).text());
		
		if(qqty > 1){
			var plus = qqty-1;
		
			$(qty).text(plus);
			$(xqty).val(plus);
		}
		update_total_price();
		
	});
	
	$(document).on("click", ".del", function(){
		$(this).parent().parent().remove();
		update_total_price();
		
	});
	
	$(".svShop").click(function(){
		var formD = $("#shopForm").serialize();
		
		$.ajax({
			type : "post",
			url : "<?php echo ORDER_SAVE_POST;?>",
			data : formD,
			success : function(response){
				if(response == 'success'){
					location.reload();
				}
			}
		});
		
	});
	
	$(document).on("click", ".catBox", function(){
		var cat_id = $(this).attr("cat_id");
		
		$.ajax({
			
			type : "post",
			data : {"cat_id" : cat_id},
			url : "<?php echo GET_CAT_PRODUCTS;?>",
			success : function(response){
				$(".products").html(response);
			}
			
		});
		
	});
	
</script>