// User
const flashMaster = $(".flash-master").data("flashdata");
if (flashMaster) {
	Swal.fire({
		icon: "success",
		title: "Selamat",
		text: "Data Master Barang Berhasil " + flashMaster,
	});
}

$(".hapus-master").on("click", function (e) {
	// hentikan aksi default
	e.preventDefault();
	// jqueri cariin tombol hapus yang lagi saya click, lalu ambil atributnya
	const href = $(this).attr("href");

	Swal.fire({
		title: "yakin Data Master Barang akan di nonaktifkan?",
		text: "Master Barang akan di Nonaktifkan",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, Nonaktifkan!",
		// Jika hasilya true (tombol di pencet) jalankan fungsi dibawah
	}).then((result) => {
		if (result.value == true) {
			document.location.href = href;
		}
	});
});