<?php include('includes/header.php');?>
<div class="">
	<div class="">
		<div class="">
			<div class="text-center">
			<form action="<?php echo LOGIN_POST;?>" method="post">
				<p>
					<input type="text" name="email" placeholder="E-mail" required />
				</p>
				<p>
					<input type="password" name="pass" placeholder="Password" required />
				</p>
				<p>
					<input type="submit" class="btn btn-success" value="GİRİŞ"/>
				</p>
			</form>
			</div>
		</div>
	</div>
</div>
<?php include('includes/footer.php');?>