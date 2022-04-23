<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script>
	$('.js-pscroll').each(function() {
		var ps = new PerfectScrollbar(this);

		$(window).on('resize', function() {
			ps.update();
		})
	});

	function hexToRgb(hex) {
		var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
		if (result) {
			var r = parseInt(result[1], 16);
			var g = parseInt(result[2], 16);
			var b = parseInt(result[3], 16);
			return r + ", " + g + ", " + b; //return 23,14,45 -> reformat if needed 
		}
		return null;
	}

	function rgbToHex(r, g, b) {
		return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
	}

	function chonev() {

		var chon = document.getElementById("chon");

		var C2 = "rgb(" + hexToRgb("#C20000") + ")";
		var D9 = "rgb(" + hexToRgb("#D9D9D9") + ")";
		if (chon.style.backgroundColor == C2) {


			chon.style.backgroundColor = "red";
			chon.style.color = "grey";
			showchon();
		} else {

			chon.style.backgroundColor = C2;
			chon.style.color = D9;
			hiddenchon();

		}

	}

	function showchon() {
		const elements = document.querySelectorAll(".chon");

		for (let i = 0; i < elements.length; i++)
			elements[i].classList.remove('hidden');
	}

	function hiddenchon() {
		const elements = document.querySelectorAll(".chon");
		for (let i = 0; i < elements.length; i++)
			elements[i].classList.add('hidden');

	}

</script>
<!--===============================================================================================-->
<script src="js/mainTable.js"></script>