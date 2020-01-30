<?php if(!empty($products)){ ?>
	
	<?php foreach($products as $key => $val){ ?>
		
		<div class="proBox" pro_name="<?php echo $val['pro_name'];?>" pro_price="<?php echo $val['pro_price'];?>" pro_id="<?php echo $val['id'];?>">
			<img src="<?php echo FATHER_BASE;?>img/<?php echo $val['pro_image'];?>" width="100%">
			<div class="proName">
				<?php echo $val['pro_name'];?>
			</div>
		</div>
		
	<?php } ?>
	
<?php }else{ ?>
	
	Ürün bulunamadı!
	
<?php } ?>