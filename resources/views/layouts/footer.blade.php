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
        var xoa=document.getElementById("xoa");
		var select=document.getElementById("selectall");
		var C2 = "rgb(" + hexToRgb("#C20000") + ")";
		var D9 = "rgb(" + hexToRgb("#D9D9D9") + ")";
		if (chon.style.backgroundColor == C2) {


			chon.style.backgroundColor = "red";
			chon.style.color = "grey";
			xoa.style.display="inline-block";
			select.style.display="inline-block";
			showchon();
		} else {

			chon.style.backgroundColor = C2;
			chon.style.color = D9;
			xoa.style.display="none";
			select.style.display="none";
			hiddenchon();

		}

	}

	function showchon() {
		var xoa = document.getElementById("xoa");
		const elements = document.querySelectorAll(".chon");
		xoa.disabled = false;
		for (let i = 0; i < elements.length; i++)
			elements[i].classList.remove('hidden');
	}

	function hiddenchon() {
		const elements = document.querySelectorAll(".chon");
		var xoa = document.getElementById("xoa");
		xoa.disabled = true;
		for (let i = 0; i < elements.length; i++)
			elements[i].classList.add('hidden');

	}

	function EndDayCantBePast(e) {
		var end = document.getElementById(e);
		var d = new Date().toISOString().slice(0, 10);
		var today = new Date(d);
		var endDay = new Date(end.value);
		if (e != "kck_date") {
			if (e != "dateend") {
				if (today > endDay) {
					alert("ngay ket thuc phai lon hon bang ngay " + today.toISOString().slice(0, 10));
					end.value = today.toISOString().slice(0, 10);
				}
			} else {
				var start = document.getElementById("datestart").value;

				if (start == null) {
					if (today > endDay) {
						alert("ngay ket thuc phai lon hon bang ngay " + today.toISOString().slice(0, 10));
						end.value = today.toISOString().slice(0, 10);
					}
				} else {
					var st = new Date(start);

					if (st > endDay) {
						alert("ngay ket thuc phai lon hon bang ngay bat dau");
						end.value = st.toISOString().slice(0, 10);
					}
				}
			}
		} else {
			if (endDay < today)

			{
				alert("ngay  phai lon hon bang ngay bat dau");
				end.value = today.toISOString().slice(0, 10);
			}

		}


	}

	function StartDayCheck(e) {
		var start = document.getElementById(e);

		var startDay = new Date(start.value);
		var end = document.getElementById("dateend").value;
		var ed = new Date(end);
		if (startDay > ed) {
			alert("ngay ket thuc phai lon hon bang ngay bat dau");
			start.value = ed.toISOString().slice(0, 10);
		}

	}

	function checktimekck(e) {
		if (e != "kck_endtime") {
			var timestart = document.getElementById(e);
			var timeend = document.getElementById("kck_endtime");
		} else {
			var timestart = document.getElementById("kck_starttime");
			var timeend = document.getElementById(e);
		}


		if (timeend.value < timestart.value && timestart.value != "" && timeend.value != "") {
			alert("gio ket thuc phai hon gio bat dau");
			timeend.value = timestart.value;
		}
	}

	function checktimeck(e) {
		if (e != "ck_endtime") {
			var timestart = document.getElementById(e);
			var timeend = document.getElementById("ck_endtime");
		} else {
			var timestart = document.getElementById("ck_starttime");
			var timeend = document.getElementById(e);
		}


		if (timeend.value < timestart.value && timestart.value != "" && timeend.value != "") {
			alert("gio ket thuc phai hon gio bat dau");
			timeend.value = timestart.value;
		}
	}

	function checktimeinday(e) {
		if (e == "startname") {
			var timestart = document.getElementById(e);
			var timeend = document.getElementById("endname");
		} else {
			var timestart = document.getElementById("startname");
			var timeend = document.getElementById(e);
		}


		if (timeend.value < timestart.value && timestart.value != "" && timeend.value != "") {
			alert("gio ket thuc phai hon gio bat dau");
			timeend.value = timestart.value;
		}
	}
	//create
	function checkck() {
		var type = document.getElementById("typeEvent").value;
		var ck = document.getElementById("daingay");
		var n = document.getElementById("trongngay");
		
		/*if (document.getElementById(e).checked == true) {
		    ck.style.visibility = "visible";
		    n.style.visibility = "hidden";
		    ck.style.display = "inline-block";
		    n.style.display = "none";
		} else {
		    ck.style.visibility = "hidden";
		    n.style.visibility = "visible";
		    ck.style.display = "none";
		    n.style.display = "inline-block";
		}*/
		if (type == "trong ngay") {
			ck.style.visibility = "hidden";
			n.style.visibility = "visible";
			ck.style.display = "none";
			n.style.display = "inline-block";
		} else {
			ck.style.visibility = "visible";
			n.style.visibility = "hidden";
			ck.style.display = "inline-block";
			n.style.display = "none";

			var cck = document.getElementById("cochuky");
			var kck = document.getElementById("khongchuky");
			
			if (type == "Chu Ky") {
				cck.style.visibility = "visible";
				kck.style.visibility = "hidden";
				cck.style.display = "inline-block";
				kck.style.display = "none";
			} else if (type == "khong Chu Ky"){
				
				cck.style.visibility = "hidden";
				kck.style.visibility = "visible";
				cck.style.display = "none";
				kck.style.display = "inline-block";

			}
		}

	}

	function lammoi() {
		document.getElementById("FormCreate").reset();

	}

	function check_chuky() {
		/*var ck = document.getElementById("cochuky");
		var n = document.getElementById("khongchuky");
		var radiock = document.getElementById("radio_chuky");

		if (radiock.checked == true) {
			ck.style.visibility = "visible";
			n.style.visibility = "hidden";
			ck.style.display = "inline-block";
			n.style.display = "none";

		} else {
			ck.style.visibility = "hidden";
			n.style.visibility = "visible";
			ck.style.display = "none";
			n.style.display = "inline-block";

		}*/
	}

	function clearlistkck() {
		document.querySelector('#write-codekck').innerHTML = '';
	}

	function writecodekck() {
		var start = document.getElementById("kck_starttime").value;
		var end = document.getElementById("kck_endtime").value;
		var date = document.getElementById("kck_date").value;
		if (date != "") {

			$(".write-codekck").append("<li><span style='color:red;'  onclick='updatelist(this.id)'> x </span><input type='text' style='display:none;'  name='listevkck[]' value='" + start + "-" + end + " " + date + "' >" + start + "-" + end + " " + date + "</li>");
		} else
			alert("bạn chưa chọn ngày");

	}

	function clearlistck() {
		document.querySelector('#write-codeck').innerHTML = '';
	}

	var idlist = 0;

	function writecodeck() {
		var start = document.getElementById("ck_starttime").value;
		var end = document.getElementById("ck_endtime").value;
		var thu = document.getElementById("weekday").value;
		$(".write-codeck").append("<li><span style='color:red;' id=" + idlist + " onclick='updatelist(this.id)'> x </span><input type='text' style='display:none;'  name='listevck[]' value='" + start + "-" + end + " " + thu + "' >" + start + "-" + end + " " + thu + "</li>");

		idlist++;

	}

	function updatelist(e) {
		document.getElementById(e).parentElement.style.display = "none";
	}


	//end create
</script>
<!--===============================================================================================-->
<script src="js/mainTable.js"></script>