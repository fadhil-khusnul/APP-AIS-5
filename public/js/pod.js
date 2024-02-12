var realisasiload_create = $("#realisasiload_create").DataTable({
	responsive: true,
	pageLength: 5,
	lengthMenu: [
		[5, 10, 20, -1],
		[5, 10, 20, "All"],
	],
	fixedHeader: {
		header: true,
	},
	// scroller: true,
});

var tabel_si = $("#tabel_si").DataTable({
	responsive: true,
	paging: true,
	fixedHeader: {
		header: true,
	},
	pageLength: 5,
	lengthMenu: [
		[5, 10, 20, -1],
		[5, 10, 20, "All"],
	],

	// scroller: true,P
});
function biaya_do(e) {
	var id = e.value;
	console.log(id);
	var swal = Swal.mixin({
		customClass: {
			confirmButton: "btn btn-label-success btn-wide mx-1",
			denyButton: "btn btn-label-secondary btn-wide mx-1",
			cancelButton: "btn btn-label-danger btn-wide mx-1",
		},
		buttonsStyling: false,
	});

	var toast = Swal.mixin({
		toast: true,
		position: "top-end",
		showConfirmButton: false,
		timer: 3e3,
		timerProgressBar: true,
		didOpen: function didOpen(toast) {
			toast.addEventListener("mouseenter", Swal.stopTimer);
			toast.addEventListener("mouseleave", Swal.resumeTimer);
		},
	});

	swal.fire({
		title: " Masukkkan Biaya POD untuk kontainer ini?",
		icon: "question",
		showCancelButton: true,
		confirmButtonText: "Iya",
		cancelButtonText: "Tidak",
	}).then((willCreate) => {
		if (willCreate.isConfirmed) {
			$.ajax({
				url: "/detail-kontainer/" + id + "/input",
				type: "GET",
				success: function (response) {
					let new_id = id;
					console.log(new_id);
					$("#modal_biaya_do").modal("show");

					$("#id_container").val(response.result.id);
					$("#nomor_kontainer").html(response.result.nomor_kontainer);

					$("#valid_pod").submit(function (e) {
            e.preventDefault();
        }).validate({
						highlight: function highlight(
							element,
							errorClass,
							validClass
						) {
							$(element).addClass("is-invalid");
							$(element).removeClass("is-valid");
						},
						unhighlight: function unhighlight(
							element,
							errorClass,
							validClass
						) {
							$(element).removeClass("is-invalid");
						},
						errorPlacement: function errorPlacement(
							error,
							element
						) {
							error.addClass("invalid-feedback");
							element
								.closest(".validation-container")
								.append(error);
						},
						submitHandler: function (form) {
							document.getElementById(
								"loading-wrapper"
							).style.cursor = "wait";
							document
								.getElementById("btnFinish1")
								.setAttribute("disabled", true);

							var csrf = $("#csrf").val();
							var id_container = $("#id_container").val();
							var thc_pod = $("#thc_pod")
								.val()
								.replace(/\./g, "");
							var dooring = $("#dooring")
								.val()
								.replace(/\./g, "");
							var demurrage = $("#demurrage")
								.val()
								.replace(/\./g, "");
							var input_total_biaya_lain = document.querySelector("#input_total_biaya_lain");

							var keterangan_biaya = [];
							if (input_total_biaya_lain !== null) {
								// input_total_biaya_lain element exists
								var input_total_biaya_lain = $("#input_total_biaya_lain").val().replace(/\./g, "");

								// Further processing here

								for (let i = 0; i < urutan_keterangan; i++) {
									keterangan_biaya[i] = document.getElementById("keterangan_biaya[" + (i + 1) + "]").value;
								}
							} else {
								input_total_biaya_lain = 0
							}
							var data = {
								_token: csrf,
								id: id_container,
								thc_pod: thc_pod,
								dooring: dooring,
								demurrage: demurrage,
								input_total_biaya_lain: input_total_biaya_lain,
								keterangan_biaya: keterangan_biaya,
							};

							$.ajax({
								type: "POST",
								url: "/masukkan-biaya-pod",
								data: data,

								success: function (response) {
									// console.log(response);
									toast
										.fire({
											icon: "success",
											title: "Biaya POD Dimasukkan",
											timer: 2e3,
										})
										.then((result) => {
											location.reload();
										});
								},
							});
						},
					});
				},
			});
		} else {
			toast.fire({
				title: "Nomor BL Tidak dimasukkan",
				icon: "error",
				timer: 2e3,
			});
		}
	});

	// for (let i = 0; i < chek_container.length; i++) {
	//     volume[i] = document.getElementById("volume[" + item_id[i] + "]").value;

	// }
}


function edit_biaya_do(e) {
	var id = e.value;
	console.log(id);
	var swal = Swal.mixin({
		customClass: {
			confirmButton: "btn btn-label-success btn-wide mx-1",
			denyButton: "btn btn-label-secondary btn-wide mx-1",
			cancelButton: "btn btn-label-danger btn-wide mx-1",
		},
		buttonsStyling: false,
	});

	var toast = Swal.mixin({
		toast: true,
		position: "top-end",
		showConfirmButton: false,
		timer: 3e3,
		timerProgressBar: true,
		didOpen: function didOpen(toast) {
			toast.addEventListener("mouseenter", Swal.stopTimer);
			toast.addEventListener("mouseleave", Swal.resumeTimer);
		},
	});

	$.ajax({
		url: "/detail-kontainer/" + id + "/input",
		type: "GET",
		success: function (response) {
			console.log(response);
			let new_id = id;
			$("#modal_biaya_do_edit").modal("show");

			document.getElementById("div_button_biaya").innerHTML = "";
			document.getElementById("div_total_biaya_edit").innerHTML = "";
			document.getElementById("div_keterangan_biaya_edit").innerHTML = "";
			if (response.biayalain.length == 0) {
				$("#id_container_edit").val(response.result.id);
				$("#nomor_kontainer_edit").html(response.result.nomor_kontainer);

				$("#thc_pod_edit").val(response.result.thc_pod);
				$("#dooring_edit").val(response.result.dooring);
				$("#demurrage_edit").val(response.result.demurrage);
				var button_biaya_lain = document.getElementById("div_button_biaya");

				var label1 = document.createElement("label");
				label1.setAttribute("id", "label_biaya");
				label1.setAttribute("name", "label_biaya");
				label1.setAttribute("class", "col-sm-4 col-form-label");

				var button1 = document.createElement("button");
				button1.setAttribute("type", "button");
				button1.setAttribute("id", "edit_button_biaya_lain");
				button1.setAttribute("name", "edit_button_biaya_lain");
				button1.setAttribute("value", 0);
				button1.setAttribute("class", "btn btn-sm btn-label-success btn-sm text-nowrap");
				button1.setAttribute("onclick", "edit_total_biaya_lain(this)");
				button1.innerHTML = "Biaya Lain <i class='fa fa-plus'></i>";

				label1.append(button1);
				button_biaya_lain.appendChild(label1);
				edit_urutan_keterangan = 1;

				$("#valid_pod_edit").submit(function (e) { e.preventDefault(); }).validate({
					highlight: function highlight(element, errorClass, validClass) {
						$(element).addClass("is-invalid");
						$(element).removeClass("is-valid");
					},
					unhighlight: function unhighlight(
						element,
						errorClass,
						validClass
					) {
						$(element).removeClass("is-invalid");
					},
					errorPlacement: function errorPlacement(error, element) {
						error.addClass("invalid-feedback");
						element.closest(".validation-container").append(error);
					},
					submitHandler: function (form) {
						document.getElementById("loading-wrapper").style.cursor =
							"wait";
						document
							.getElementById("btnFinish2")
							.setAttribute("disabled", true);

						var csrf = $("#csrf").val();
						var id_container = $("#id_container_edit").val();
						var thc_pod = $("#thc_pod_edit").val().replace(/\./g, "");
						var dooring = $("#dooring_edit").val().replace(/\./g, "");
						var demurrage = $("#demurrage_edit")
							.val()
							.replace(/\./g, "");

						var input_total_biaya_lain = document.querySelector("#input_total_biaya_lain_edit")

						var keterangan_biaya = [];
						if (input_total_biaya_lain !== null) {
							// input_total_biaya_lain element exists
							input_total_biaya_lain = $("#input_total_biaya_lain_edit").val().replace(/\./g, "");
							
							// Further processing here
							
							for (let i = 0; i < edit_urutan_keterangan; i++) {
								keterangan_biaya[i] = document.getElementById("keterangan_biaya[" + (i + 1) + "]").value;
							}
						} else {
							input_total_biaya_lain = 0
						}

						var data = {
							_token: csrf,
							id: id_container,
							thc_pod: thc_pod,
							dooring: dooring,
							demurrage: demurrage,
							input_total_biaya_lain: input_total_biaya_lain,
							keterangan_biaya: keterangan_biaya,
						};

						$.ajax({
							type: "POST",
							url: "/masukkan-biaya-pod",
							data: data,

							success: function (response) {
								// console.log(response);
								toast
									.fire({
										icon: "success",
										title: "Biaya POD Dimasukkan",
										timer: 2e3,
									})
									.then((result) => {
										location.reload();
									});
							},
						});
					},
				});

				
			} else {
				$("#id_container_edit").val(response.result.id);
				$("#nomor_kontainer_edit").html(response.result.nomor_kontainer);

				$("#thc_pod_edit").val(response.result.thc_pod);
				$("#dooring_edit").val(response.result.dooring);
				$("#demurrage_edit").val(response.result.demurrage);
				var button_biaya_lain = document.getElementById("div_button_biaya");

				var label1 = document.createElement("label");
				label1.setAttribute("id", "label_biaya");
				label1.setAttribute("name", "label_biaya");
				label1.setAttribute("class", "col-sm-4 col-form-label");

				var button1 = document.createElement("button");
				button1.setAttribute("type", "button");
				button1.setAttribute("id", "edit_button_biaya_lain");
				button1.setAttribute("name", "edit_button_biaya_lain");
				button1.setAttribute("value", 1);
				button1.setAttribute("class", "btn btn-sm btn-label-danger btn-sm text-nowrap");
				button1.setAttribute("onclick", "edit_total_biaya_lain(this)");
				button1.innerHTML = "Hapus Biaya Lain <i class='fa fa-minus'></i>";

				label1.append(button1);
				button_biaya_lain.appendChild(label1);

				var div_total_biaya_lain = document.getElementById("div_total_biaya_edit");

				var label2 = document.createElement("label");
				label2.setAttribute("class", "col-sm-4 col-form-label");
				label2.innerHTML = "Total Biaya Lain : ";

				var div1 = document.createElement("div");
				div1.setAttribute("class", "col-sm-8 validation-container");

				var div2 = document.createElement("div");
				div2.setAttribute("class", "input-group input-group-sm");

				var span1 = document.createElement("span");
				span1.setAttribute("class", "input-group-text");
				span1.innerHTML = "Rp.";

				var input1 = document.createElement("input");
				input1.setAttribute("data-bs-toggle", "tooltip");
				input1.setAttribute("type", "text");
				input1.setAttribute("class", "form-control currency-rupiah");
				input1.setAttribute("id", "input_total_biaya_lain_edit");
				input1.setAttribute("name", "input_total_biaya_lain_edit");
				input1.setAttribute("placeholder", "Total Biaya Lain...");
				input1.setAttribute("value", response.result.total_biaya_lain_pod.toString());

				div2.append(span1);
				div2.append(input1);
				div1.append(div2);

				div_total_biaya_lain.appendChild(label2);
				div_total_biaya_lain.appendChild(div1);

				$("#input_total_biaya_lain_edit").inputmask({
					alias: "numeric",
					prefix: "",
					groupSeparator: ".",
					autoGroup: true,
					digits: 0,
					digitsOptional: false,
					placeholder: "0",
				});

				var div_keterangan_biaya_lain = document.getElementById("div_keterangan_biaya_edit");
				edit_urutan_keterangan = response.biayalain.length;

				for (var i = 0; i < response.biayalain.length; i++) {
					if (i == 0) {
						var div3 = document.createElement("div");
						div3.setAttribute("id", "body_biaya[" + (i + 1) + "]");
						div3.setAttribute("class", "row row-cols");

						var label3 = document.createElement("label");
						label3.setAttribute("id", "label_biaya");
						label3.setAttribute("name", "label_biaya");
						label3.setAttribute("class", "col-sm-4 col-form-label");

						var a1 = document.createElement("a");
						a1.setAttribute("id", "tambah_keterangan");
						a1.setAttribute("name", "tambah_keterangan");
						a1.setAttribute("class", "btn btn-sm btn-label-success btn-sm text-nowrap");
						a1.setAttribute("onclick", "edit_tambah_keterangan()");
						a1.innerHTML = "Keterangan Biaya Lain <i class='fa fa-plus'></i>";

						label3.append(a1);

						var div4 = document.createElement("div");
						div4.setAttribute("id", "div_textarea_biaya");
						div4.setAttribute("name", "div_textarea_biaya");
						div4.setAttribute("class", "col-sm-6 validation-container d-grid gap-3");

						var textarea1 = document.createElement("textarea");
						textarea1.setAttribute("style", "margin-left: 10px");
						textarea1.setAttribute("data-bs-toggle", "tooltip");
						textarea1.setAttribute("class", "form-control");
						textarea1.setAttribute("id", "keterangan_biaya[" + (i + 1) + "]");
						textarea1.setAttribute("name", "keterangan_biaya[" + (i + 1) + "]");
						textarea1.setAttribute("placeholder", "ex. (Rp. 10.000 untuk kebutuhan kontainer)");
						textarea1.setAttribute("required", true);
						textarea1.innerHTML = response.biayalain[i].keterangan;

						div4.append(textarea1);

						var div5 = document.createElement("div");
						div5.setAttribute("id", "div_button_biaya");
						div5.setAttribute("name", "div_button_biaya");
						div5.setAttribute("class", "col-sm-2 py-4");

						div3.append(label3);
						div3.append(div4);
						div3.append(div5);

						div_keterangan_biaya_lain.appendChild(div3);
					} else {
						var div6 = document.createElement("div");
						div6.setAttribute("id", "body_biaya[" + (i + 1) + "]");
						div6.setAttribute("class", "row row-cols");

						var label4 = document.createElement("label");
						label4.setAttribute("id", "label_biaya");
						label4.setAttribute("name", "label_biaya");
						label4.setAttribute("class", "col-sm-4 col-form-label");

						var div7 = document.createElement("div");
						div7.setAttribute("id", "div_textarea_biaya");
						div7.setAttribute("name", "div_textarea_biaya");
						div7.setAttribute("class", "col-sm-6 validation-container d-grid gap-3");

						var textarea2 = document.createElement("textarea");
						textarea2.setAttribute("style", "margin-left: 10px");
						textarea2.setAttribute("data-bs-toggle", "tooltip");
						textarea2.setAttribute("class", "form-control");
						textarea2.setAttribute("id", "keterangan_biaya[" + (i + 1) + "]");
						textarea2.setAttribute("name", "keterangan_biaya[" + (i + 1) + "]");
						textarea2.setAttribute("placeholder", "ex. (Rp. 10.000 untuk kebutuhan kontainer)");
						textarea2.setAttribute("required", true);
						textarea2.innerHTML = response.biayalain[i].keterangan;

						div7.append(textarea2);

						var div8 = document.createElement("div");
						div8.setAttribute("id", "div_button_biaya");
						div8.setAttribute("name", "div_button_biaya");
						div8.setAttribute("class", "col-sm-2 py-4");

						var a2 = document.createElement("a");
						a2.setAttribute("style", "margin-left: 10px");
						a2.setAttribute("id", "hapus_biaya[" + (i + 1) + "]");
						a2.setAttribute("name", "hapus_biaya[" + (i + 1) + "]");
						a2.setAttribute("class", "btn btn-sm btn-label-danger btn-icon");
						a2.setAttribute("onclick", "edit_hapus_biaya(this)");

						var i1 = document.createElement("i");
						i1.setAttribute("class", "fa fa-trash");

						a2.append(i1);
						div8.append(a2);

						div6.append(label4);
						div6.append(div7);
						div6.append(div8);

						div_keterangan_biaya_lain.appendChild(div6);
					}
				}



				$("#valid_pod_edit").submit(function (e) { e.preventDefault(); }).validate({
					highlight: function highlight(element, errorClass, validClass) {
						$(element).addClass("is-invalid");
						$(element).removeClass("is-valid");
					},
					unhighlight: function unhighlight(
						element,
						errorClass,
						validClass
					) {
						$(element).removeClass("is-invalid");
					},
					errorPlacement: function errorPlacement(error, element) {
						error.addClass("invalid-feedback");
						element.closest(".validation-container").append(error);
					},
					submitHandler: function (form) {
						document.getElementById("loading-wrapper").style.cursor =
							"wait";
						document
							.getElementById("btnFinish2")
							.setAttribute("disabled", true);

						var csrf = $("#csrf").val();
						var id_container = $("#id_container_edit").val();
						var thc_pod = $("#thc_pod_edit").val().replace(/\./g, "");
						var dooring = $("#dooring_edit").val().replace(/\./g, "");
						var demurrage = $("#demurrage_edit")
							.val()
							.replace(/\./g, "");
						var input_total_biaya_lain = document.querySelector("#input_total_biaya_lain_edit")

						var keterangan_biaya = [];
						if (input_total_biaya_lain != null) {
							 input_total_biaya_lain = $("#input_total_biaya_lain_edit").val().replace(/\./g, "");

							for (let i = 0; i < edit_urutan_keterangan; i++) {
								keterangan_biaya[i] = document.getElementById(
									"keterangan_biaya[" + (i + 1) + "]"
								).value;
							}
						} else {
							input_total_biaya_lain = 0
							keterangan_biaya = []
						}



						
						var data = {
							_token: csrf,
							id: id_container,
							thc_pod: thc_pod,
							dooring: dooring,
							demurrage: demurrage,
							input_total_biaya_lain: input_total_biaya_lain,
							keterangan_biaya: keterangan_biaya,
						};

						$.ajax({
							type: "POST",
							url: "/masukkan-biaya-pod",
							data: data,

							success: function (response) {
								// console.log(response);
								toast
									.fire({
										icon: "success",
										title: "Biaya POD Dimasukkan",
										timer: 2e3,
									})
									.then((result) => {
										location.reload();
									});
							},
						});
					},
				});
			}
		},
	});

	// for (let i = 0; i < chek_container.length; i++) {
	//     volume[i] = document.getElementById("volume[" + item_id[i] + "]").value;

	// }
}

function input_biaya_do(e) {
	var id = e.value;
	console.log(id);
	var swal = Swal.mixin({
		customClass: {
			confirmButton: "btn btn-label-success btn-wide mx-1",
			denyButton: "btn btn-label-secondary btn-wide mx-1",
			cancelButton: "btn btn-label-danger btn-wide mx-1",
		},
		buttonsStyling: false,
	});

	var toast = Swal.mixin({
		toast: true,
		position: "top-end",
		showConfirmButton: false,
		timer: 3e3,
		timerProgressBar: true,
		didOpen: function didOpen(toast) {
			toast.addEventListener("mouseenter", Swal.stopTimer);
			toast.addEventListener("mouseleave", Swal.resumeTimer);
		},
	});

	$.ajax({
		url: "/detail-pdf/" + id + "/input",
		type: "GET",
		success: function (response) {
			swal.fire({
				title:
					" Masukkkan DO FEE untuk Nomor BL ini " +
					response.result.nomor_bl +
					" ?",
				icon: "question",
				showCancelButton: true,
				confirmButtonText: "Iya",
				cancelButtonText: "Tidak",
			}).then((willCreate) => {
				if (willCreate.isConfirmed) {
					let new_id = id;
					console.log(new_id);
					$("#modal_do_fee_si").modal("show");

					$("#id_si").val(response.result.id);

					// var old_tanggal_result = moment(
					//     response.result.tanggal_do_pod,
					//     "YYYY-MM-DD"
					// ).format("dddd, DD-MM-YYYY");
					// $("#tanggal_do_pod").val(old_tanggal_result);

					$("#valid_do_fee").validate({
						highlight: function highlight(
							element,
							errorClass,
							validClass
						) {
							$(element).addClass("is-invalid");
							$(element).removeClass("is-valid");
						},
						unhighlight: function unhighlight(
							element,
							errorClass,
							validClass
						) {
							$(element).removeClass("is-invalid");
						},
						errorPlacement: function errorPlacement(
							error,
							element
						) {
							error.addClass("invalid-feedback");
							element
								.closest(".validation-container")
								.append(error);
						},
						submitHandler: function (form) {
							document.getElementById(
								"loading-wrapper"
							).style.cursor = "wait";
							document
								.getElementById("btnFinish3")
								.setAttribute("disabled", true);

							var csrf = $("#csrf").val();
							var id_si = $("#id_si").val();
							var biaya_do_pod = $("#biaya_do_pod")
								.val()
								.replace(/\./g, "");
							var tanggal_do_pod = $("#tanggal_do_pod").val();

							tanggal_do_pod = moment(
								tanggal_do_pod,
								"dddd, DD-MMMM-YYYY"
							).format("YYYY-MM-DD");

							tempDate = new Date(tanggal_do_pod);
							formattedDate = [
								tempDate.getFullYear(),
								tempDate.getMonth() + 1,
								tempDate.getDate(),
							].join("-");

							var data = {
								_token: csrf,
								id: id_si,
								biaya_do_pod: biaya_do_pod,
								tanggal_do_pod: formattedDate,
							};

							$.ajax({
								type: "POST",
								url: "/masukkan-do-fee",
								data: data,

								success: function (response) {
									// console.log(response);
									toast
										.fire({
											icon: "success",
											title: "DO FEE Berhasil Dimasukkan",
											timer: 2e3,
										})
										.then((result) => {
											location.reload();
										});
								},
							});
						},
					});
				} else {
					toast.fire({
						title: "DO FEE Tidak dimasukkan",
						icon: "error",
						timer: 2e3,
					});
				}
			});
		},
	});

	// for (let i = 0; i < chek_container.length; i++) {
	//     volume[i] = document.getElementById("volume[" + item_id[i] + "]").value;

	// }
}
function do_fee_edit(e) {
	var id = e.value;
	console.log(id);
	var swal = Swal.mixin({
		customClass: {
			confirmButton: "btn btn-label-success btn-wide mx-1",
			denyButton: "btn btn-label-secondary btn-wide mx-1",
			cancelButton: "btn btn-label-danger btn-wide mx-1",
		},
		buttonsStyling: false,
	});

	var toast = Swal.mixin({
		toast: true,
		position: "top-end",
		showConfirmButton: false,
		timer: 3e3,
		timerProgressBar: true,
		didOpen: function didOpen(toast) {
			toast.addEventListener("mouseenter", Swal.stopTimer);
			toast.addEventListener("mouseleave", Swal.resumeTimer);
		},
	});

	$.ajax({
		url: "/detail-pdf/" + id + "/input",
		type: "GET",
		success: function (response) {
			let new_id = id;
			console.log(new_id);
			$("#modal_do_fee_si_edit").modal("show");

			$("#id_si_edit").val(response.result.id);
			$("#biaya_do_pod_edit").val(response.result.biaya_do_pod);
			var old_tanggal_result = moment(
				response.result.tanggal_do_pod,
				"YYYY-MM-DD"
			).format("dddd, DD-MMMM-YYYY");
			$("#tanggal_do_pod_edit").val(old_tanggal_result);

			$("#valid_do_fee_edit").validate({
				highlight: function highlight(element, errorClass, validClass) {
					$(element).addClass("is-invalid");
					$(element).removeClass("is-valid");
				},
				unhighlight: function unhighlight(
					element,
					errorClass,
					validClass
				) {
					$(element).removeClass("is-invalid");
				},
				errorPlacement: function errorPlacement(error, element) {
					error.addClass("invalid-feedback");
					element.closest(".validation-container").append(error);
				},
				submitHandler: function (form) {
					document.getElementById("loading-wrapper").style.cursor =
						"wait";
					document
						.getElementById("btnFinish4")
						.setAttribute("disabled", true);

					var csrf = $("#csrf").val();
					var id_si_edit = $("#id_si_edit").val();
					var biaya_do_pod = $("#biaya_do_pod_edit")
						.val()
						.replace(/\./g, "");
					var tanggal_do_pod = $("#tanggal_do_pod_edit").val();

					tanggal_do_pod = moment(
						tanggal_do_pod,
						"dddd, DD-MMMM-YYYY"
					).format("YYYY-MM-DD");

					tempDate = new Date(tanggal_do_pod);
					formattedDate = [
						tempDate.getFullYear(),
						tempDate.getMonth() + 1,
						tempDate.getDate(),
					].join("-");

					var data = {
						_token: csrf,
						id: id_si_edit,
						biaya_do_pod: biaya_do_pod,
						tanggal_do_pod: formattedDate,
					};

					$.ajax({
						type: "POST",
						url: "/masukkan-do-fee",
						data: data,

						success: function (response) {
							// console.log(response);
							toast
								.fire({
									icon: "success",
									title: "DO FEE Berhasil Diedit",
									timer: 2e3,
								})
								.then((result) => {
									location.reload();
								});
						},
					});
				},
			});
		},
	});

	// for (let i = 0; i < chek_container.length; i++) {
	//     volume[i] = document.getElementById("volume[" + item_id[i] + "]").value;

	// }
}

function delete_SI(r) {
	var deleteid = r.value;

	var swal = Swal.mixin({
		customClass: {
			confirmButton: "btn btn-label-success btn-wide mx-1",
			denyButton: "btn btn-label-secondary btn-wide mx-1",
			cancelButton: "btn btn-label-danger btn-wide mx-1",
		},
		buttonsStyling: false,
	});

	swal.fire({
		title: "Apakah anda yakin Ingin Menghapus Dokumen SI INI ?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonText: "Iya",
		cancelButtonText: "Tidak",
	}).then((willCreate) => {
		if (willCreate.isConfirmed) {
			var old_slug = document.getElementById("old_slug").value;

			var data = {
				_token: $("input[name=_token]").val(),
				id: deleteid,
			};
			$.ajax({
				type: "DELETE",
				url: "/delete-si/" + deleteid,
				data: data,

				success: function (response) {
					swal.fire({
						title: "SI BERHASIL DIHAPUS",
						icon: "success",
						timer: 9e3,
						showConfirmButton: false,
					});
					window.location.reload();
				},
			});
		} else {
			swal.fire({
				title: "SI TIDAK DIHAPUS",
				icon: "error",
				timer: 10e3,
				showConfirmButton: false,
			});
		}
	});
}

var urutan_keterangan = 1;

function total_biaya_lain(e) {
	var value = e.value;
	console.log(value);

	var div_total_biaya = document.getElementById("div_total_biaya");
	var div_keterangan_biaya = document.getElementById("div_keterangan_biaya");

	if (value == 0) {
		var label1 = document.createElement("label");
		label1.setAttribute("class", "col-sm-4 col-form-label");
		label1.innerHTML = "Total Biaya Lain : ";

		var div1 = document.createElement("div");
		div1.setAttribute("class", "col-sm-8 validation-container");

		var div2 = document.createElement("div");
		div2.setAttribute("class", "input-group input-group-sm");

		var span1 = document.createElement("span");
		span1.setAttribute("class", "input-group-text");
		span1.innerHTML = "Rp.";

		var input1 = document.createElement("input");
		input1.setAttribute("data-bs-toggle", "tooltip");
		input1.setAttribute("type", "text");
		input1.setAttribute("class", "form-control currency-rupiah");
		input1.setAttribute("id", "input_total_biaya_lain");
		input1.setAttribute("name", "input_total_biaya_lain");
		input1.setAttribute("required", true);
		input1.setAttribute("placeholder", "Total Biaya Lain...");

		div2.append(span1);
		div2.append(input1);
		div1.append(div2);

		div_total_biaya.appendChild(label1);
		div_total_biaya.appendChild(div1);

		var div3 = document.createElement("div");
		div3.setAttribute("id", "body_biaya[1]");
		div3.setAttribute("class", "row row-cols");

		var label2 = document.createElement("label");
		label2.setAttribute("id", "label_biaya");
		label2.setAttribute("name", "label_biaya");
		label2.setAttribute("class", "col-sm-4 col-form-label");

		var a1 = document.createElement("a");
		// a1.setAttribute("type", "button");
		a1.setAttribute("id", "tambah_keterangan");
		a1.setAttribute("name", "tambah_keterangan");
		a1.setAttribute(
			"class",
			"btn btn-sm btn-label-success btn-sm text-nowrap"
		);
		a1.setAttribute("onclick", "tambah_keterangan()");
		a1.innerHTML = "Keterangan Biaya Lain <i class='fa fa-plus'></i>";

		label2.append(a1);

		var div4 = document.createElement("div");
		div4.setAttribute("id", "div_textarea_biaya");
		div4.setAttribute("name", "div_textarea_biaya");
		div4.setAttribute(
			"class",
			"col-sm-6 validation-container d-grid gap-3"
		);

		var textarea1 = document.createElement("textarea");
		textarea1.setAttribute("style", "margin-left: 10px");
		textarea1.setAttribute("data-bs-toggle", "tooltip");
		textarea1.setAttribute("class", "form-control");
		textarea1.setAttribute("id", "keterangan_biaya[1]");
		textarea1.setAttribute("name", "keterangan_biaya[1]");
		textarea1.setAttribute(
			"placeholder",
			"ex. (Rp.10.000 untuk kebutuhan kontainer)"
		);
		textarea1.setAttribute("required", true);

		div4.append(textarea1);

		div3.append(label2);
		div3.append(div4);

		div_keterangan_biaya.appendChild(div3);

		$("#input_total_biaya_lain").inputmask({
			alias: "numeric",
			prefix: "",
			groupSeparator: ".",
			autoGroup: true,
			digits: 0,
			digitsOptional: false,
			placeholder: "0",
		});

		document.getElementById("button_biaya_lain").value = 1;

		document
			.getElementById("button_biaya_lain")
			.setAttribute(
				"class",
				"btn btn-sm btn-label-danger btn-sm text-nowrap"
			);
		document.getElementById("button_biaya_lain").innerHTML =
			"Hapus Biaya Lain <i class='fa fa-minus'></i>";
	} else {
		div_total_biaya.innerHTML = "";
		div_keterangan_biaya.innerHTML = "";

		urutan_keterangan = 1;

		document.getElementById("button_biaya_lain").value = 0;

		document
			.getElementById("button_biaya_lain")
			.setAttribute(
				"class",
				"btn btn-sm btn-label-success btn-sm text-nowrap"
			);
		document.getElementById("button_biaya_lain").innerHTML =
			"Biaya Lain <i class='fa fa-plus'></i>";
	}
}

var edit_urutan_keterangan = 1;

function edit_total_biaya_lain(e) {
	var value = e.value;
	console.log(value);

	var div_total_biaya = document.getElementById("div_total_biaya_edit");
	var div_keterangan_biaya = document.getElementById("div_keterangan_biaya_edit");

	if (value == 0) {
		var label1 = document.createElement("label");
		label1.setAttribute("class", "col-sm-4 col-form-label");
		label1.innerHTML = "Total Biaya Lain : ";

		var div1 = document.createElement("div");
		div1.setAttribute("class", "col-sm-8 validation-container");

		var div2 = document.createElement("div");
		div2.setAttribute("class", "input-group input-group-sm");

		var span1 = document.createElement("span");
		span1.setAttribute("class", "input-group-text");
		span1.innerHTML = "Rp.";

		var input1 = document.createElement("input");
		input1.setAttribute("data-bs-toggle", "tooltip");
		input1.setAttribute("type", "text");
		input1.setAttribute("class", "form-control currency-rupiah");
		input1.setAttribute("id", "input_total_biaya_lain_edit");
		input1.setAttribute("name", "input_total_biaya_lain_edit");
		input1.setAttribute("required", true);
		input1.setAttribute("placeholder", "Total Biaya Lain...");

		div2.append(span1);
		div2.append(input1);
		div1.append(div2);

		div_total_biaya.appendChild(label1);
		div_total_biaya.appendChild(div1);

		var div3 = document.createElement("div");
		div3.setAttribute("id", "body_biaya[1]");
		div3.setAttribute("class", "row row-cols");

		var label2 = document.createElement("label");
		label2.setAttribute("id", "label_biaya");
		label2.setAttribute("name", "label_biaya");
		label2.setAttribute("class", "col-sm-4 col-form-label");

		var a1 = document.createElement("a");
		// a1.setAttribute("type", "button");
		a1.setAttribute("id", "tambah_keterangan");
		a1.setAttribute("name", "tambah_keterangan");
		a1.setAttribute(
			"class",
			"btn btn-sm btn-label-success btn-sm text-nowrap"
		);
		a1.setAttribute("onclick", "edit_tambah_keterangan()");
		a1.innerHTML = "Keterangan Biaya Lain <i class='fa fa-plus'></i>";

		label2.append(a1);

		var div4 = document.createElement("div");
		div4.setAttribute("id", "div_textarea_biaya");
		div4.setAttribute("name", "div_textarea_biaya");
		div4.setAttribute(
			"class",
			"col-sm-6 validation-container d-grid gap-3"
		);

		var textarea1 = document.createElement("textarea");
		textarea1.setAttribute("style", "margin-left: 10px");
		textarea1.setAttribute("data-bs-toggle", "tooltip");
		textarea1.setAttribute("class", "form-control");
		textarea1.setAttribute("id", "keterangan_biaya[1]");
		textarea1.setAttribute("name", "keterangan_biaya[1]");
		textarea1.setAttribute(
			"placeholder",
			"ex. (Rp. 10.000 untuk kebutuhan kontainer)"
		);
		textarea1.setAttribute("required", true);

		div4.append(textarea1);

		div3.append(label2);
		div3.append(div4);

		div_keterangan_biaya.appendChild(div3);

		$("#input_total_biaya_lain_edit").inputmask({
			alias: "numeric",
			prefix: "",
			groupSeparator: ".",
			autoGroup: true,
			digits: 0,
			digitsOptional: false,
			placeholder: "0",
		});

		document.getElementById("edit_button_biaya_lain").value = 1;

		document
			.getElementById("edit_button_biaya_lain")
			.setAttribute(
				"class",
				"btn btn-sm btn-label-danger btn-sm text-nowrap"
			);
		document.getElementById("edit_button_biaya_lain").innerHTML =
			"Hapus Biaya Lain <i class='fa fa-minus'></i>";
	} else {
		div_total_biaya.innerHTML = "";
		div_keterangan_biaya.innerHTML = "";

		edit_urutan_keterangan = 1;

		document.getElementById("edit_button_biaya_lain").value = 0;

		document
			.getElementById("edit_button_biaya_lain")
			.setAttribute(
				"class",
				"btn btn-sm btn-label-success btn-sm text-nowrap"
			);
		document.getElementById("edit_button_biaya_lain").innerHTML =
			"Biaya Lain <i class='fa fa-plus'></i>";
	}
}

function tambah_keterangan() {
	urutan_keterangan++;

	var div1 = document.getElementById("div_keterangan_biaya");

	var div2 = document.createElement("div");
	div2.setAttribute("id", "body_biaya[" + urutan_keterangan + "]");
	div2.setAttribute("class", "row row-cols");

	var label1 = document.createElement("label");
	label1.setAttribute("id", "label_biaya");
	label1.setAttribute("name", "label_biaya");
	label1.setAttribute("class", "col-sm-4 col-form-label");

	var div3 = document.createElement("div");
	div3.setAttribute("id", "div_textarea_biaya");
	div3.setAttribute("name", "div_textarea_biaya");
	div3.setAttribute("class", "col-sm-6 validation-container d-grid gap-3");

	var textarea1 = document.createElement("textarea");
	textarea1.setAttribute("style", "margin-left: 10px; margin-top:10px;");
	textarea1.setAttribute("data-bs-toggle", "tooltip");
	textarea1.setAttribute("class", "form-control");
	textarea1.setAttribute("id", "keterangan_biaya[" + urutan_keterangan + "]");
	textarea1.setAttribute(
		"name",
		"keterangan_biaya[" + urutan_keterangan + "]"
	);
	textarea1.setAttribute(
		"placeholder",
		"ex. (Rp. 10.000 untuk kebutuhan kontainer)"
	);
	textarea1.setAttribute("required", true);

	div3.append(textarea1);

	var div4 = document.createElement("div");
	div4.setAttribute("id", "div_button_biaya");
	div4.setAttribute("name", "div_button_biaya");
	div4.setAttribute("class", "col-sm-2 py-4");

	var a1 = document.createElement("a");
	a1.setAttribute("style", "margin-left: 10px");
	a1.setAttribute("id", "hapus_biaya[" + urutan_keterangan + "]");
	a1.setAttribute("name", "hapus_biaya[" + urutan_keterangan + "]");
	a1.setAttribute("class", "btn btn-sm btn-label-danger btn-icon");
	a1.setAttribute("onclick", "button_hapus_biaya(this)");

	var icon1 = document.createElement("i");
	icon1.setAttribute("class", "fa fa-trash");

	a1.append(icon1);
	div4.append(a1);

	div2.append(label1);
	div2.append(div3);
	div2.append(div4);

	div1.appendChild(div2);
}

function edit_tambah_keterangan() {
	edit_urutan_keterangan++

	var div1 = document.getElementById("div_keterangan_biaya_edit");

	var div2 = document.createElement("div");
	div2.setAttribute("id", "body_biaya[" + edit_urutan_keterangan + "]");
	div2.setAttribute("class", "row row-cols");

	var label1 = document.createElement("label");
	label1.setAttribute("id", "label_biaya");
	label1.setAttribute("name", "label_biaya");
	label1.setAttribute("class", "col-sm-4 col-form-label");

	var div3 = document.createElement("div");
	div3.setAttribute("id", "div_textarea_biaya");
	div3.setAttribute("name", "div_textarea_biaya");
	div3.setAttribute("class", "col-sm-6 validation-container d-grid gap-3");

	var textarea1 = document.createElement("textarea");
	textarea1.setAttribute("style", "margin-left: 10px; margin-top:10px;");
	textarea1.setAttribute("data-bs-toggle", "tooltip");
	textarea1.setAttribute("class", "form-control");
	textarea1.setAttribute("id", "keterangan_biaya[" + edit_urutan_keterangan + "]");
	textarea1.setAttribute(
		"name",
		"keterangan_biaya[" + edit_urutan_keterangan + "]"
	);
	textarea1.setAttribute(
		"placeholder",
		"ex. (Rp. 10.000 untuk kebutuhan kontainer)"
	);
	textarea1.setAttribute("required", true);

	div3.append(textarea1);

	var div4 = document.createElement("div");
	div4.setAttribute("id", "div_button_biaya");
	div4.setAttribute("name", "div_button_biaya");
	div4.setAttribute("class", "col-sm-2 py-4");

	var a1 = document.createElement("a");
	a1.setAttribute("style", "margin-left: 10px");
	a1.setAttribute("id", "hapus_biaya[" + edit_urutan_keterangan + "]");
	a1.setAttribute("name", "hapus_biaya[" + edit_urutan_keterangan + "]");
	a1.setAttribute("class", "btn btn-sm btn-label-danger btn-icon");
	a1.setAttribute("onclick", "edit_hapus_biaya(this)");

	var icon1 = document.createElement("i");
	icon1.setAttribute("class", "fa fa-trash");

	a1.append(icon1);
	div4.append(a1);

	div2.append(label1);
	div2.append(div3);
	div2.append(div4);

	div1.appendChild(div2);
}

function button_hapus_biaya(e) {
	var urutan_delete = e.parentNode.parentNode;
	urutan_delete.remove();
	urutan_keterangan--;

	var div1 = document.querySelectorAll("#div_textarea_biaya textarea");

	for (var i = 0; i < div1.length; i++) {
		div1[i].id = "keterangan_biaya[" + (i + 1) + "]";
		div1[i].name = "keterangan_biaya[" + (i + 1) + "]";
		div1[i].placeholder =
			"ex. (Rp. 10.000 untuk kebutuhan kontainer)";
	}

	var div2 = document.querySelectorAll("#div_button_biaya a");

	for (var i = 0; i < div2.length; i++) {
		div2[i].id = "hapus_biaya[" + (i + 1) + "]";
		div2[i].name = "hapus_biaya[" + (i + 1) + "]";
	}
}

function edit_hapus_biaya(e) {
	var urutan_delete = e.parentNode.parentNode;
	urutan_delete.remove();
	edit_urutan_keterangan--;

	var div1 = document.querySelectorAll("#div_textarea_biaya textarea");

	for (var i = 0; i < div1.length; i++) {
		div1[i].id = "keterangan_biaya[" + (i + 1) + "]";
		div1[i].name = "keterangan_biaya[" + (i + 1) + "]";
		div1[i].placeholder =
			"ex. (Rp. 10.000 untuk kebutuhan kontainer)";
	}

	var div2 = document.querySelectorAll("#div_button_biaya a");

	for (var i = 0; i < div2.length; i++) {
		div2[i].id = "hapus_biaya[" + (i + 1) + "]";
		div2[i].name = "hapus_biaya[" + (i + 1) + "]";
	}
}
