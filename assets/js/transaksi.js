function autofill() {
	var kode = $('#kd_barang').val();
    // console.log(kode);
	$.ajax({
		url: BASE_URL + "Transaksi/cari",
		//  url:"<?php echo base_url();?>admin/Mutasi/cari",
		data: "&kode=" + kode,
		success: function (data) {
			var hasil = JSON.parse(data); 

			$('#qty-tersedia').text(hasil.stock);
			$("#nama_barang").val(hasil.nama_barang);
			$("#harga_jual").val(hasil.harga_jual);
		},
	});
}

function sum() {
	var val1 = document.getElementById("harga_jual").value;
	var val2 = document.getElementById("qty").value;
	var result = parseFloat(val1) * parseFloat(val2).toFixed(1);
	//console.log(parseFloat(val1).toFixed(1));
	if (!isNaN(result)) {
		document.getElementById("sub_total").value = parseFloat(result);
	}
}