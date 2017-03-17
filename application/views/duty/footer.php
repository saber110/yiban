

	<script src="<?php echo base_url(); ?>js/duty/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>js/duty/btn.js"></script>
	<script>
	function select(A,B)
	{
		var r =confirm("确认选班？")
		if(r == true)
		{
			$.post("<?php echo base_url();?>Duty/select",{date:A,type:B},function(result)
			{
				alert(result);
				location.reload();
			})
		}

	}
	</script>
</body>
</html>
