<?php mysqli_close($con); ?>
<script type="text/javascript">
	function _hide() {
		var pan = document.getElementById("pan");
		var aff = document.getElementById("aff");
		var hide = document.getElementById("hide");
		pan.style.top="-191px";
		pan.style.transition=".3s";
		aff.style.display="-webkit-inline-box";
		hide.style.display="none";
	}
	function _show() {
		var pan = document.getElementById("pan");
		var aff = document.getElementById("aff");
		var hide = document.getElementById("hide");
		pan.style.top="0";
		pan.style.transition=".3s";
		aff.style.display="none";
		hide.style.display="-webkit-inline-box";
	}
</script>
</body>
</html>