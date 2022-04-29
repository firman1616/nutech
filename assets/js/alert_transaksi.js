// User
const flashTransaksi = $(".flash-transaksi").data("flashdata");
if (flashTransaksi) {
	Swal.fire({
		icon: "success",
		title: "Selamat",
		text: "Transaksi Barang Berhasil " + flashTransaksi,
	});
}

$(".hapus-transaksi").on("click", function (e) {
	// hentikan aksi default
	e.preventDefault();
	// jqueri cariin tombol hapus yang lagi saya click, lalu ambil atributnya
	const href = $(this).attr("href");

	Swal.fire({
		title: "Yakin Data Transaksi Barang akan di Hapus?",
		text: "Data Transaksi Barang akan di Hapus",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, Hapus!",
		// Jika hasilya true (tombol di pencet) jalankan fungsi dibawah
	}).then((result) => {
		if (result.value == true) {
			document.location.href = href;
		}
	});
});